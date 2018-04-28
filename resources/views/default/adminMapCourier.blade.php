

@extends('backend.layouts.app')

@section('content')

    <div>

        <div id ="map">

        </div>

    </div>
    <div id="placeholder"></div>

    <script>
        var tok = "{{csrf_token() }}";
    </script>


    <script src="{{secure_asset('js/scriptAdminMap.js')}}"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE">// озачает что функция инит запустится автоматически
    </script>
@endsection