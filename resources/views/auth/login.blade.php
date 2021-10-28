@extends('layouts.auth')
@section('title', 'Login')

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf 
        <div class="form-group mb-4">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Example: john@smith.com" value="{{ old('email') }}" />
        </div>
        <div class="form-group mb-4">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" id="password" />
        </div>
        <div class="form-group mb-4">
            <input type="checkbox" name="remember" id="remeber_me" value="1" />
            <label for="remeber_me">Remember me</label>
        </div>
        <button type="submit" class="btn btn-sm btn-primary">Login</button>
        <a href="{{ route('register') }}" class="btn btn-sm btn-link">Register</a>
    </form>
@endsection