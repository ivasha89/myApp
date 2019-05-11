@extends('layout')

@section('title')
    Мои проекты
@endsection

@section('content')
    <div class="list-group">
        @foreach($projects as $project)
            <div class="mb-3 shadow">
            <a href='{{ url("/projects/$project->id") }}' class="list-group-item list-group-item-action">
                <div class="d-flex justify-content-between">
                    <p class="h5 text-truncate">{{ $project->title }}</p>
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
            <div class="text-truncate m-1 font-italic">
                {{ $project->description }}
            </div>
            </div>
        @endforeach
    </div>
@endsection