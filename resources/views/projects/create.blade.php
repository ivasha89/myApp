@extends('layout')

@section('title')
    Создать проект
@endsection

@section('content')
    <div class="d-flex justify-content-center">
        <form action='{{ url("/projects") }}' method="post">
            @csrf
            <div class="form-group">
                <label for="title">Название задачи</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <label for="description">Описание задачи</label>
                <textarea name="description" class="form-control" id="description" placeholder="{{ old('description') }}" required></textarea>
            </div>
            <div class="form-group">
                <label for="expire">Дата выполнения</label>
                <input type="datetime-local" name="expire" class="form-control" id="expire"
                       value="{{ (new \DateTime())->add(new DateInterval('P7D'))->format('Y-m-d H:i') }}" required>
            </div>
            <button type="submit" class="btn btn-outline-info mb-2 float-right">💥️
                Сохранить
            </button>
        </form>
    </div>
@endsection