@if (($_SESSION['rights'] == 'root') || ($_SESSION['rights'] == 'adm'))
<p class="row justify-content-center">
    <a class="btn btn-primary" data-toggle="collapse" href="#lapEx" role="button" aria-expanded="false" aria-controls="lapEx">
         👇
    </a>
</p>
@endif
<form action="{{ url('table') }}" method="post">
    <div class="collapse" id="lapEx">
        <div class="card card-body">
            <div class="row justify-content-center p-2">
                <div style="width:330px">
                    <div class="card text-center border-secondary rounded">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" id="islba" data-toggle="tab" href="#slba" role="tab" aria-controls="slba" aria-selected="true">Служба</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="ibrahm" data-toggle="tab" href="#brahm" role="tab" aria-controls="brahm" aria-selected="true">Брахмачари</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="istts" data-toggle="tab" href="#stts" role="tab" aria-controls="stts" aria-selected="true">Статус</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="idzp" data-toggle="tab" href="#dzp" role="tab" aria-controls="dzp" aria-selected="true">Джапа</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="idata" data-toggle="tab" href="#data" role="tab" aria-controls="data" aria-selected="true">Дата</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content mb-2" id="mTC">
                                <div class="tab-pane fade show active" id="slba" role="tabpanel" aria-labelledby="islba">
                                    <ul class="list-group">
                                        <li class="list-group-item btn-outline-info">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="МА" name="slba[]" value="МА" checked>
                                                <label class="custom-control-label" for="МА">МА</label>
                                            </div>
                                        </li>
@for ($i = 2; $i < count($slba); ++$i)
                                        <li class="list-group-item btn-outline-info">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="{{ $slba[$i] }}" name="slba[]" value="{{ $slba[$i] }}">
                                                <label class="custom-control-label" for="{{$slba[$i]}}">{{ $slba[$i] }}</label>
                                            </div>
                                        </li>
@endfor
                                    </ul>
                                </div>
                                <div class="tab-pane fade mb-2" id="brahm" role="tabpanel" aria-labelledby="ibrahm">
                                    <ul class="list-group text-left">
@for ($i = 0; $i < count($row1); ++$i)
                                        <li class="list-group-item text-dark btn-outline-info">
                                            <div class="custom-control custom-switch mb-1">
                                                <input type="checkbox" name="idbr[]" value="{{ $row1[$i]['id'] }}" class="custom-control-input" id="{{ $row1[$i]['id'] }}">
                                                <label class="custom-control-label" for="{{ $row1[$i]['id'] }}">
                                                    {{ $row1[$i]['name'] }}
                                                </label>
                                            </div>
                                        </li>
@endfor
                                    </ul>
                                </div>
                                <div class="tab-pane fade mb-2" id="stts" role="tabpanel" aria-labelledby="istts">
                                    <div class="btn-group btn-group-toggle mb-2" data-toggle="buttons">
                                    <label class="btn btn-info active">
                                        <input type="radio"  name="stt" class="custom-control-input" id="stts+" value="+" autocomplete="off" checked>+
                                    </label>
@for ($i = 1; $i < count($stts); ++$i)
                                    <label class="btn btn-info">
                                        <input type="radio"  name="stt" class="custom-control-input" id="stts{{ $stts[$i] }}" value="{{ $stts[$i] }}" autocomplete="off">
                                        {{ $stts[$i] }}
                                    </label>
@endfor
                                </div>
                            </div>
                            <div class="tab-pane fade mb-2" id="dzp" role="tabpanel" aria-labelledby="idzp">
                                <div class="col btn-group btn-group-toggle custom-control-inline mb-2" data-toggle="buttons">
                                    <label class="btn btn-secondary" for="sttsn">
                                        <input type="radio"  name="dzhs" class="custom-control-input" id="sttsn" value="n" autocomplete="off">n
                                    </label>
                                    <label class="btn btn-secondary" for="sttsc">
                                        <input type="radio"  name="dzhs" class="custom-control-input" id="sttsc" value="c" autocomplete="off">c
                                    </label>
                                    <label class="btn btn-secondary" for="sttsb">
                                        <input type="radio"  name="dzhs" class="custom-control-input" id="sttsb" value="b" autocomplete="off">b
                                    </label>
                                    <label class="btn btn-secondary" for="stts/">
                                        <input type="radio"  name="dzhs" class="custom-control-input" id="stts/" value="/" autocomplete="off">/
                                    </label>
                                    <label class="btn btn-secondary" for="stts-">
                                        <input type="radio"  name="dzhs" class="custom-control-input" id="stts-" value="-" autocomplete="off">-
                                    </label>
                                </div>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <label class="text-info input-group-text" for="dzh">
                                            Джапа
                                        </label>
                                    </div>
                                    <input type="number"  name="dzh" class="form-control" id="dzh" placeholder="в лакхах, пожалуйста" maxlength="2" max="16" min="0">
                                </div>
                            </div>
                            <div class="tab-pane fade mb-2" id="data" role="tabpanel" aria-labelledby="idata">
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>