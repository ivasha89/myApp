@extends('layout')

@section('content')
    @if($alrt->first() == null)
        <div class="shadow alert alert-info alert-dismissible fade show" role="alert">
            <p class="lead text-center">
                Здравствуйте {{ $user->name }}, это ваша страница. Доброго утра и приятного дня.
            </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">
                    &times;
                </span>
            </button>
        </div>
    @endif
    <div class="justify-content-center">
        <table class="table shadow mb-2">
            <tbody>
            <tr>
                <td>
                    <p>
                        Дней в ашраме
                    </p>
                </td>
                <td>
                    <span class="badge badge-info">
                        {{ $daysInAshram }}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                    <p>
                        Кругов до 7:00 за все дни
                    </p>
                </td>
                <td>
                    <span class="badge badge-info">
                        {{ $allDzhapa }}
                    </span>
                </td>
            </tr>
            </tbody>
        </table>
        @if($user->id == auth()->id())
        @if($currentSlb)
            <div class="text-muted mb-2">
                Отметиться на службе
            </div>
        @endif
        <form action="{{ url('/slbs') }}" method="post">
            @csrf
            <div class="row justify-content-center mb-3">
                @if($currentSlb == 'ДЖ')
                    <input type="hidden" name="slba" id="dzhapa" value="">
                    <div class="btn-group-toggle col-6" data-toggle="buttons">
                        <label class="btn btn-secondary" for="sttsn">
                            <input type="radio" name="status"
                                   class="custom-control-input" id="sttsn" value="n"
                                   onchange="this.form.submit()">n
                        </label>
                        <label class="btn btn-secondary" for="sttsc">
                            <input type="radio" name="status"
                                   class="custom-control-input" id="sttsc" value="c"
                                   onchange="this.form.submit()">c
                        </label>
                        <label class="btn btn-secondary" for="sttsb">
                            <input type="radio" name="status"
                                   class="custom-control-input" id="sttsb" value="b"
                                   onchange="this.form.submit()">b
                        </label>
                    </div>
                    <div class="col-6 mb-2">
                        <input type="number" name="statusNumber" onfocusout="this.form.submit()"
                               class="form-control"
                               placeholder="в лакхах" min="1" max="16">
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-danger" name="delete">
                            ❌
                        </button>
                    </div>
                @elseif($currentSlb)
                    <input type="hidden" name="slba" id="sluzhba" value="">
                    <div class="btn-group-toggle mb-2" data-toggle="buttons">
                        @foreach($stts as $key => $stt)
                            <label class="btn btn-secondary" for="stts{{ $key }}">
                                <input type="radio" name="status" onchange="this.form.submit()"
                                       class="custom-control-input" id="stts{{ $key }}"
                                       value="{{ $key }}">{{ $key }}
                            </label>
                        @endforeach
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <button type="submit" class="btn btn-outline-danger" name="delete">
                            ❌
                        </button>
                    </div>
                @endif
            </div>
        </form>
            <div class="text-muted mb-2" onclick="document.location.href='{{ url("/projects/create") }}'">
                Создать Проект
            </div>
        @if($user->projects->count())
            <div class="text-muted mb-2" onclick="document.location.href='{{ url("/$user->id/projects") }}'">
                Личные Проекты
            </div>
        @endif
        @endif
    </div>
@endsection