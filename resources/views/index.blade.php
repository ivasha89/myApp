@extends('layouts.header')

@section('content')
    <div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
	    <div class="container">
		    <div class="row">
			    <div class="col-9">
				    <h1 class="display-6">
					    Добро пожаловать в {{ $appname }}
                    </h1>
@if($loggedin)
	                <p class="lead">
	                    {{ $usrstr }}, дорогой, вы уже вошли
	                </p>
@else
	                <p class="lead">
    	                Дорогой Гость! Пожалуйста зарегистрируйтесь или войдите, чтобы пользоваться сайтом
    	            </p>
@endif
                </div>
                <div class="col-3">
                    <img src="{{ url('svg/BSSHSA.jpg') }}" width="195" class="img-thumbnail shadow" alt="">
                </div>
            </div>
            <hr class="row my-4">
                <p>
                    <button type="button" class="dropdown-item btn-lg btn mb-2" data-toggle="modal" data-target="#exML">
                        Инструкция
                    </button>
@if($loggedin)
                    <a class="dropdown-item btn-lg mb-2" href="{{ url('table') }}">
                        Домой
                    </a>
                    <a class="dropdown-item btn-lg mb-2" href="{{ url('logout') }}">
                        Выход
                    </a>
@else
                    <a class="dropdown-item btn-lg mb-2" href="{{ url('login') }}">
                        Вход
                    </a>
                    <a class="dropdown-item btn-lg mb-2" href="{{ url('signup') }}">
                        Регистрация
                    </a>
@endif

                </p>
@include('layouts.instruction')

        </div>
    </div>
@endsection
@extends('layouts.footer')
