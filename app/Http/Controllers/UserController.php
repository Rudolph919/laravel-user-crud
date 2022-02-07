<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Language;
use App\Models\Interests;
use App\Models\UserInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Validator;
use App\Notifications\WelcomeNotification;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate(5);

        $data = [
            'users' => $users,
        ];

        return view('users.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::orderBy('name', 'ASC')->get();
        $interests = Interests::orderBy('name', 'ASC')->get();

        $data = [
            'languages' => $languages,
            'interests' => $interests,
        ];

        return view('users.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        // This will call the UserFormRequest validator and validate the form. Will only return validated data
        $validate = $request->validated();

        //Create a new instance and load the difference values
        $new_user = new User();
        $new_user->name = $request['name'];
        $new_user->surname = $request['surname'];
        $new_user->id_number = $request['id_number'];
        $new_user->mobile_number = $request['mobile_number'];
        $new_user->email = $request['email'];
        $new_user->date_of_birth = $request['date_of_birth'];
        $new_user->language = $request['language'];
        $new_user->password = Hash::make($request['password']);

        //Save the user to the database
        try {
            $user_result = DB::transaction(function () use ($new_user) {
               $new_user->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'There was an error creating the user. Please try again. If the problem persists please contact the system admin');
        }

        //Retrieve newly inserted user id for later database use
        $new_user_id = $new_user->id;

        //Loop through the selected interests and save them to the database
        try {
            $interest_result = DB::transaction(function () use ($request, $new_user_id) {
                foreach ($request['interests'] as $key => $value) {
                    $new_interest = new UserInterest();
                    $new_interest->user_id = $new_user_id;
                    $new_interest->interest_id = $value;
                    $new_interest->save();
                }
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'There was an error capturing the interests. Please try again. If the problem persists please contact the system admin');
        }

        //Sends out welcome notification
        $new_user->notify(new WelcomeNotification($new_user));

        return redirect()->route('users.index')->with('success', 'User has been captured successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->get();

        $data = [
            'user' => $user[0],
        ];

        return view('users.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $languages = Language::orderBy('name', 'ASC')->get();
        $interests = Interests::orderBy('name', 'ASC')->get();

        $user_interests = UserInterest::where('user_id', $id)
            ->pluck('interest_id')
            ->toArray();

        $data = [
            'user' => $user,
            'user_interests' => $user_interests,
            'languages' => $languages,
            'interests' => $interests,
        ];

        return view('users.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        // This will call the UserFormRequest validator and validate the form. Will only return validated data
        $validate = $request->validated();

        //Find the user and update with validated data
        $user = User::find($id);
        $user->name = $request['name'];
        $user->surname = $request['surname'];
        $user->id_number = $request['id_number'];
        $user->mobile_number = $request['mobile_number'];
        $user->email = $request['email'];
        $user->date_of_birth = $request['date_of_birth'];
        $user->language = $request['language'];
        $user->password = Hash::make($request['password']);

        //Save the updated user details to the database
        try {
            $user_result = DB::transaction(function () use ($user) {
               $user->save();
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withInput()->with('error','There was an error updating the user. Please try again. If the problem persists please contact the system administrator');
        }

        try {
            /* Delete the permissions that exist for the profile in the User Profile Permissions table */
            $delete_interests = UserInterest::where('user_id', $id)->delete();
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->withInput()->with('error', 'There was an error removing the previous interests for this user. Please try again. If the problem persists please contact the system admin');
        }

        //Loop through the selected interests and save them to the database
        try {
            $interest_result = DB::transaction(function () use ($request, $id) {
                foreach ($request['interests'] as $key => $value) {
                    $new_interest = new UserInterest();
                    $new_interest->user_id = $id;
                    $new_interest->interest_id = $value;
                    $new_interest->save();
                }
            });
        } catch (\Throwable $th) {
            Log::error($th);
            return back()->with('error', 'There was a problem updating the user interests. Please try again. If the problem persists please contact the system admin');
        }

        return redirect()->route('users.show', $id)->with('success', 'User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted_user = User::where('id', $id)->delete();
        return back()->with('success', 'User successfully deleted!');
    }
}
