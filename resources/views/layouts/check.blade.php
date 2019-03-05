<div class="card-header bg-info text-white">
    Пожалуйста введите маха-секретное кодовое слово
</div>
<form action="{{ url('check') }}" method="post">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <input type="password" class="form-control" id="yep" placeholder="код" maxlength="16" name="psrd" required autofocus>
        </div>
    </div>
    <div class="card-footer">
        <div class="mb-2">
            <input class="btn btn-outline-success" type="submit" name="rt" value="ВВОД" required>
        </div>
    </div>
</form>