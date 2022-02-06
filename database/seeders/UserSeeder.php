<?php

namespace Database\Seeders;

use App\Models\Interests;
use App\Models\User;
use App\Models\UserInterest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' => 'Super',
                'surname' => 'Admin',
                'id_number' => '1234567890123',
                'mobile_number' => '0123456789',
                'date_of_birth' => '01-01-1970',
                'language' => 1,
                'email' => 'admin@peoplemanager.com',
                'password' => Hash::make('SuperSecretPassword'),
            ],
            [
                'name' => 'John',
                'surname' => 'Doe',
                'id_number' => '3210987654321',
                'mobile_number' => '9876543210',
                'date_of_birth' => '01-01-1980',
                'language' => 2,
                'email' => 'john.doe@peoplemanager.com',
                'password' => Hash::make('SuperSecretPassword2'),
            ],
            [
                'name' => 'Jane',
                'surname' => 'Doe',
                'id_number' => '9876543210123',
                'mobile_number' => '4567891230',
                'date_of_birth' => '01-01-1990',
                'language' => 3,
                'email' => 'jane.doe@peoplemanager.com',
                'password' => Hash::make('SuperSecretPassword3'),
            ],
            [
                'name' => 'Test',
                'surname' => 'User',
                'id_number' => '9876543210123',
                'mobile_number' => '4567891230',
                'date_of_birth' => '01-01-2000',
                'language' => 4,
                'email' => 'white.rudi@gmail.com',
                'password' => Hash::make('secret99'),
            ],
        ];

        $interest_count = Interests::all()->count();

        foreach ($users as $user)
        {
            $new_user = User::create($user);

            // for ($i = 0; $i < 2; $i++)
            // {
            //     $interest_id = rand(1, $interest_count);
            //     UserInterest::create([
            //         'user_id' => $new_user->id,
            //         'interest_id' => $interest_id
            //     ]);
            // }

        }


    }
}
