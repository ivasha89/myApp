<div class="row justify-content-center p-2">
    <div style="width:330px">
        <div class="card text-center border-secondary">
            <div class="card-header bg-info text-white">
                {{$title}}
            </div>
@if ($slb !== '')
            <div class="card-body">
                <form action="week.php" method="post">
@if(($slb == 'МА') or ($slb == 'ПБ') or ($slb == 'ГА'))
                    <div class="col btn-group btn-group-toggle custom-control-inline mb-2" data-toggle="buttons"">
                        <label class="btn btn-secondary active">
                            <input type="radio"  name="stt" class="custom-control-input" id="stts+" value="+" autocomplete="off" checked>+
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"  name="stt" class="custom-control-input" id="sttso" value="o" autocomplete="off">o
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"  name="stt" class="custom-control-input" id="sttsn" value="n" autocomplete="off">n
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"  name="stt" class="custom-control-input" id="sttsc" value="c" autocomplete="off">c
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"  name="stt" class="custom-control-input" id="sttsb" value="b" autocomplete="off">b
                        </label>
                    </div>
@elseif ($slb == 'ДЖ')
                    <div class="col btn-group btn-group-toggle custom-control-inline mb-2" data-toggle="buttons"">
                        <label class="btn btn-secondary">
                            <input type="radio"  name="dzhst" class="custom-control-input" id="sttsn" value="n" autocomplete="off">n
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"  name="dzhst" class="custom-control-input" id="sttsc" value="c" autocomplete="off">c
                        </label>
                        <label class="btn btn-secondary">
                            <input type="radio"  name="dzhst" class="custom-control-input" id="sttsb" value="b" autocomplete="off">b
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
    @endif
@endif