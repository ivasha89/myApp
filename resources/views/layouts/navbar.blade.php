<button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#nvSpCnt" aria-controls="nvSpCnt" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
				</span>
</button>
<div class="collapse navbar-collapse" id="nvSpCnt">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link text-light" href="{{ url('/slbs')}}">
                Таблица посещаемости
                <span class="sr-only">
								(current)
							</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href={{ url('/week') }}>
                Отметиться
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href={{ url('/logout') }}>
                Выход
            </a>
        </li>
    </ul>
</div>