<!DOCTYPE html>
<html lang = "en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>
            LaraMap
        </title>
        <link rel = "stylesheet" href = "{{secure_asset('css/main.css')}}">
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    </head>
    <body>
        @yield('content')
        <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>



        {{--<script async defer--}}
                {{--src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAZfAbiyUKLQtj3hLsgUWnu6df9C0RjpMw&libraries=places">--}}
        {{--</script>--}}

        <script src="{{secure_asset('js/script.js')}}"></script>
        {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE&libraries=places"></script>--}}
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBV7tH4STtuhYbm53GTqRLkzMv95wnojjE&libraries=places">// озачает что функция инит запустится автоматически
        </script>
        <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    </body>
</html>