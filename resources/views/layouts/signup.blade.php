<form action="{{ url('signup') }}" method="post">
    {{csrf_field()}}

    <div class="row justify-content-center p-2">
        <div style="width:330px">
            <div class="card text-center border-secondary">
                @if (!$hj)
                <div class="card-header bg-info text-white">
                    Пожалуйста введите маха-секретное кодовое слово
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="password" class="form-control" id="yep" placeholder="код" maxlength="16" name="psrd" required>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mb-2">
                        <input class="btn btn-outline-success" type="submit" name="rt" value="ВВОД" formmethod="post">
                    </div>
                </div>
                @else
                <div class="card-header text-white bg-info">
                    Регистрация
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="text-info" for="name">
                            Ваше Имя на русском
                        </label>
                        <input type="text" class="form-control" id="name" placeholder="Имя Фамилия" name="nm" autocapitalize="on" required>
                    </div>
                    <div class="form-group">
                        <label class="text-info" for="psw">
                            Пароль
                        </label>
                        <input type="password" class="form-control" id="psw" name="ps" maxlength="16" required>
                    </div>
                    <div class="form-group">
                        <label class="text-info" for="sn">
                            Духовное имя
                        </label>
                        <input type="text" class="form-control" id="sn" placeholder="Аласйа Вибхуноти дас" name="sn" autocapitalize="on">
                    </div>
                    <div class="form-group">
                        <label class="text-info" for="idy">
                            ID
                        </label>
                        <input type="text" class="form-control" id="idy" placeholder="B17004" name="id" required>
                    </div>
                    <div class="col btn-group btn-group-toggle custom-control-inline mb-2" data-toggle="buttons">
                    <label class="btn btn-secondary active">
                        <input type="radio"  name="rt" class="custom-control-input" id="usr" value="usr" autocomplete="off" checked>Брахмачари
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio"  name="rt" class="custom-control-input" id="adm" value="adm" autocomplete="off">Не брахмачари
                    </label>
                </div>
                <div class="mb-2">
                    <input class="btn btn-outline-success" type="submit" name="crt" value="СОЗДАТЬ" formmethod="post">
                </div>
            </div>
            <div class="card-footer">
                <a class="border-dark text-info">
                    {{ $error }}
                </a>
            </div>
            @endif
        </div>
    </div>
    </div>
</form>