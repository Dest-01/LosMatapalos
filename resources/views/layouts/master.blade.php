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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
   
      <!-- Bootstrap SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Bootstrap SCRIPT -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
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
