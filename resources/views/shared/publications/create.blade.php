@extends('layouts.dashboard')
@section('title', 'Create publication')

@section('css')
    .alert-small {
        font-size: 12px;
        color: red;
        padding-top: 10px;
    }
@endsection 

@section('content')
    @auth
        Logged in as : {{ auth()->user()->email }} | <a href="{{ route('logout') }}">Logout</a>
    @endauth 

    @guest
        You are not logged in!
    @endguest 

    <div class="my-5">
        <div class="d-flex justify-content-between">
            <h2>Create publication</h2>
        </div>

        @if(Session::has('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('dashboard.publications.store') }}" method="POST" enctype="multipart/form-data">
            @csrf 
            <div class="form-group mb-4">
                <label for="title">Title</label>
                <input type="text" name='title' class="form-control" id="title" value="{{ old('title') }}" />
                @error('title')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="phone">Phone</label>
                <input type="text" name='phone' class="form-control" id="phone" value="{{ old('phone') }}" />
                @error('phone')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="email">E-mail</label>
                <input type="text" name='email' class="form-control" id="email" value="{{ old('email') }}" />
                @error('email')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="price">Price</label>
                <input type="text" name='price' class="form-control" id="price" value="{{ old('price') }}" />
                @error('price')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                @error('description')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="images">Images</label>
                <input type="file" class="form-control" name="images[]" id="images" multiple>
                @error('images')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </form>

    </div>
@endsection