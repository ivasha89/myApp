@extends('layouts.header')

@section('content')
<form action="{{ url('signup') }}" method="post">
    @csrf

    <div class="row justify-content-center p-2">
        <div style="width:330px">
            <div class="card text-center border-secondary">
@if ($attributes['hj'])
                <div class="card-header bg-info text-white">
                    Пожалуйста введите маха-секретное кодовое слово
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <input type="password" class="form-control" id="yep" placeholder="код" maxlength="16" name="psrd" required autofocus>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mb-2">
                        <input class="btn btn-outline-success" type="submit" name="rt" value="ВВОД" required>
                    </div>
                </div>
@else
    @include('layouts.signup')
@endif
            </div>
        </div>
    </div>
</form>
@endsection
