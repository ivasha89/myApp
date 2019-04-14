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
</nav>
    @yield('content')
@else
</nav>
@hasSection('guest')
    @yield('guest')
@else
    {{--@php header("Location: http://".request()->server('HTTP_HOST')."/");
    @endphp--}}
    <div class="row justify-content-center btn-outline-danger">Вы не авторизованы</div>
@endif
@endif

@if($errors->any())
    @include('layouts.toast')
@endif

@include('layouts.footer')
<script>
    $(document).ready(function () {
        $('td > a').each(function(i, element){
            $(element).click(function () {
                var id = $(this).parent().attr('id');
                if (id == 'ДЖ') {
                    $("#dzhapaModal .td").val(id);
                    $('#dzhapaModal').modal('show');
                }
                else {
                    $("#sluzhbaModal .td").val(id);
                    $('#sluzhbaModal').modal('show');
                }
                console.log($(this).attr('id'));
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('#timeSet').click(function () {
            $('#timeForm').modal('show')
        });
    });
</script>
<script>
    $(function () {
        $('#checkbox0').click(function () {
            if ($(this).is(':checked')) {
                $('#control0 .custom-control-input').attr("checked", "checked");
            }
            else {
                $('#control0 .custom-control-input').removeAttr("checked");
            }
        });
        $('#checkbox1').click(function () {
            if ($(this).is(':checked')) {
                $('#control1 .custom-control-input').attr("checked", "checked");
            } else {
                $('#control1 .custom-control-input').removeAttr("checked");
            }
        });
    });
</script>
{{--<script>
    $(function () {
        for (var i = 0; i < 2; i++) {
        $('#checkbox'[i]).click(function () {
            if ($(this).is(':checked')) {
                $('#control'[i]).children('.custom-control-input').attr("checked", "checked");
            } else {
                $('#control'[i]).children('.custom-control-input').removeAttr("checked");
            }
        });
        }
    });
</script>--}}
</body>
</html>
