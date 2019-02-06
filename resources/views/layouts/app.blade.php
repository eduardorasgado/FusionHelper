<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Fusion') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .jumboColorBlue {
            background-color: #98e1b7;
            margin: 10px;
            padding: 20px;
        }
        .jumboColorBlue p {
            margin: 0;
        }

        .jumboColorDark {
            margin: 0px;
            padding: 12px;
            border-radius: 0px;
            opacity: 0.8;
        }

        .jumboColorDark p {
            color: white;
            margin: 0;
        }

        .jumboBox {
            margin: 10px;
            padding: 20px;
            background-color: #1b4b72;
            color: white;
            border-radius: 0px;

        }

        .left {
            margin-right: 20px;
            margin-left: 20px;
        }
        .right {
            margin-right: 20px;
            margin-left: 20px;
        }

        .blue {
            color: #227dc7;
        }
        .orange {
            color: #f6993f;
        }

        .jumbo-1 {
            background-image: url("/images/ThFusion01-2.jpg");
            background-repeat: no-repeat;
            background-size: 120%;
            background-position: -10px -10px;
        }

        .jumbo-2 {
            background-image: url("/images/ThFusion03-1.jpg");
            background-repeat: no-repeat;
            background-size: 120%;
            background-position: -10px -10px;
        }

        .jumbo-3 {
            background-image: url("/images/ThFusion02-1.jpg");
            background-repeat: no-repeat;
            background-size: 120%;
            background-position: -10px -10px;
        }

        .jumbo-4 {
            background-image: url("/images/QuienesSomos-2.jpg");
            background-repeat: no-repeat;
            background-size: 120%;
            background-position: -5px -90px;
        }

        .jumbo-5 {
            background-image: url("/images/Servicios2.jpg");
            background-repeat: no-repeat;
            background-size: 120%;
            background-position: -5px -90px;
        }

        .div-listado {
            float:left;

            overflow-y: auto;
            height: 800px;
        }
    </style>
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ url('/images/fusion_logo.png') }}" alt="profile Pic" width="40px"> Mesa de Ayuda FusionDesk
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Bienvenid@ {{ Auth::user()->nombre }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        Menu principal
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Desconectarse') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <br>
    <div>
        <footer class="card-footer text-center">
            Fusión Eléctrica de México. 2018-2019. Todos los derechos reservados.
        </footer>
    </div>

</body>
</html>
