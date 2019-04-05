@extends('layouts.header')

@section('content')
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
        <div class="row justify-content-center">
            <div class="alert alert-info shadow">
                <a class="h1" id="timeSet">
                    {{ $days[$y->format('N')] . $y->format(' d ') . $monthes[$y->format('n')] . $y->format(' Y года') }}
                </a>
            </div>
        </div>
        <div class="row justify-content-center rounded">
            <table class="table table-sm table-striped table-bordered shadow">
                <caption>
                    Список посещаемости
                </caption>
                <thead class="bg-info">
                    <tr>
                        <th scope='col'>Имя брахмачари</th>
    @foreach($slba as $slb)
                        <th scope='col' headers="{{ $slb }}">
                            {{ $slb }}
                        </th>
    @endforeach
                    </tr>
                </thead>
                <tbody>
    @for ($j = 0; $j < count($row1); ++$j)
                    <tr>
                        <td>
                            {{ $row1[$j]['name'] }}
                        </td>
    @for ($i = 0; $i < count($slba); ++$i)
                        <td id="{{ $row[$i][$j]['slba'] }}">

    @if ($row[$i][$j]['slba'] == $currentSlb)
        @if ($row1[$j]['id'] == session('id'))
                            <a href="#" id="sluzhba">
        @endif
    @endif
                                {{$row[$i][$j]['stts']}}
                            </a>
                        </td>
    @endfor
                    </tr>
    @endfor
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="sluzhbaModal">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <form method="post" action="{{ url('/slbs') }}">
                        @csrf
                        <input type="hidden" name="slba" class="td">
                        <div class="btn-group-toggle mb-2" data-toggle="buttons">
                            @foreach($stts as $stt)
                                <label class="btn btn-secondary" for="stts{{ $stt }}">
                                    <input type="radio" name="status" onchange="this.form.submit()" class="custom-control-input" id="stts{{ $stt }}" value="{{ $stt }}">{{ $stt }}
                                </label>
                            @endforeach
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-danger" name="delete">
                                ❌
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="dzhapaModal">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header card">
                    <form method="post" action="{{ url('/slbs') }}" class="row">
                        @csrf
                        <input type="hidden" name="slba" class="td">
                            <div class="btn-group-toggle col-6" data-toggle="buttons">
                                <label class="btn btn-secondary" for="sttsn">
                                    <input type="radio" name="status" onchange="this.form.submit()" class="custom-control-input" id="sttsn" value="n">n
                                </label>
                                <label class="btn btn-secondary" for="sttsc">
                                    <input type="radio" name="status" onchange="this.form.submit()" class="custom-control-input" id="sttsc" value="c">c
                                </label>
                                <label class="btn btn-secondary" for="sttsb">
                                    <input type="radio" name="status" onchange="this.form.submit()" class="custom-control-input" id="sttsb" value="b">b
                                </label>
                            </div>
                        <div class="col-6 mb-2">
                            <input type="number" name="status" onfocusout="this.form.submit()" class="form-control" id="dzh"
                                   placeholder="в лакхах" min="1">
                        </div>
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-danger" name="delete">
                                ❌
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="timeForm">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header bg-info justify-content-center">
                    Изменить дату
                </div>
                <div class="modal-body">
                    <form method="get" action="{{ url('/slbs') }}">
                        <input class="form-control mb-2" onchange="this.form.submit()" type="date" name="chdt">
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection