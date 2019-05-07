@extends('layout')

@section('content')
    <div class="list-group">
        @foreach($projects as $project)
            <a href='{{ url("/projects/$project->id") }}' class="list-group-item list-group-item-action">
                {{ $project->title }}
            </a>
        @endforeach
    </div>
@endsection