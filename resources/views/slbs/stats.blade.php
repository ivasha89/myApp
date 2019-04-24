@extends('layout')

@section('content')
    <div class="container bg-white rounded">
        <div class="row justify-content-center">
            <div class="alert alert-info shadow">
                <p class="h4" id="timeSet">
                    Статистика за {{$diff}} дней начиная с {{ $date[0]->format(' d ') . $months[$date[0]->format('n')] }}
                    до {{ $dateEnd->format(' d ') . $months[$dateEnd->format('n')] }}
                </p>
            </div>
        </div>
        <div class="row justify-content-center rounded">
            <table class="table table-sm table-striped table-bordered shadow">
                <caption>
                    Статистка посещаемости
                </caption>
                <thead class="bg-info">
                    <tr>
                        <th scope="col">
                            Имя
                        </th>
                        @foreach($slba as $slb)
                            <th scope='col' id="{{ $slb }}">
                                {{ $slb }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @for ($j = 0; $j < count($row1); ++$j)
                        <tr title="{{ $row1[$j]['name'] }}" id="{{$row1[$j]['id']}}">
                            <td class="{{($row1[$j]['id'] == session('id')) || (session('right') !== 'usr') ? 'stts' : ''}}" id="{{count($date)}}">
                                {{ $row1[$j]['name'] }}
                            </td>
                            @for ($i = 0; $i < count($slba); ++$i)
                                    <td style="background-color: {{ $a[$j][$i] <= 75 ? 'salmon' : 'palegreen'}}">
                                        @for($k = 0; $k < count($date); ++$k)
                                            <div class="hide sts{{$row1[$j]['id']}}{{$i}}{{$k}}" title="{{$statuses[$j][$i][$k]}}"></div>
                                        @endfor
                                        @if((int)$a[$j][$i])
                                                {{ $a[$j][$i] }}%
                                            @else
                                                {{ $a[$j][$i] }}
                                        @endif
                                </td>
                            @endfor
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{url('/slbs/statistic')}}" method="get">
        <div class="row justify-content-center p-2">
            <div style="width:300px">
                <div class="text-center card border-info mb-2">
                    <div class="card-header">
                        Выберите диапазон дат
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="float-right">
                    <input class="form-control" type="date" name="dateStart" value="{{$date[0]->format('Y-m-d')}}" onchange="this.form.submit()">
                </div>
            </div>
            <div class="col-6">
                <div class="float-left">
                    <input class="form-control" type="date" name="dateEnd" value="{{$dateEnd->format('Y-m-d')}}" min="{{$date[1]->format('Y-m-d')}}"
                           onchange="this.form.submit()">
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" id="statuses" tabindex="-1" role="dialog">
        <div class="modal-dialog-scrollable modal-dialog" role="document">
            <div class="modal-content">
                <div class="justify-content-center">
                    <div class="modal-header justify-content-center bg-light">
                        <h5 class="modal-title" id="statsModal"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" style="overflow-y: auto;
    max-height: 350px;">
                        <table class="table table-sm table-striped table-bordered shadow">
                            <thead>
                            <tr>
                                <th>День</th>
                                @foreach($slba as $slb)
                                    <th>{{ $slb }}</th>
                                @endforeach
                            </tr>
                            </thead>
                            <tbody>
                            @for($k = 0; $k <count($date); ++$k)
                                <tr>
                                    <td>{{$days[$date[$k]->format('N')] . $date[$k]->format(' d ') . $months[$date[$k]->format('n')]}}</td>
                                    @for($i = 0; $i <count($slba); ++$i)
                                        <td class="st{{$i}}{{$k}}"></td>
                                    @endfor
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection