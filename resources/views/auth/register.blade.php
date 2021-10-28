@extends('layouts.auth')
@section('title', 'Register')

@section('content')
    <form action="{{ route('register') }}" method="POST">
        @csrf 
        <div class="form-group mb-4">
            <label for="name">Fullname:</label>
            <input type="name" name="name" id="name" class="form-control" placeholder="Example: John Smith" value="{{ old('name') }}" />
        </div>
        <div class="form-group mb-4">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="Example: john@smith.com" value="{{ old('email') }}" />
        </div>
        <div class="form-group mb-4">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password" />
        </div>
        <div class="form-group mb-4">
            <label for="password_confirm">Confirm password:</label>
            <input type="password" name="password_confirm" class="form-control" id="password_confirm" />
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Register</button>
        <a href="{{ route('login') }}" class="btn btn-sm btn-link">Login</a>
    </form>
@endsection