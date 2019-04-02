<button class="navbar-toggler bg-info" type="button" data-toggle="collapse" data-target="#nvSpCnt" aria-controls="nvSpCnt" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon">
				</span>
</button>
<div class="collapse navbar-collapse" id="nvSpCnt">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <a class="nav-link text-light" href="{{ url('slbs')}}">
                Таблица посещаемости
                <span class="sr-only">
								(current)
							</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href={{ url('week') }}>
                Отметиться
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-light" href={{ url('logout') }}>
                Выход
            </a>
        </li>
    </ul>
    <form class="form-inline" action={{ url('mysql') }} method="post">
        <div class="input-group">
            <input class="form-control" type="search" name="search" placeholder="Выберите тип поиска" aria-label="Search">
            <div class="input-group-append">
                <input class="btn btn-outline-success" type="submit" name="submit" value="Поиск">
                <button type="button" class="btn btn-info dropdown-toggle dropdown-toggle-split" id="drpdwnMnRfr" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-reference="parent">
								<span class="sr-only">
									Toggle Dropdown
								</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="drpdwnMnRfr">
                    <div class="dropdown-item">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" data-placement="right" title="Нужно указать точные имена через запятую">
                            <label class="btn btn-secondary">
                                <input class="form-check-input mr-auto" type="radio" name="srch" id="name" value="name" autocomplete="off" checked>по имени
                            </label>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" data-placement="top" title="Поиск по знакам посещаемости +,o,n,c,-,b,/">
                            <label class="btn btn-secondary">
                                <input class="form-check-input mr-auto" type="radio" name="srch" id="sign" value="sign">по знаку
                            </label>
                        </div>
                    </div>
                    <div class="dropdown-item">
                        <div class="btn-group btn-group-toggle" data-toggle="buttons" data-placement="top" title="В формате year_mm_dd">
                            <label class="btn btn-secondary">
                                <input class="form-check-input mr-auto" type="radio" name="srch" id="date" value="date">по дате
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>