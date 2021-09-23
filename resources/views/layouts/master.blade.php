<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <!-- Bootstrap CSS -->
    <!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> <!--Carrusel de donaciones
<!-- Optional theme -->
<!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css"> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous"></script>
<!-- Latest compiled and minified JavaScript -->
    <!-- jQuery library -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script> <!--Carrusel de donaciones -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script> <!--Carrusel de donaciones -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script> <!--Carrusel de donaciones
    <!-- Latest compiled JavaScript -->


    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/navbar.js') }}"></script>

</head>

<body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Sendero los Matapalos</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                    <a class="nav-link" href="{{ url('/donaciones') }}">Donaciones</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/reservacion') }}">Reservación</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/libro') }}">Flora y Fauna</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ url('/libro') }}">¿Quiénes somos?</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Services
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown"  style="border-top-radius: 50px; border-bottom-radius: 10px; background: #9f1726d9;">
                      <li><a class="dropdown-item" href="#">Action</a></li>
                      <li><a class="dropdown-item" href="#">Another action</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                  </li>
                 
    
                </ul>
    
       
                <form class="d-flex">
                  <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search">
                  <button class="btn btn-outline-success" style="background: #ffffff;" type="submit">Buscar</button>
                </form>
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
    <script src="{{ asset('/js/utilitarios.js') }}"></script>
    <script>
        /* Type-1 */
        $('#myCarousel').carousel({
            interval: 4000
        })

        $('.carousel .item').each(function() {
            var next = $(this).next();
            if (!next.length) {
                next = $(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));

            for (var i = 0; i < 2; i++) {
                next = next.next();
                if (!next.length) {
                    next = $(this).siblings(':first');
                }

                next.children(':first-child').clone().appendTo($(this));
            }
        });
    </script>
</body>

</html>
