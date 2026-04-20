<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Glow Beauty Shop | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('cms/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('cms/plugins/summernote/summernote-bs4.min.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

  <style>

    :root{
        --glow-pink:#c97c9d;
        --glow-pink-dark:#b46888;
    }


    .glow-sidebar{
        background: #2f343a;
    }

    .glow-sidebar .brand-link{
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .glow-sidebar .user-panel{
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .glow-sidebar .user-panel .info a{
        font-weight: 800;
        letter-spacing: .2px;
    }

    .glow-sidebar .nav-header{
        color: rgba(255,255,255,.55);
        font-size: .72rem;
        letter-spacing: .12em;
        text-transform: uppercase;
        margin-top: 10px;
    }


    .glow-sidebar .nav-sidebar > .nav-item > .nav-link{
        margin: 6px 10px;
        border-radius: 12px;
        padding: .62rem .75rem;
        transition: .18s ease-in-out;
    }


    .glow-sidebar .nav-link .nav-icon{
        color: rgba(255,255,255,.72);
        transition: .18s ease-in-out;
    }


    .glow-sidebar .nav-sidebar > .nav-item > .nav-link:hover{
        background: rgba(201,124,157,.16);
        color: #fff;
    }
    .glow-sidebar .nav-sidebar > .nav-item > .nav-link:hover .nav-icon{
        color: #fff;
    }


    .glow-sidebar .nav-sidebar > .nav-item > .nav-link.active{
        background: linear-gradient(135deg, var(--glow-pink), var(--glow-pink-dark));
        color: #fff;
        box-shadow: 0 10px 18px rgba(201,124,157,.20);
    }
    .glow-sidebar .nav-sidebar > .nav-item > .nav-link.active .nav-icon{
        color: #fff;
    }


    .glow-sidebar .nav-treeview{
        padding-left: 6px;
    }
    .glow-sidebar .nav-treeview .nav-link{
        margin: 4px 10px 4px 22px;
        border-radius: 12px;
        opacity: .92;
    }


    .glow-sidebar .form-control-sidebar{
        border-radius: 12px;
    }
    .glow-sidebar .btn-sidebar{
        border-radius: 12px;
    }
</style>
@yield('styles')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('cms\dist\img\GlowShopLogo.png') }}" alt="GlowShopLogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">3</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('cms/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{asset('cms/dist/img/user8-128x128.jpg')}}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('cms/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">15</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4 glow-sidebar">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('cms\dist\img\GlowShopLogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Glow Beauty Shop</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('cms\dist\img\GlowShopLogo.png') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin Panel</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

{{-- Sidebar Menu --}}
<nav class="mt-2">
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

    {{-- cms --}}
    <li class="nav-item">
      <a href="{{ route('cms.dashboard') }}" class="nav-link">
        <i class="nav-icon fas fa-chart-line"></i>
        <p>DashBoard</p>
      </a>
    </li>

        {{-- Admins --}}
    <li class="nav-item">
      <a href="{{ route('cms.admins.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Admins</p>
      </a>
    </li>

    <li class="nav-header">Content Management</li>

    {{-- Categories --}}
    <li class="nav-item">
      <a href="{{ route('cms.categories.index') }}" class="nav-link">
        <i class="nav-icon fas fa-tags"></i>
        <p>Categories</p>
      </a>
    </li>

    {{-- Brands --}}
    <li class="nav-item">
      <a href="{{ route('cms.brands.index') }}" class="nav-link">
        <i class="nav-icon fas fa-copyright"></i>
        <p>Brands</p>
      </a>
    </li>

    {{-- Products --}}
    <li class="nav-item">
      <a href="{{ route('cms.products.index') }}" class="nav-link">
        <i class="nav-icon fas fa-box-open"></i>
        <p>Products</p>
      </a>
    </li>

    <li class="nav-header">Sales</li>

    {{-- Orders --}}
    <li class="nav-item">
      <a href="{{ route('cms.orders.index') }}" class="nav-link">
        <i class="nav-icon fas fa-shopping-bag"></i>
        <p>Orders</p>
      </a>
    </li>

    {{-- Carts --}}
    <li class="nav-item">
      <a href="{{ route('cms.carts.index') }}" class="nav-link">
        <i class="nav-icon fas fa-shopping-cart"></i>
        <p>Carts</p>
      </a>
    </li>

    <li class="nav-header">Users</li>

    {{-- Customers --}}
    <li class="nav-item">
      <a href="{{ route('cms.customers.index') }}" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Customers</p>
      </a>
    </li>

    <li class="nav-header">Support</li>

    {{-- Contact Messages --}}
    <li class="nav-item">
      <a href="{{ route('cms.contact-messages.index') }}" class="nav-link">
        <i class="nav-icon fas fa-envelope"></i>
        <p>Contact Messages</p>
      </a>
    </li>

    {{-- Team Members --}}
    <li class="nav-item">
      <a href="{{ route('cms.team_members.index') }}" class="nav-link">
        <i class="nav-icon fas fa-users"></i>
        <p>Team Members</p>
      </a>
    </li>

    <li class="nav-header">Setting</li>

    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user-edit"></i>
        <p>Edit Profile</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="#" class="nav-link">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p>Logout</p>
      </a>
    </li>

  </ul>
</nav>
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('main-title')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">@yield('sub-title')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

@yield('content')
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; {{now()->year }} - {{ now()->year+1 }} <a href="https://adminlte.io">{{ env('APP_NAME')}}</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> {{ env('APP_version') }}
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('cms/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('cms/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('cms/plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
{{--  <script src="{{ asset('cms/plugins/sparklines/sparkline.js') }}"></script>  --}}
<!-- JQVMap -->
<script src="{{ asset('cms/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('cms/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('cms/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('cms/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('cms/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('cms/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('cms/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('cms/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('cms/dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('cms/dist/js/demo.js') }}"></script>
<!-- AdminLTE cms demo (This is only for demo purposes) -->
{{--  <script src="{{ asset('cms/dist/js/pages/cms.js') }}"></script>  --}}
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('js/crud.js') }}"></script>
@yield('scripts')
</body>
</html>
