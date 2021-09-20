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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<!-- LINKS DE PRUEBAS -->

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="{{ asset('/js/navbar.js') }}"></script>
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('/css/cliente.css') }}">
   
</head>

<body>

<header>
    <!--============= Navbar =============-->
    <nav class="navbar">
        <div class="container">

            <!-- Navbar Header [collects both toggle button and navbar brand] -->
            <div class="navbar-header">
                <!-- Toggle Button [handles opening navbar menu on mobile screens]-->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#exampleNavComponents" aria-expanded"false">
                    <i class="glyphicon glyphicon-list"></i>
                </button>

                <!-- Navbar Brand -->
                <a href="#" class="navbar-brand">
                    Sendero
                </a>
            </div>

            <!-- Navbar Collapse [collect navbar components such as navbar links and forms ] -->
            <div class="collapse navbar-collapse" id="exampleNavComponents">

                <!-- Navbar Links -->
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{ url('/dashboard') }}">Admin Panel</a></li>
                    <li><a href="{{ url('/donaciones') }}">Donaciones</a></li>
                    <li><a href="{{ url('/reservacion') }}">Reservar</a></li>
                    <li><a href="{{ url('/pruebas') }}">Prueba estilos</a></li>
                    <li class="dropdown">
                        <a href="#!" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Services</a>
                        <ul class="dropdown-menu"
                            style="border-top-radius: 50px; border-bottom-radius: 10px; background: #339966;">
                            <li>
                                <a class="dropdown-item" href="#!">Web Design</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#!">Web Design</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ url('/libro') }}">Flora y Fauna</a></li>
                    <li><a href="#">¿Quiénes somos?</a></li>
                    </li>
                    @if (Route::has('login'))
                        @auth
                            <li>
                                <a href="{{ url('/home') }}">Home</a>
                            </li>
                        @else
                            <li>
                                <button href="{{ url('login') }}" type="button" class="btn navbar-btn navbar-right">Sign
                                    in</button>
                            </li>
                            <!-- @if (Route::has('register'))
        <li>
        <a href="{{ route('register') }}">Register</a>
        </li>
        @endif -->
                        @endauth
                    @endif
                </ul>

                <!-- Navbar Button -->

            </div>
        </div>

    </nav><!-- /.============= Navbar =============-->
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

$('.carousel .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));
  
  for (var i=0;i<2;i++) {
    next=next.next();
    if (!next.length) {
    	next = $(this).siblings(':first');
  	}
    
    next.children(':first-child').clone().appendTo($(this));
  }
});
    </script>
</body>

</html>
