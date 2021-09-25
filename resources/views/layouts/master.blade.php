<!DOCTYPE html>
<html style="background: white" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <!-- MATERIAL DESIGN BOOSTRAP -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/css/mdb.min.css" rel="stylesheet">

    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/js/bootstrap.min.js">
    </script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.19.1/js/mdb.min.js"></script>

<!-- MATERIAL DESIGN BOOSTRAP -->




    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/navbar.js') }}"></script>


</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="images/logo2.png" alt="" width="120" height="60">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0 ">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Administrador</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/pruebas') }}">Prueba</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/donaciones') }}">Donaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/reservacion') }}">Reservación</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Galeria
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                style="border-top-radius: 50px; border-bottom-radius: 10px; background: #9f1726d9;">
                                <li><a class="dropdown-item" href="#">Flora</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Fauna</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/libro') }}">¿Quiénes somos?</a>
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
        <div class="">
            {{-- Main content --}}



            <!-- Main content -->

            <router-view></router-view>

            <vue-progress-bar></vue-progress-bar>

            {{-- /.content --}}
        </div>
        {{-- /.content-wrapper --}}

    </div>
    {{-- ./wrapper --}}

    @auth
        <script>
            window.user = @json(auth()->user())
        </script>
    @endauth
    <script src="{{ mix('/js/app.js') }}"></script>
<script>

</script>

</body>

</html>
