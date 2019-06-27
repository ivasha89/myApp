@extends('layout')

@section('title')
    {{ auth()->user()->name. ". Проект ".  $project->title }}
@endsection
@section('content')
    <div class="accordion mb-2" id="accordionTitle">
        <div class="card">
            <div class="text-wrap" id="heading">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDescription"
                        aria-expanded="true" aria-controls="collapseDescription">
                    <h3 class="word-break">
                    {{ $project->title }}
                    </h3>
                </button>
            </div>
            <div id="collapseDescription" class="collapse" aria-labelledby="heading" data-parent="#accordionTitle">
                <div class="card-body text-muted font-italic">
                    {{ $project->description }}
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex mb-2">
        <button class="btn btn-outline-info mb-2 float-right"
                onclick="document.location.href='{{ url("/projects/$project->id/edit") }}'">
            Изменить проект
        </button>
    </div>
    <div class="mb-2">
        @if($project->tasks->count())
            @foreach($project->tasks as $task)
                <form method="post" action='{{ url("/tasks/$task->id") }}' class="card mb-1">
                    @method('PATCH')
                    @csrf
                    <div class="custom-control custom-checkbox m-1">
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