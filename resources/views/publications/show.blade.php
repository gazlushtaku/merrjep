@extends('layouts.web')
@section('title')
    {{ $publication->title }}
@endsection 

@section('css')
nav[role="navigation"] div:first-child {
    display: none;
}

nav[role="navigation"] div:last-child {
    margin-top: 40px;
}

svg {
    width: 20px;
}

.card-img-top {
    width: 100%; 
    height: 200px;  
    background-size: cover; 
    background-position: center center;
}

.img-fluid {
    width: 100% !important;
}

.h-100 {
    height: 100px !important;
    display: inline-block;
}

#thumbs img {
    opacity: .4;
}

.active {
    opacity: 1 !important;
}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-12 mb-4">
            @if($publication->images()->count() > 0)
                <div id="gallery" class="mb-4">
                    @if(!is_null($publication->images()->where('is_primary', 1)->first())) 
                        <img src="{{ asset('publication_images/'.$publication->images()->where('is_primary', 1)->first()->name) }}" class="img-fluid" alt=""> 
                    @else 
                        <img src="{{ asset('publication_images/'.$publication->images()->first()->name) }}" /> 
                    @endif
                </div>
                <div id="thumbs">
                @foreach($publication->images()->get() as $image)
                    <img src="{{ asset('publication_images/'.$image->name) }}" class="h-100 mr-2 slider-image" alt="{{ $publication->title }}" />
                @endforeach
                </div>
            @else 
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1200px-No-Image-Placeholder.svg.png" class="img-fluid" alt="{{ $publication->title }}" />
            @endif
        </div>
        <div class="col-md-6 col-sm-12 mb-4">
            <h2>{{ $publication->title }}</h2>
            <p>Date: {{ $publication->created_at }} | Views: {{ $publication->total_views }}</p>
            <p class="mt-4"><strong>{{ $publication->price }} EUR</strong></p>
            <div class="mt-4">
                {{ $publication->description }}
            </div>
            <div class="mt-4">
                <p>Contact publisher:</p>
                <a href="mailto:{{ $publication->email }}">{{ $publication->email }}</a>
                <br>
                <a href="tel:{{ $publication->phone }}">{{ $publication->phone }}</a>
            </div>
        </div>
    </div>
@endsection

@section('js')
    const images = document.querySelectorAll('.slider-image')
    images[0].classList.add('active')

    images.forEach(image => {
        image.addEventListener('click', e => {
            document.querySelector('#gallery > img').src = e.target.src
            images.forEach(image => image.classList.remove('active'))
            e.target.classList.add('active')
        })
    });
@endsection 