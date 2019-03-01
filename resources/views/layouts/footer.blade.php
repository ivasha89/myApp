@section('footer')
        <script src="{{ url('js/jquery.min.js') }}"></script>
        <script src="{{ url('js/popper.min.js') }}"></script>
        <script src="{{ url('js/bootstrap.min.js') }}"></script>
        {{--<script src="{{ url ('js/autoprefixer.js') }}"></script>--}}
        {{--<script src="{{ url ('js/app.js') }}"></script>
        <script src="{{ url ('js/manifest.js') }}"></script>
        <script src="{{ url ('js/vendor.js') }}"></script>--}}
        <script>
                $(document).ready(function(){
                        $('.toast').toast('show');
                });
        </script>

@endsection