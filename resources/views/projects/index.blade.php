@extends('layout')

@section('title')
    Мои проекты
@endsection

@section('content')
    <div class="list-group">
        @foreach($projects as $project)
            <a href='{{ url("/projects/$project->id") }}' class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $project->title }}</h5>
                    <small>3 days ago</small>
                </div>
            </a>
        @endforeach
    </div>
@endsection