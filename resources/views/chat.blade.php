@extends('layout')

@section('content')
    <div class="chats" id="app">
        <chat :user="{{ auth()->user() }}"></chat>
    </div>
@endsection