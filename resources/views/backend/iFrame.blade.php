{{-- Форма-заготовка для загрузки как iFrame на сайт магазина (запасной вариант) --}}


<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'OkFindMe') }}</title>

    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{secure_asset('css/main.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>


</head>


<body>

<div id="bigMap">
    <div id="map">

    </div>
</div>

<script>
    var tok = "{{ csrf_token() }}";
</script>
<script src="{{ secure_asset('js/scriptHome.js') }}"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE&callback=initMap   ">
</script>

</body>