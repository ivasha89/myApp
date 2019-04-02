<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge, chrome=1">

    <title>
        {{ \App\Http\Controllers\VariablesController::init()['frst'] }}
    </title>

    <link rel="stylesheet" href="{{ url('css/bootstrap.min.css') }}">
</head>
<body>
<nav class="navbar sticky-top navbar-expand-md navbar-light shadow mb-2" style="background-color:#152542">
    <a class="navbar-brand text-light" href="{{ url('/') }}">
        <img src="{{ url('svg/BSSHSA.jpg') }}" width="35" class="rounded d-inline-block align-top" alt="">
    </a>
    @if(\App\Http\Controllers\VariablesController::init()['scnd'])
        @include('layouts.navbar')
    @endif
</nav>

@if($errors->any())
    @include('layouts.toast')
@endif

@yield('content')

@include('layouts.footer')
</body>
</html>
