<!DOCTYPE html>
<html style="background: white" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta lang="en">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/animatecss/3.5.2/animate.min.css">
    <!-- MATERIAL DESIGN BOOSTRAP -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>

    <!-- MATERIAL DESIGN BOOSTRAP -->
    <link href="http://fonts.cdnfonts.com/css/frutiger" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/css/swiper.min.css">

    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/animaciones.js') }}"></script>
    <link rel="shortcut icon" href="images/icono.png">


</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand icono_una" href="https://www.una.ac.cr">
                    <img src="images/una.png" alt="" width="120" height="60">
                </a>
                <a class="navbar-brand " href="https://sendero.herokuapp.com/">
                    <img src="images/logo2.png" alt="" width="120" height="60">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                    </span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/login') }}">Administrador</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/reservacion') }}">Reservación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/donaciones') }}">Donaciones</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Galería
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                style="border-top-radius: 50px; border-bottom-radius: 10px; background: #38ab81;">
                                <li><a class="dropdown-item" href="{{ url('/flora') }}">Flora</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ url('/fauna') }}">Fauna</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/repositorio') }}">Repositorio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/productos') }}">Marca</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/AboutUs') }}">¿Quiénes somos?</a>
                        </li>
                    </ul>


                    <!--<form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                  <button class="btn btn-outline-success" style="background: #ffffff;" type="submit">Buscar</button>
                </form> -->
                </div>
            </div>
        </nav>
    </header>
    <div class="wrapper" id="app">

        {{-- Content Wrapper. Contains page content --}}
        <div class="Main-content">
            {{-- Main content --}}



            <!-- Main content -->

            <router-view></router-view>

            <vue-progress-bar></vue-progress-bar>

            {{-- /.content --}}
        </div>
        {{-- /.content-wrapper --}}

    </div>
    {{-- ./wrapper --}}

    <footer class="bg-dark text-center text-white">
        <!-- Copyright -->
        <div class="text-center p-3">
            <h5 style="padding: 10px">
                Senderos los Matapalos - PGAI
            </h5>
            <h5 style="padding: 10px">
                <a href="https://www.facebook.com/pgaiuna/" target="_blank"><i class="fab fa-facebook white"></i></a>
                <a href="https://www.instagram.com/pgaiuna/?r=nametag" target="_blank"><i
                        class="fab fa-instagram white"></i></a>
            </h5>
            <h5 style="padding: 10px">
                © 2021-2022 Todos los derechos reservados.
            </h5>

        </div>
        <!-- Copyright -->
    </footer>

    <!-- Bootstrap SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.3.5/js/swiper.min.js"></script>
    @auth
        <script>
            window.user = @json(auth()->user())
        </script>
    @endauth
    <script src="{{ asset('/js/app.js') }}"></script>
    <script>

    </script>

</body>

</html>
