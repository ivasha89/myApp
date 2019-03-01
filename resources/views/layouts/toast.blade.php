@foreach ($errors->all() as $error)
    <div class="container">
        <div role="alert" aria-live="assertive" aria-atomic="true" class="toast">
            <div class="toast-header">
                <img src="{{ url('svg/BSSHSA.jpg') }}" class="rounded mr-2" alt="">
                <strong class="mr-auto">БСШСА</strong>
                <small>1 mins ago</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                {{ $error }}
            </div>
        </div>
    </div>
@endforeach