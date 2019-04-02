@extends('layouts.header')

@section('content')

    <div class="row justify-content-center p-2">
        <div style="width:330px">
            <div class="card text-center border-secondary">

                @if (session('token'))

                    @include('layouts.signup')

                @else

                    @include('layouts.check')

                @endif

            </div>
        </div>
    </div>

@endsection
