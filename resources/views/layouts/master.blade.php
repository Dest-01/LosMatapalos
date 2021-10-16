<!DOCTYPE html>
<html style="background: white" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <!-- MATERIAL DESIGN BOOSTRAP -->
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.css" rel="stylesheet" />

    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.6.0/mdb.min.js"></script>

    <!-- MATERIAL DESIGN BOOSTRAP -->



    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/navbar.js') }}"></script>
    <script src="{{ asset('/js/utilitarios.js') }}"></script>
    <link rel="shortcut icon" href="images/icono.png">


</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
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
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/dashboard') }}">Administrador</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/reservacion') }}">Reservación</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/actividades') }}">Actividades</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/donaciones') }}">Donaciones</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Galeria
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                                style="border-top-radius: 50px; border-bottom-radius: 10px; background: #9f1726d9;">
                                <li><a class="dropdown-item" href="{{ url('/flora') }}">Flora</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="{{ url('/fauna') }}">Fauna</a></li>
                            </ul>
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

    <footer>
        <div class="
            paginacion">
            <pagination style="font-family: fantasy" :data="donativos" @pagination-change-page="getResults">
            </pagination>
        </div>

        <div class="contenedor-footer">
            <div class="content-foo">
                <h4>Phone</h4>
                <p>0000-0000</p>
            </div>
            <div class="content-foo">
                <h4>Email</h4>
                <p>sendero@una.ac.cr</p>
            </div>
            <div class="content-foo">
                <h4>Location</h4>
                <p>
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga, cum?
                </p>
            </div>
        </div>
    </footer>

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
