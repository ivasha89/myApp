@extends('layout')

@section('title')
    Мои проекты
@endsection

@section('content')
    <div class="accordion" id="projects">
        <div class="card">
            <div class="card-header h2" id="actual">
                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseActual"
                        aria-expanded="true" aria-controls="collapseActual">
                    <p class="h2">
                        Текущие Проекты
                    </p>
                </button>
            </div>
            <div id="collapseActual" class="collapse show" aria-labelledby="actual" data-parent="#projects">
                <div class="card-body">
                <div class="list-group">
                @foreach($projects as $project)
                    @if($project->actual())
                    <div class="mb-3 shadow">
                        <a href='{{ url("/projects/$project->id") }}' class="list-group-item list-group-item-action">
                            <div class="d-flex justify-content-between">
                                <p class="h5 text-truncate">
                                    {{ $project->title }}
                                </p>
                                <small class="badge expireAt {{ $project->day <= 1 ? 'badge-danger' : 'badge-success'}}"
                                       id="{{$project->expire_at}}"
                                       title="{{ $project->date <= 0 ? 'stop' : 'play' }}">
                                </small>
                            </div>
                        </a>
                        <div class="text-truncate m-1 font-italic">
                            {{ $project->description }}
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
            </div>
            </div>
        </div>
        <div class="card text-muted">
            <div class="card-header" id="archive">
                <button class="btn" type="button" data-toggle="collapse" data-target="#collapseArchive"
                        aria-expanded="true" aria-controls="collapseArchive">
                    <p class="h2 text-muted">
                        Архив
                    </p>
                </button>
            </div>
            <div id="collapseArchive" class="collapse" aria-labelledby="archive" data-parent="#projects">
                <div class="card-body">
                    <div class="list-group">
                    @foreach($projects as $project)
                        @if($project->finished())
                            <div class="mb-3 shadow">
                                <a href='{{ url("/projects/$project->id") }}'
                                   class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between">
                                        <p class="h5 text-truncate">
                                            {{ $project->title }}
                                        </p>
                                        <small class="badge expireAt badge-danger"
                                               id="{{$project->expire_at}}"
                                               title="stop">
                                        </small>
                                    </div>
                                </a>
                                <div class="text-truncate m-1 font-italic">
                                    {{ $project->description }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection