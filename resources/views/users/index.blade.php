@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-10">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Users</li>
                    </ol>
                </nav>
            </div>

            <div class="col-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('users.create') }}" class="text-decoration-none text-black-50">
                                <i class="fa fa-plus-circle"></i>&nbsp;Create New User
                            </a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="card-body">
            @if ($users->count())
            <table id="users" class="table table-hover table-striped table-responsive-sm table-sm compact">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Date Of Birth</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->surname }}</td>
                        <td>{{ $user->email }}</td>
                        {{-- <td>{{ $user->date_of_birth }}</td> --}}
                        <td>{{ date('d/m/Y', strtotime($user->date_of_birth)) }}</td>
                        <td>{{ $user->created_at->toFormattedDateString() }}</td>
                        <td>
                            <span>
                                <a href="{{ route('users.show', $user) }}" title="Show User Details" class="btn btn-outline-info">
                                    Show
                                </a>
                            </span>
                            <span>
                                <a href="{{ route('users.edit', $user) }}" title="Edit User Details" class="btn btn-outline-warning">
                                    Edit
                                </a>
                            </span>
                            <span>
                                <form method="post" action="{{ route('users.destroy', $user) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <a onclick="if(confirm('Really delete this user?')) { this.parentNode.submit(); }" title="Delete this User" class="btn btn-outline-danger">
                                        Delete
                                    </a>
                                </form>
                            </span>
                    </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Surname</th>
                        <th>Email</th>
                        <th>Date Of Birth</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                {{ $users->links() }}
            </div>

            @else
            <p>No Search Results Found...</p>
            @endif
        </div>
    </div>
</div>
@endsection

