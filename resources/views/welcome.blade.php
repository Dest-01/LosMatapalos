<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('js/navbar.js') }}" defer></script>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">


</head>

<body>
        <section class="navigation">
            <div class="nav-container">
                <div class="brand">
                    <a href="#!">Logo</a>
                </div>
                <nav>
                    <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
                    <ul class="nav-list">
                        <li>
                            <a href="#!">Home</a>
                        </li>
                        <li>
                            <a href="#!">About</a>
                        </li>
                        <li>
                            <a href="#!">Services</a>
                            <ul class="nav-dropdown">
                                <li>
                                    <a href="#!">Web Design</a>
                                </li>
                                <li>
                                    <a href="#!">Web Development</a>
                                </li>
                                <li>
                                    <a href="#!">Graphic Design</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{ url('/cliente') }}">Cliente</a>
                        </li>
                        @if (Route::has('login'))
                            @auth
                                <li>
                                    <a href="{{ url('/home') }}">Home</a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li>
                                        <a href="{{ route('register') }}">Register</a>
                                    </li>
                                @endif
                            @endauth
                        @endif
                    </ul>
                </nav>
            </div>
        </section>

        <div class="content">
           
        </div>
    
</body>

</html>
