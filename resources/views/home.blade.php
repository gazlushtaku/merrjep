@extends('layouts.web')
@section('title', 'Homepage')

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
}

.card-title {
    line-height: 30px;
    min-height: 60px;
}
@endsection

@section('content')
    @if($publications->count() > 0)
    <div class="row">
        @foreach($publications as $publication)
        <div class="col-md-3 col-sm-12 mb-4">
            <div class="card">
                @if(!is_null($publication->images()->where('is_primary', 1)->first()))
                    <div class="card-img-top" style="background-image: url({{ asset('publication_images/'.$publication->images()->where('is_primary', 1)->first()->name) }});"></div> 
                @else 
                    <div class="card-img-top" style="background-image: url({{ asset('publication_images/'.$publication->images()->first()->name) }});"></div> 
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $publication->title }}</h5>
                    <p class="card-text">{{ substr($publication->description, 0, 80) }}</p>
                    <a href="{{ route('view-publication', ['slug' => $publication->slug]) }}" class="btn btn-primary">Details</a>
                </div>
            </div>
        </div>
        @endforeach 
    </div>
    {{ $publications->links() }}
    @else 
        <p>0 publications</p> 
    @endif
@endsection