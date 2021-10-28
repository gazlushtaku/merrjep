@extends('layouts.dashboard')
@section('title', 'Users')

@section('content')
    @auth
        Logged in as : {{ auth()->user()->email }} | <a href="{{ route('logout') }}">Logout</a>
    @endauth 

    @guest
        You are not logged in!
    @endguest 

    <div class="my-5">
        <h2>Users</h2>
        @if(Session::has('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @if($users->count() > 0)
            <table class="table table bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            @role('admin')
                                @can('destroy users')
                                    <form action="{{ route('dashboard.users.destroy', ['user' => $user->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan
                            @endrole 
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else 
            <h4>0 users</h4>
        @endif
    </div>
@endsection