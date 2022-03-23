<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
  <link rel="shortcut icon" href="{{ asset('images/icono.png') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="token" id="token" value="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>


  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/extras.css') }}">
  <script src="{{ asset('/js/funcionesAdmin.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="app">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Buscar.." aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fa fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/admin/dashboard" class="brand-link">
      <img src="{{ asset('/images/logo.png') }}" alt="The Logo" class="brand-image elevation-3"
           style="opacity: .9">
      <span style="font-size: 18px" class="brand-text font-weight-light" >{{ config('app.name', 'Laravel') }}</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <router-link to="/admin/perfil">
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                <img src="{{ asset('/images/usuarios/' . Auth::user()->image) }}" class="img-circle elevation-2" alt="User Image">
              </div>
              <div class="info">

                  {{ Auth::user()->name }}
                  <span class="d-block text-muted">
                    {{ Ucfirst(Auth::user()->type) }}
                  </span>
              </div>
          </div>
        </router-link>

      <!-- Sidebar Menu -->
      @include('admin.sidebar-menu')
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  {{-- Content Wrapper. Contains page content --}}
  <div style="background: #e9ecef" class="content-wrapper">
    {{-- Main content --}}
    
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">

      </div><!-- /.container-fluid -->
    </div>
    <router-view>

    </router-view>

    <vue-progress-bar></vue-progress-bar>

    {{-- /.content --}}
  </div>
  {{-- /.content-wrapper --}}

  {{-- Main Footer --}}
  <footer class="main-footer">
    {{-- To the right --}}
    <div class="float-right d-none d-sm-block">
     
    </div>
    {{-- Default to the left --}}
    <strong>Copyright &copy; 2021-2022 <a href="">Los Matapalos</a>.</strong>
  </footer>
</div>
{{-- ./wrapper --}}

@auth
<script>
    window.user = @json(auth()->user())
</script>
@endauth
<script src="{{ asset('/js/app.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
</body>
</html>
