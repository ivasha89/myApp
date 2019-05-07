@extends('layout')

@section('content')
    <div class="mb-2">
        <div class="text-wrap">
            <h3>
                {{ $project->title }}
            </h3>
        </div>
        <div class="text-muted">
            {{ $project->description }}
        </div>
    </div>
    <div class="d-flex mb-2">
        <button class="btn btn-outline-info mb-2 float-right"
                onclick="document.location.href='{{ url("/projects/$project->id/edit") }}'">
            Изменить проект
        </button>
    </div>
    <div class="card mb-2">
        @if($project->tasks->count())
            @foreach($project->tasks as $task)
                <form method="post" action='{{ url("/tasks/$task->id") }}' class="m-2">
                    @method('PATCH')
                    @csrf
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="completed{{$task->id}}" name="completed" onchange="this.form.submit()" {{$task->completed ? 'checked' : ''}}>
                        <label class="custom-control-label" for="completed{{$task->id}}" style="text-decoration:{{$task->completed ? 'line-through' : ''}}">
                            {{ $task->description }}
                        </label>
                    </div>
                </form>
            @endforeach
        @endif
    </div>
    <form method="post" action='{{ url("/projects/$project->id/tasks") }}' class="card p-2">
        @csrf
        <div class="form-group mb-2">
            <label class="text-info" for="description">Добавить задачу</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Новая задача" required>
        </div>
        <div class="d-flex">
            <button class="btn btn-outline-info float-right" type="submit">
                Добавить к проекту
            </button>
        </div>
    </form>
@endsection