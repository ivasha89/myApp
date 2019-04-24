@extends('layout')

@section('content')
{{--    @dd($nextDay, $previousDay, $now)--}}
    @if($alrt->first() == null)
        <div class="container shadow alert alert-info alert-dismissible fade show" role="alert">
            <div class="d-flex justify-content-center">
                <p class="lead ">
                    Здравствуйте. Доброго утра и приятного дня.
                </p>
            </div>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
    @endif
    <div class="container bg-white rounded">
        <form method="get" action="{{ url('/slbs') }}">
            <div class="modal fade" id="timeForm">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header bg-info justify-content-center">
                            Изменить дату
                        </div>
                        <div class="modal-body">
                            <input class="form-control mb-2" onchange="this.form.submit()" type="date"
                                   name="changeDate" value="{{$y->format('Y-m-d')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="alert alert-info shadow">
                    <div class="row">
                        <a class="col-1 btn float-left" href='{{ url("/slbs?changeDate=$previousDay") }}'>
                            <img style="height: 100px; width: 50px;" src="{{ url('/svg/prev') }}.jpg"
                                 class="rounded-circle" alt="...">
                        </a>
                        <div class="col-10 row justify-content-center">
                            <p class="col-12 h1 text-center" id="timeSet">
                                {{ $days[$y->format('N')] . $y->format(' d ') . $months[$y->format('n')] . $y->format(' Y') }}
                            </p>
                            <a href='{{ url("/slbs?changeDate=$now") }}'>
                                <button type="button" class="btn btn-outline-info">
                                    Сегодня
                                </button>
                            </a>
                        </div>
                            <a class="col-1 btn float-right" href='{{ url("/slbs?changeDate=$nextDay") }}'>
                                <img style="height: 100px; width: 50px" src="{{ url('/svg/next') }}.jpg" class="rounded-circle"
                                     alt="...">
                            </a>
                    </div>
                </div>
            </div>
            @if(session('right') == 'root')
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="ok" value="admin" name="mode" onchange="this.form.submit()">
                    <label class="custom-control-label" for="ok">
                        admin mode
                    </label>
                </div>
            @endif
        </form>
        <form action="{{ url('/slbs') }}" method="post">
            @csrf
            <div class="row justify-content-center rounded">
                <table class="col-12 table table-sm table-striped table-bordered shadow">
                    <caption>
                        Список посещаемости
                    </caption>
                    <thead class="bg-info">
                        <tr>
                            <th scope="col">
                                @if($mode)
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" id="checkbox0" class="cl custom-control-input">
                                    <label class="custom-control-label float-right" for="checkbox0">
                                        Службы
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" id="checkbox1" class="cl custom-control-input">
                                    <label class="custom-control-label" for="checkbox1">
                                @endif
                                        Имя
                                    </label>
                                </div>
                            </th>
        @foreach($slba as $slb)
                            <th scope='col'>
                                @if($mode)
                                    <div class="custom-control custom-switch" id="control0">
                                        <input type="checkbox" name="sluzhba[]" value="{{ $slb }}" class="custom-control-input" id="{{$slb}}">
                                        <label class="custom-control-label" for="{{ $slb }}">
                                @endif
                                {{ $slb }}
                                    </label>
                                    </div>
                            </th>
        @endforeach
                        </tr>
                    </thead>
                    <tbody>
        @for ($j = 0; $j < count($row1); ++$j)
                        <tr>
                            <td>
                                @if($mode)
                                    <input type="hidden" name="date" value="{{$y->format('Y-m-d')}}">
                                    <div class="custom-control custom-switch" id="control1">
                                        <input type="checkbox" name="id[]" value="{{$row1[$j]['id']}}" class="custom-control-input" id="{{$row1[$j]['id']}}">
                                        <label class="custom-control-label" for="{{$row1[$j]['id']}}">
                                @endif
                                    {{ $row1[$j]['name'] }}
                                        </label>
                                    </div>
                            </td>
        @for ($i = 0; $i < count($slba); ++$i)
                            <td id="{{ $slba[$i] }}">

        @if ((($slba[$i] == $currentSlb) && ($row1[$j]['id'] == session('id')) && ($y->format('Y-m-d') == $now)) or $mode)
                                <a href="#">
        @endif
                                    {{$row[$i][$j]['stts']}}
                                </a>
                            </td>
        @endfor
                        </tr>
        @endfor
                    </tbody>
                </table>
                <div class="modal fade" id="sluzhbaModal">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header card">
                                <div class="row justify-content-center">
                                    <input type="hidden" name="slba" class="thname">
                                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                                        @foreach($stts as $key => $stt)
                                            <label class="btn btn-secondary" for="stts{{ $key }}">
                                                <input type="radio" name="status" onchange="this.form.submit()"
                                                       class="custom-control-input" id="stts{{ $key }}"
                                                       value="{{ $key }}">{{ $key }}
                                            </label>
                                        @endforeach
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-danger" name="delete">
                                            ❌
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="dzhapaModal">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header card">
                                <div class="row">
                                    <input type="hidden" name="slba" class="td">
                                    <div class="btn-group-toggle col-6" data-toggle="buttons">
                                        <label class="btn btn-secondary" for="sttsn">
                                            <input type="radio" name="status"
                                                   class="custom-control-input" id="sttsn" value="n"
                                                   onchange="this.form.submit()">n
                                        </label>
                                        <label class="btn btn-secondary" for="sttsc">
                                            <input type="radio" name="status"
                                                   class="custom-control-input" id="sttsc" value="c"
                                                   onchange="this.form.submit()">c
                                        </label>
                                        <label class="btn btn-secondary" for="sttsb">
                                            <input type="radio" name="status"
                                                   class="custom-control-input" id="sttsb" value="b"
                                                   onchange="this.form.submit()">b
                                        </label>
                                    </div>
                                    <div class="col-6 mb-2">
                                        <input type="number" name="statusNumber" onfocusout="this.form.submit()"
                                               class="form-control"
                                               placeholder="в лакхах" min="1" max="16">
                                    </div>
                                    <div class="col-12 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-outline-danger" name="delete">
                                            ❌
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection