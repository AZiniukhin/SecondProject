<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->

    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>--}}


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/googleApi.css') }}" />

    {{--Для сервера запись--}}
    {{--<link rel="stylesheet" type="text/css" href="{{ secure_asset('css/googleApi.css') }}" />--}}

</head>
<body>

@section('navbar')
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Ok Find Me</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ route('home') }}">Home</a></li>
                    <li class="active"><a href="{{ route('map') }}">Map</a></li>
                    <li><a href="#">Articles</a></li>
                    <li><a href="#">Article</a></li>
                    <li><a href="#">Contact</a></li>

                    {{--<li><a href="{{ route('about') }}">About</a></li>--}}
                    {{--<li><a href="{{ route('articles') }}">Articles</a></li>--}}
                    {{--<li><a href="{{ route('article', array('id'=>10)) }}">Article</a></li>--}}
                    {{--<li><a href="{{ route('contact') }}">Contact</a></li>--}}

                </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </nav>
@endsection
@yield('navbar')


@section('header')
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $title }}</h1>


            {{-- Token for databases about client --}}
{{--            <p>{{ $id }}</p>--}}



            <p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.</p>
            <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p>

            {{--<p>Click the button to get your coordinates.</p>--}}

            {{--<button onclick="getLocation()">Try It</button>--}}

            {{--<p id="demo"></p>--}}
        </div>
    </div>

@show


<div class="container">
    <!-- Example row of columns -->
    <div class="row">

        <div class="col-md-12">

            @yield('content')

        </div>

    </div>

    {{--<footer>--}}
        {{--<p>&copy; 2018 OkFindMe Company, Inc.</p>--}}
    {{--</footer>--}}

</div>
</body>
</html>