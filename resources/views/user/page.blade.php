@extends('layout')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="h3">
            {{ $user->name }}, это ваша страница
        </div>
        <div class="card">
            <div class="card-body">
                <p> В ашраме вы провели
                    {{ $daysInAshram }} дней
                </p>
            </div>
        </div>
    </div>
@endsection