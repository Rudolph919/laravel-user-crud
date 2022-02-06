@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">
        <div class="col-10">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none text-black-50">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Show User Details</li>
                </ol>
            </nav>
        </div>
        <div class="col-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/users/{{$user->id}}/edit" class="text-decoration-none text-black-50"><i class="far fa-edit"></i>Edit User</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body row">
                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>Surname</label>
                    <input type="text" name="surname" value="{{ $user->surname }}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>ID Number</label>
                    <input type="text" name="id_number" value="{{ $user->id_number }}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile_number" value="{{ $user->mobile_number }}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>User Email</label>
                    <input type="text" name="email" value="{{ $user->email }}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>Date Of Birth</label>
                    <input type="text" name="date_of_birth" value="{!! date('d/m/Y', strtotime($user->date_of_birth)) !!}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>Language</label>
                    <input type="text" name="language" value="{{ $user->language_name->name }}" class="form-control" readonly>
                </div>

                <div class="form-group col-sm-12 mb-3" element="div">
                    <label>Interests</label>
                    @if($user->user_interests->count())
                        @foreach ($user->user_interests as $interest)
                            <li>
                                {{ $interest->interest_name->name }}
                            </li>
                        @endforeach
                    @else
                        <div class="row">
                            <p class="text-danger">No interests have been set</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
