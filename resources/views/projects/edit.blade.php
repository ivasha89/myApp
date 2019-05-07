@extends('layout')

@section('content')
    <div class="justify-content-center">
        <form action='{{ url("/projects/$project->id") }}' method="post">
            @method('PATCH')
            @csrf
        <h3>
            Изменить проект
        </h3>
        <div class="form-group">
            <label class="text-info" for="title"></label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}">
        </div>
        <div class="form-group">
            <label class="text-info" for="description"></label>
            <textarea class="form-control" id="description" name="description">{{ $project->description }}</textarea>
        </div>
            <button type="submit" class="btn btn-outline-info mb-2 float-right">💥️
                Изменить
            </button>
        </form>
        <form action='{{ url("/projects/$project->id") }}' method="post">
            @method('DELETE')
            @csrf
            <div class="d-flex">
            <button type="submit" class="btn btn-outline-danger float-left">
                Удалить
            </button>
            </div>
        </form>
    </div>
@endsection