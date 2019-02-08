@if($slb !== '')
                        <div class="row mb-2">
                            <div class="col mr-auto">
                                <input class="btn btn-outline-success" type="submit" name="create1" value="СОЗДАТЬ" formmethod="post">
                            </div>
                            <div class="col ml-auto">
                                <input class="btn btn-outline-danger" type="submit" name="delete1" value="УДАЛИТЬ" formmethod="post">
                            </div>
                        </div>
                        <div class="row justify-content-center mb-2">
                            <div class="col">
                                <input class="btn btn-outline-warning" type="submit" name="update1" value="ОБНОВИТЬ" formmethod="post">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer">
                    <a class="border-dark text-info">
                        {{ $error }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endif