<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">

    <title>
        @auth
            {{ auth()->user()->name }}
        @endauth
        @guest
            Гость
        @endguest
    </title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-reboot.min.css') }}">
</head>
<body>
<div class="spinner-border text-success"
     style="position: absolute; top: 50%; left: 50%; margin-top: -1.5rem; margin-left: -1.5rem; width: 3rem; height: 3rem;"
     role="status">
    <span class="sr-only">Loading...</span>
</div>
    <header class="page-header d-none">
        <nav class="navbar sticky-top navbar-expand-md navbar-light shadow mb-2" style="background-color:#152542">
            <a class="navbar-brand text-light" href="{{ url('/') }}">
                <img src="{{ url('svg/BSSHSA.jpg') }}" width="35" class="rounded d-inline-block align-top" alt="">
            </a>
        @auth
            @include('layouts.navbar')
        @endauth
        </nav>
    </header>
    <main class="page-main d-none">
        <div class="container">
            @if($errors->any())
                @include('layouts.toast')
            @endif
            @auth
                @hasSection('content')
                    @yield('content')
                    @else
                        <div class="d-flex justify-content-center">
                            <a href="{{ url('/logout') }}" class="btn btn-outline-danger">
                                Нужно выйти
                            </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img width="300px" src="{{ url('/svg/ShP.jpg') }}"
                                 class="rounded-circle shadow"
                                 alt="...">
                        </div>
                    @endif
            @endauth
            @guest
                @hasSection('guest')
                    @yield('guest')
                @else
                        <div class="d-flex justify-content-center">
                                <a href="{{ url('/login') }}" class="btn btn-outline-danger mb-2">
                                    Нужно войти
                                </a>
                        </div>
                        <div class="d-flex justify-content-center">
                            <img width="400px" src="{{ url('/svg/krishnaRadhe.jpg') }}" class="rounded-circle shadow"
                                 alt="...">
                        </div>
                @endif
            @endguest
        </div>
    </main>
@include('layouts.footer')
</body>
</html>
