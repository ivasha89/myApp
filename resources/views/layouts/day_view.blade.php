@if(mysqli_num_rows($alrt) == 0)
<div class="container shadow alert alert-info alert-dismissible fade show" role="alert">
    <p class="lead">
        Здравствуйте. Доброго утра и приятного дня.
    </p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    	<span aria-hidden="true">
    		&times;
    	</span>
    </button>
</div>
@endif
<div class="container bg-white rounded">
    <div class="row justify-content-center">
        <div class="alert alert-info shadow" data-toggle="collapse" role="button" data-target="#date" aria-expanded="false" aria-controls="date">
            <h1 class="display-5">
 {{ $days[$y->format('N')] . $y->format(' d ') . $monthes[$y->format('n')] . $y->format(' Y года') }}
            </h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="collapse mb-2" id="date" style="width:330px">
            <form action="{{ url ('table') }}" method="post">
                <div class="card text-center border-secondary">
                    <div class="form-group">
                        <div class="card-header bg-info text-white">
                            <label class="text-light" for="dt">
                                Изменить дату посещаемсти
                            </label>
                        </div>
                        <div class="card-body">
                            <input class="form-control mb-2" type="date" id="dt" name="chdt">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input class="btn btn-outline-success" type="submit" name="chdtf" value="Посмотреть посещаемость">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row justify-content-center rounded">
        <table class="table table-sm table-striped table-bordered shadow">
            <caption>
                Список посещаемости
            </caption>
            <thead class="bg-info">
                <tr>
                    <th scope='col'>Имя брахмачари</th>
@for($i = 0; $i < count($slba); ++$i)
                    <th scope='col'>
                        {{ $slba[$i] }}
                    </th>
@endfor
                </tr>
            </thead>
            <tbody>
@for ($j = 0; $j < count($row1); ++$j)									//перебор всех брахмачари
                <tr>
                    <td>
                        {{ $row1[$j]['name'] }}												//выводим имена брахмачари
                    </td>
@for ($i = 0; $i < count($slba); ++$i)											//перебор по служениям
                    <td>
@if ($row1[$j]['id'] == $_SESSION['id'])
@if ($row[$i][$j]['slba'] == $slb)
                        <a href="{{ url('week') }}">
@endif
@endif
                            {{$row[$i][$j]['stts']}}										//выводим статусы служб
                        </a>
                    </td>
@endfor
                </tr>
@endfor
            </tbody>
        </table>
    </div>