@extends('layouts.dashboard')
@section('title', 'Publications')

@section('content')
    @auth
        Logged in as : {{ auth()->user()->email }} | <a href="{{ route('logout') }}">Logout</a>
    @endauth 

    @guest
        You are not logged in!
    @endguest 

    <div class="my-5">
        <div class="d-flex justify-content-between">
            <h2>Publications</h2>
            @role('publisher')
            <a href="{{ route('dashboard.publications.create') }}" class="btn btn-sm btn-primary">
                Create publication
            </a>
            @endrole
        </div>

        @if(Session::has('status'))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
            {{ Session::get('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if($publications->count() > 0)
            <table class="table table bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Created at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($publications as $publication)
                    <tr>
                        <td>{{ $publication->id }}</td>
                        <td>{{ $publication->title }}</td>
                        <td>{{ $publication->created_at }}</td>
                        <td>
                            @role('publisher')
                                @can('show publications')
                                    <a href="{{ route('view-publication', ['slug' => $publication->slug]) }}" class="btn btn-sm btn-link">
                                        View
                                    </a>
                                @endcan 

                                @can('edit publications')
                                    <a href="{{ route('dashboard.publications.edit', ['publication' => $publication->id]) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                @endcan

                                @can('destroy publications')
                                    <form style='display: inline' action="{{ route('dashboard.publications.destroy', ['publication' => $publication->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                @endcan
                            @endrole 

                            @role('admin')
                                @can('update publications')
                                    <a href="{{ route('dashboard.publications.toggle-status', ['publication' => $publication->id]) }}" class="btn btn-sm btn-primary" onclick="return confirm('Are you sure?')">
                                        @if($publication->status == 0)
                                            Approve 
                                        @else 
                                            Disapprove
                                        @endif 
                                    </a>
                                @endcan
                            @endrole 
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else 
            <h4>0 publications</h4>
        @endif
    </div>
@endsection