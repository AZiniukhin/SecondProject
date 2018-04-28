{{--@extends ('default.layouts.master')--}}

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--{{ $tokenMap }}--}}
        {{--<script>--}}
            {{--var tokenMap = "{{ $tokenMap }}";--}}
        {{--</script>--}}
        {{--<div id ="map">--}}

        {{--</div>--}}

    {{--</div>--}}

{{--@endsection--}}

@extends('backend.layouts.app')

@section('content')

    <div>
        <script>
            var tokenMap = "{{ $tokenMap }}";
            var id_map = "{{ $id_map }}";
        </script>
        <div id ="map">

        </div>
        <a id="sms_link" href="#"><button  type="button"  class="btn btn-warning btn-lg btn-block">SMS</button></a>

    </div>

    <script>
        var tok = "{{csrf_token() }}";
    </script>
    <script src="{{secure_asset('js/scriptCourier.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE">// озачает что функция инит запустится автоматически
    </script>
@endsection