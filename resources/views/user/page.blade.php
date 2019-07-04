@extends('layout')

@section('title')
    {{ $user->name }}
@endsection

@section('content')
{{--    @if(($alrt->first() == null) && ($user->id == auth()->id()))--}}
{{--        <div class="shadow alert alert-info alert-dismissible fade show mb-3" role="alert">--}}
{{--            <p class="lead text-center">--}}
{{--                Здравствуйте {{ $user->name }}, это ваша страница. Доброго утра и приятного дня.--}}
{{--            </p>--}}
{{--            <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                <span aria-hidden="true">--}}
{{--                    &times;--}}
{{--                </span>--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    @endif--}}
    <div class="d-flex bg-light rounded flex-column">
        <div class="d-flex flex-row">
            <div class="w-25 mb-1">
                <div class="card mr-1">
                    <img src='{{ url("/svg/".$user->id.".jpg") }}' alt="" width="255" class="rounded-circle img-thumbnail">
                    <footer class="blockquote-footer lastSeen font-weight-bold text-dark p-2" id="{{ $user->lastSeen_at }}"></footer>
                </div>
            </div>
            <div class="w-75 list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-person-list" data-toggle="list"
                   href="#list-person" role="tab" aria-controls="home">Личные данные</a>
                <a class="list-group-item list-group-item-action" id="list-projects-list" data-toggle="list"
                   href="#list-projects" role="tab" aria-controls="projects">Мои проекты</a>
            </div>
        </div>
        <div class="flex-row">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-person" role="tabpanel"
                     aria-labelledby="list-person-list">
                    <ul class="list-group list-group-flush">
                        @if($user->brah->sname)
                            <li class="list-group-item">
                                <a class="badge badge-light">
                                   Духовное Имя
                                </a>
                                <span class="float-right">
                                    {{$user->brah->sname}}
                                </span>
                            </li>
                        @endif
                        <li class="list-group-item">
                            <a class="badge badge-light">
                                Имя
                            </a>
                            <span class="float-right">
                                {{$user->name}}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <a class="badge badge-light">
                                Город
                            </a>
                            <span class="float-right">
                                {{$user->brah->city}}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <a class="badge badge-light">
                                Телефон
                            </a>
                            <a class="float-right" href="tel:{{$user->brah->tel}}">
                                {{$user->brah->tel}}
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a class="badge badge-light">
                                Дней в ашраме
                            </a>
                            <span class="float-right">
                                {{ $daysInAshram }}
                            </span>
                        </li>
                        <li class="list-group-item">
                            <a class="badge badge-light">
                                Прочитано джапы
                            </a>
                            <span class="float-right">
                                {{ $allDzhapa }}
                            </span>
                        </li>
                    </ul>
                </div>
                <div class="tab-pane fade" id="list-projects" role="tabpanel"
                     aria-labelledby="list-projects-list">
                    <div class="accordion" id="projects">
                        <div class="card">
                            <div class="card-header h2" id="actual">
                                <button class="btn" type="button" data-toggle="collapse"
                                        data-target="#collapseActual"
                                        aria-expanded="true" aria-controls="collapseActual">
                                    <a class="h4">
                                        Текущие Проекты
                                    </a>
                                </button>
                            </div>
                            <div id="collapseActual" class="collapse show" aria-labelledby="actual"
                                 data-parent="#projects">
                                <div class="card-body">
                                    <div class="list-group">
                                        @if($ongoingProjects)
                                            @foreach($ongoingProjects as $project)
                                                <div class="mb-3 shadow">
                                                    <a href='{{ url("/projects/$project->id") }}'
                                                       class="list-group-item list-group-item-action">
                                                        <div class="d-flex justify-content-between">
                                                            <p class="h5 text-dark text-truncate">
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
                                            @endforeach
                                        @else
                                            Пусто
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card text-muted">
                            <div class="card-header" id="archive">
                                <button class="btn" type="button" data-toggle="collapse"
                                        data-target="#collapseArchive"
                                        aria-expanded="true" aria-controls="collapseArchive">
                                    <a class="h4 text-muted">
                                        Архив
                                    </a>
                                </button>
                            </div>
                            <div id="collapseArchive" class="collapse" aria-labelledby="archive"
                                 data-parent="#projects">
                                <div class="card-body">
                                    <div class="list-group">
                                        @if($doneProjects)
                                            @foreach($doneProjects as $project)
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
                                            @endforeach
                                            @else
                                            Пусто
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        @if($user->id == auth()->id())
        @if($currentSlb)
            <div class="text-muted mb-2">
                Отметиться на службе
            </div>
        @endif
        <form action="{{ url('/slbs') }}" method="post">
            @csrf
            <div class="row justify-content-center mb-3">
                @if($currentSlb == 'ДЖ')
                    <input type="hidden" name="slba" id="dzhapa" value="">
                    <div class="btn-group-toggle col-6" data-toggle="buttons">
                        <label class="btn btn-secondary" for="sttsn">
                            <input type="radio" name="status"
                                   class="custom-control-input" id="sttsn" value="n"
                                   onchange="this.form.submit()">n
                        </label>
                        <label class="btn btn-secondary" for="sttsc">
                            <input type="radio" name="status"
                                  class="custom-control-input" id="sttsc" value="c"
                                   onchange="this.form.submit()">c
                        </label>
                        <label class="btn btn-secondary" for="sttsb">
                            <input type="radio" name="status"
                                   class="custom-control-input" id="sttsb" value="b"
                                   onchange="this.form.submit()">b
                        </label>
                    </div>
                    <div class="col-6 mb-2">
                        <input type="number" name="statusNumber" onfocusout="this.form.submit()"
                               class="form-control"
                               placeholder="в лакхах" min="1" max="16">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-danger" name="delete">
                            ❌
                        </button>
                    </div>
                @elseif($currentSlb)
                    <input type="hidden" name="slba" id="sluzhba" value="">
                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                        @foreach($stts as $key => $stt)
                            <label class="btn btn-secondary" for="stts{{ $key }}">
                                <input type="radio" name="status" onchange="this.form.submit()"
                                       class="custom-control-input" id="stts{{ $key }}"
                                       value="{{ $key }}">{{ $key }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-danger" name="delete">
                            ❌
                        </button>
                    </div>
                @endif
            </div>
        </form>
        <div class="flex-fill">
            <div class="text-muted mb-2" onclick="document.location.href='{{ url("/projects/create") }}'">
                Создать Проект
            </div>
            @if($user->projects->count())
                <div class="text-muted mb-2" onclick="document.location.href='{{ url("/$user->id/projects") }}'">
                    Личные Проекты
                </div>
            @endif
        </div>
        @endif
    </div>
@endsection