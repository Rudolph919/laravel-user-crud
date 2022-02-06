@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="row">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}" class="text-decoration-none text-black-50">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
        </div>

        <div class="row">
        <div class="card col-10">
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user) }}">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name">{{ __('Name') }}</label>

                        <div class="col">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" autocomplete="name" autofocus>

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="surname">{{ __('Surname') }}</label>

                        <div class="col">
                            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ $user->surname }}" autocomplete="surname" autofocus>

                            @error('surname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="id_number">{{ __('ID Number') }}</label>

                        <div class="col">
                            <input id="id_number" type="text" class="form-control @error('id_number') is-invalid @enderror" name="id_number" value="{{ $user->id_number }}" autocomplete="id_number" autofocus>

                            @error('id_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="mobile_number">{{ __('Mobile Number') }}</label>

                        <div class="col">
                            <input id="mobile_number" type="text" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ $user->mobile_number }}" autocomplete="mobile_number" autofocus>

                            @error('mobile_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="date_of_birth">{{ __('Date Of Birth') }}</label>

                        <div class="col">
                            <input id="date_of_birth" type="text" class="datepicker form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ \Carbon\Carbon::parse($user->date_of_birth)->format('d/m/Y') }}" readonly>

                            @error('date_of_birth')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email">{{ __('Email Address') }}</label>

                        <div class="col">
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>



                    <div class="row mb-3">
                        <label for="language">{{ __('Language') }}</label>

                        <div class="col">
                            <select name="language" id="language" class="form-control" title="Select a Language">
                                <option value="" selected>Select a Language</option>
                                {{-- Loop through all languages and create dropdown --}}
                                @foreach ($languages as $language)
                                <option value="{{ $language->id }}" {{ $user->language == $language->id ? 'selected' : null }}> {{ $language->name }} </option>
                                @endforeach
                            </select>

                            @error('language')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    {{-- {{ dd($user_interests) }} --}}

                    <div class="row mb-3">
                        <label for="interests">{{ __('Interests') }}</label>
                        <div class="col">
                            <select name="interests[]" id="interests" class="form-control" title="Select Interests" multiple>
                                {{-- Loop through all interests and create dropdown --}}
                                @foreach ($interests as $interest)
                                    @if (in_array($interest->id, $user_interests))
                                        <option value="{{ $interest->id }}" selected> {{ $interest->name }}</option>
                                    @else
                                        <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('interests')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-0">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update User') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
    </div>
    @endsection

    @section('page-script')

    <script>
        $(document).ready(function() {
            $("#date_of_birth").datepicker({
                changeMonth: true,
                changeYear: true,
                yearRange: '1950:+0',
                dateFormat: 'dd-mm-yy'
            , });
        });

    </script>

    @endsection
