@php
    $user = auth()->user();
@endphp

<button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="nvSpCnt" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">
    </span>
</button>
<div class="collapse navbar-collapse" id="navbar">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link text-light" href='{{ url("/$user->id") }}'>
                {{ $user->name }}
                <span class="sr-only">
                    (current)
                </span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/slbs') }}">
                Таблица посещаемости
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href="{{ url('/slbs/statistic') }}">
                Статистика посещаемости
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href={{ url('/logout') }}>
                Выход
            </a>
        </li>
    </ul>
</div>