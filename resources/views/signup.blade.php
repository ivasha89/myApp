@extends('layouts.header')

@section('content')

    <div class="row justify-content-center p-2">
        <div style="width:330px">
            <div class="card text-center border-secondary">

                @if (!$attributes['hj'])

                    @include('layouts.check')

                @else

                    @include('layouts.signup')

                @endif

            </div>
        </div>
    </div>

@endsection