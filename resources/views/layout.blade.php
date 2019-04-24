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
    <link rel="stylesheet" href="{{ url('css/bootstrap-reboot.min.css') }}">
</head>
<body>
<nav class="navbar sticky-top navbar-expand-md navbar-light shadow mb-2" style="background-color:#152542">
    <a class="navbar-brand text-light" href="{{ url('/') }}">
        <img src="{{ url('svg/BSSHSA.jpg') }}" width="35" class="rounded d-inline-block align-top" alt="">
    </a>
@if(\App\Http\Controllers\VariablesController::init()['scnd'])
    @include('layouts.navbar')
</nav>
@if($errors->any())
    @include('layouts.toast')
@endif
    @yield('content')
@else
</nav>
@if($errors->any())
    @include('layouts.toast')
@endif
@hasSection('guest')
    @yield('guest')
@else
    <div class="row justify-content-center btn-outline-danger">Вы не авторизованы</div>
@endif
@endif

@include('layouts.footer')
<script>
    $(document).ready(function () {
        $('.stts').each(function (j, element) {
            $(element).click(function () {
                var name = $(this).parent().attr('title');
                var id = $(this).parent().attr('id');
                var date = $(this).attr('id');
                $('.modal-title').html(name);
                for (k = 0; k < date; k++) {
                    for (i = 0; i < 7; i++) {
                        var statuses = $('.sts' + id + [i] + [k]).attr('title');
                        $('.st' + [i] + [k]).html(statuses);
                    }
                }
                $('#statuses').modal('show');
            });
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('td > a').each(function(i, element){
            $(element).click(function () {
                var id = $(this).parent().attr('id');
                if (id == 'ДЖ') {
                    $('#dzhapaModal .td').val(id);
                    $('#dzhapaModal').modal('show');
                }
                else {
                    $("#sluzhbaModal .thname").val(id);
                    $('#sluzhbaModal').modal('show');
                }
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
