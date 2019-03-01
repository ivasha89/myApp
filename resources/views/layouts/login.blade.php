@extends('layouts.header)

@section('content')
    <div class="row justify-content-center p-2">
        <div style="width:300px">
            <div class="card text-center border-primary">
                <div class="card-header text-white bg-primary">
                    Пожалуйста введите свои данные, чтобы войти
                </div>
                <div class="card-body">
                    <form method="post" action="{{ url('login') }}">
                        @csrf
                    <div class="form-group">
                        <label for="ysl">
                            Ваше имя
                        </label>
                        <input type="text" class="form-control{{ $errors->has('user') ? ' is-invalid' : '' }}" id="ysl" value="{{ old('user') }}" maxlength="32" name="user" required>

                        @if ($errors->has('user'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('user') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="yep">
                            Пароль
                        </label>
                        <input type="password" class="form-control{{ $errors->has('pass') ? ' is-invalid' : '' }}" id="yep" placeholder="Пароль" maxlength="16" name="pass" required>

                        @if ($errors->has('pass'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('pass') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    Запомнить
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-primary" value="Вход">
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection