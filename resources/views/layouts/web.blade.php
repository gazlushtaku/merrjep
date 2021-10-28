<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | MerrJep</title>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <style>
        @yield('css')
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">MerrJep</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('home') }}">Home</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('dashboard') }}">Dashboard</a>
            </li>
            @endauth 
            @guest 
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('register') }}">Register</a>
            </li>
            @endguest
        </ul>
        <form class="d-flex" action="{{ route('home') }}">
            <input class="form-control me-2" type="search" name="q" placeholder="Search" aria-label="Search" @if(Request::input('q')) value="{{ Request::input('q') }}" @endif>
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        </div>
    </div>
    </nav>
    
    <div class="container my-4">
        @yield('content')
    </div>

    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    <script>
        @yield('js')
    </script>
</body>
</html>