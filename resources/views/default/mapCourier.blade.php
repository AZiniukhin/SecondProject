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
        <h1 id="resultsClient">Вы находитесь </h1>
        <div id="map">

        </div>

        <button  onclick="getLocation()" type="button" class="btn btn-success btn-lg btn-block">Отправит вашу местонахождение курьеру</button>

    </div>

        <script>
        var tok = "{{csrf_token() }}";
    </script>
    <script src="{{secure_asset('js/script.js')}}"></script>


    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE">// озачает что функция инит запустится автоматически
    </script>

    </div>
@endsection
