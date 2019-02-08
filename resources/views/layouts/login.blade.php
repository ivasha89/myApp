<form method="post" action="{{ url('login') }}">
    {{csrf_field()}}

    <div class="row justify-content-center p-2">
        <div style="width:300px">
            <div class="card text-center border-primary">
                <div class="card-header text-white bg-primary">
                    Пожалуйста введите свои данные, чтобы войти
                </div>
                <div class="card-body">
                    <div class="form-group">
                        {{ $error }}
                        <label for="ysl">
                            Ваше имя
                        </label>
                        <input type="text" class="form-control" id="ysl" placeholder="Ваш логин" maxlength="32" name="user" required>
                    </div>
                    <div class="form-group">
                        <label for="yep">
                            Пароль
                        </label>
                        <input type="password" class="form-control" id="yep" placeholder="Пароль" maxlength="16" name="pass" required>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Вход">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>