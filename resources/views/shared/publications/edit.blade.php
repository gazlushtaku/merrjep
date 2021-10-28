@extends('layouts.dashboard')
@section('title')
    Edit: {{ $publication->title }}
@endsection

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
            <h2>Edit: {{ $publication->title }}</h2>
        </div>

        @if(Session::has('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('dashboard.publications.update', ['publication' => $publication->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div class="form-group mb-4">
                <label for="title">Title</label>
                <input type="text" name='title' class="form-control" id="title" value="{{ $publication->title }}" />
                @error('title')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="phone">Phone</label>
                <input type="text" name='phone' class="form-control" id="phone" value="{{ $publication->phone }}" />
                @error('phone')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="email">E-mail</label>
                <input type="text" name='email' class="form-control" id="email" value="{{ $publication->email }}" />
                @error('email')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="price">Price</label>
                <input type="text" name='price' class="form-control" id="price" value="{{ $publication->price }}" />
                @error('price')
                    <div class="alert-small">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group mb-4">
                <label for="description">Description</label>
                <textarea name="description" class="form-control" id="description">{{ $publication->description }}</textarea>
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
            @if($publication->images()->count() > 0)
            <div class="form-group mb-4">
                <table class="table table-bordered">
                @foreach($publication->images()->get() as $image)
                    <tr>
                        <td>
                            <img src="{{ asset('publication_images/'.$image->name) }}" height="80px" /> 
                        </td>
                        <td>
                            <a href="{{ route('dashboard.images.primary', ['publication' => $publication->id, 'image' => $image->id]) }}" class="btn btn-sm btn-link" onclick="return confirm('Are you sure?')">
                                Make primary
                            </a>
                            <a href="{{ route('dashboard.images.delete', ['publication' => $publication->id, 'image' => $image->id]) }}" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                @endforeach
                </table>
            </div>
            @endif
            <button type="submit" class="btn btn-sm btn-primary">Save</button>
        </form>

    </div>
@endsection