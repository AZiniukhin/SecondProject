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

    <link rel = "stylesheet" href = "{{secure_asset('css/main.css')}}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">


    <link rel="stylesheet" href="{{ secure_asset('css/style.css') }}">

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>



</head>
<body>

<div id="app">

    @section('navbar')

        <nav class="nav">
            <div class="nav-reveal">
                <div class="nav-reveal__inner"></div>
            </div>
            <div class="navbar-logo">
                <a href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>

            @if( isset(Auth::user()->status))
                @if( Auth::user()->status == 'client')
                    <ul class="navigate-list">
                        <li class="navigate-list__item"><a href="{{ route('admin.adminMap') }}">All Couriers</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.showCouriers') }}">Couriers</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.showOrders') }}">Orders</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.helpCompany') }}">Help</a></li>
                    </ul>
                @elseif( Auth::user()->status == 'admin')
                    <ul class="navigate-list">
                        {{--<li class="navigate-list__item"><a href="{{ route('home') }}">My Map</a></li>--}}
                        <li class="navigate-list__item"><a href="{{ route('map') }}">Map Client</a></li>
                        <li class="navigate-list__item"><a href="{{ route('courierMap') }}">Map Couriers</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.showCouriers') }}">Couriers</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.showOrders') }}">Orders</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.setting.showSetting') }}">Settings WebHook</a></li>
                        <li class="navigate-list__item"><a href="{{ route('admin.helpCompany') }}">Help</a></li>
                        <li class="navigate-list__item"><a href="{{ route('about') }}">About</a></li>
{{--                        <li class="navigate-list__item"><a href="{{ route('admin.iFrame') }}">iFrame</a></li>--}}
                        <li class="navigate-list__item"><a href="{{ route('contacts') }}">Contacts</a></li>
                    </ul>
                @endif
            @else
                    <ul class="navigate-list">
                        <li class="navigate-list__item"><a href="{{ route('about') }}">About</a></li>
                        <li class="navigate-list__item"><a href="{{ route('contacts') }}">Contacts</a></li>
                    </ul>
            @endif

        </nav>
        <div class="wrapper flex flex-column">
            <header class="header">
                <ul class="navbar-nav login">
                    @guest
                    <li><a href="{{ route('login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false" aria-haspopup="true">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
										document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @endguest

                </ul>
            </header>

            @show


            <div id="barba-wrapper">
                <div class="barba-container">
            @section('header')
                        <div class="content page-index">
                            <div class="welcome-text">


                                {{-------------------------------------------------------------------------------------------}}


                                {{-- Часть отвечающая за вывод контента, была взята как пример --}}

                                {{--<h1>{{ config('app.name', 'Laravel') }}</h1>--}}

                                {{--<p>This is a template for a simple marketing or informational website. It includes a large callout called a jumbotron and three supporting pieces of content. Use it as a starting point to create--}}
                                    {{--something more unique.</p>--}}
                                {{--<button class="btn btn--default">Learn more &raquo;</button>--}}


                                {{-------------------------------------------------------------------------------------------}}


                                @show

                                <div class="map">
                                    {{--<div class="preloader">Loading...</div>--}}
                                    <div class="row">

                                        <div class="col-md-12">

                                            @yield('content')

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <footer class="footer">
                    <div class="container">
                        <p class="text-muted">&copy; 2018 DeadLine Company, Inc.</p>
                    </div>
                </footer>
        </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>


<script src="{{ secure_asset('js/TweenMax.min.js') }}"></script>
<script src="{{ secure_asset('js/barba.min.js') }}"></script>
<script src="{{ secure_asset('js/mainBarba.js') }}"></script>


</body>
</html>










