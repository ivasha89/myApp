<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @auth
            @hasSection('title')
                @yield('title')
            @else
                {{ auth()->user()->name }}
            @endif
        @else
            Гость
        @endauth
    </title>
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-reboot.min.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
<div class="spinner-border text-success"
     style="position: absolute; top: 50%; left: 50%; margin-top: -1.5rem; margin-left: -1.5rem; width: 3rem; height: 3rem;"
     role="status">
    <span class="sr-only">Loading...</span>
</div>
<div id="app">
    <div class="page-header d-none sidenav" ref="mySidenav" id="mySidenav">
        @auth
            @include('layouts.navbar')
        @endauth
    </div>
    <span @click="openNav">
        <img src="{{ url('svg/BSSHSA.jpg') }}" width="35" class="rounded d-inline-block align-top" alt="">
    </span>
    <div class="page-main d-none" ref="main" id="main">
        <div class="container">
            @if($errors->any() || session('message'))
                @include('layouts.toast')
            @endif
            @auth
                    @yield('content')
            @else
                    @yield('guest')
            @endauth
        </div>
    </div>
</div>
@include('layouts.footer')
</body>
</html>
