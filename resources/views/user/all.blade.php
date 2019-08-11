@extends('layout')

@section('title')
    Список Брахмачари
@endsection

@section('content')
    <div class="list-group all w-50">
        @foreach($users as $user)
            <div class="list-group-item d-flex flex-row p-1">
                <div class="w-25">
                    <img src="{{ url('/svg/'.$user->id.'.jpg')}}" width="55"
                     class="img-thumbnail rounded-circle" alt="...">
                </div>
                <div class="w-75 align-self-center">
                    <a href='{{ url("/$user->id") }}' class="text-dark">
                        @if($user->sname)
                            {{ $user->sname }}
                        @else
                            {{ $user->name }}
                        @endif
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection