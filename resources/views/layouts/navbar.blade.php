@php
    $user = auth()->user();
@endphp

<button @click="closeNav" class="btn closebtn">&times;</button>
<a href='{{ url("/$user->id") }}'>Моя страница</a>
<a href='{{ url("/$user->id/projects") }}'>Мои проекты</a>
<a href="{{ url('/chat') }}">Чат</a>
<a href="{{ url('/slbs') }}">Службы</a>
<a href="#" data-toggle="tooltip" title="В разработке">Служения</a>
{{--
@php
    $user = auth()->user();
@endphp

<button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="nvSpCnt" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
    </span>
</button>
<div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" id="{{$user->id}}mark" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                {{ $user->name }}
                <span class="sr-only">
                    (current)
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="{{$user->id}}mark" style="background-color:#152542">
                <a class="dropdown-item text-light" href='{{ url("/$user->id") }}'>
                    Моя станица
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-light" href='{{ url("/$user->id/projects") }}'>
                    Мои Проекты
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-light" href='{{ url("/projects/create") }}'>
                    Создать свой проект
                </a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-light" id="arati" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
                Службы-арати
            </a>
            <div class="dropdown-menu" aria-labelledby="arati" style="background-color:#152542">
                <a class="nav-link text-light" href="{{ url('/slbs') }}">
                    Таблица
                </a>
                <div class="dropdown-divider"></div>
                <a class="nav-link text-light" href="{{ url('/slbs/statistic') }}">
                    Статистика
                </a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href={{ url('/logout') }}>
                Выход
            </a>
        </li>
    </ul>
</div>--}}
