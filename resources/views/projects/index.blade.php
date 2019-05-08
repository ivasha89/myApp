@extends('layout')

@section('title')
    Мои проекты
@endsection

@section('content')
    <div class="list-group">
        @foreach($projects as $project)
            <a href='{{ url("/projects/$project->id") }}' class="list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $project->title }}</h5>
                    <small class="badge {{ $project->day <= 1 ? 'badge-danger' : 'badge-success'}}">
                        @if($project->day >= 1)
                            Дней: {{ $project->day }} часов: {{ $project->hour }}
                        @elseif($project->hour >= 1)
                            Часов: {{ $project->hour }} минут: {{ $project->minute }}
                        @else
                            Минут: {{ $project->minute }} секунд: {{ $project->second }}
                        @endif
                    </small>
                </div>
            </a>
        @endforeach
    </div>
@endsection