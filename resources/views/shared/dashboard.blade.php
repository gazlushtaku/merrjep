@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('content')
    @auth
        Logged in as : {{ auth()->user()->email }} | <a href="{{ route('logout') }}">Logout</a>
    @endauth 

    @guest
        You are not logged in!
    @endguest 

    <div class="my-5">
        @if(Session::has('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
@endsection