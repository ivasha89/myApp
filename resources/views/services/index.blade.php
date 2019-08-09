@extends('layout')

@section('title')
    Таблица служений
@endsection

@section('content')
    <form action="{{ url('/services') }}" method="post">
    @csrf
        <div class="d-flex flex-row">
            <table class="table table-sm table-striped table-bordered shadow bg-light">
                <thead>
                    <tr>
                        <td>
                            Имя
                        </td>
                        <td>
                            Служение
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                @if($user->sname)
                                    {{ $user->sname }}
                                @else
                                    {{ $user->name }}
                                @endif
                            </td>
                            <td>
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <input type="hidden" name="date" value="{{$y->format('Y-m-d')}}">
                                <select class="custom-select" name="service" onchange="this.form.submit()">
                                    @for($i = 0; $i < count($rules); $i++)
                                        <option value="{{ $rules[$i]->id }}" >
                                            {{ $rules[$i]->service }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </form>
@endsection