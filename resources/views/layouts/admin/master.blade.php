<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="base-url" content="{{ asset('/') }}">
  <title>My Naitve Tongue| Admin</title>

  <!-- <link rel="icon" href="{{ asset('assets/dist/img/icon.png') }}"> -->
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/main.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/parsley.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/dist/css/admin/custom.css') }}?v=3.0">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href = "{{ asset('assets/dist/css/admin/jquery-ui.css') }}" rel = "stylesheet">
</head>
<div id="overlay">
  <div class="cv-spinner">
    <span class="spinner"></span>
  </div>
</div>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
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
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
    
      <li class="nav-item">
        <a class="nav-link"  href="{{ url('logout') }}" >
          Logout
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    
      @include('layouts.admin.sidebar')

      @yield('content')

      @include('layouts.admin.footer')
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/dist/js/admin/parsley.js') }}"></script>
<script src = "{{ asset('assets/dist/js/admin/jquery-ui.js') }}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{asset('assets/dist/js/admin/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('assets/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{asset('assets/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{asset('assets/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{asset('assets/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{asset('assets/plugins/toastr/toastr.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dist/js/admin/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/dist/js/admin/pages/dashboard2.js') }}"></script>
 <script type="text/javascript">

 </script>
@stack('scripts')   
</body>
</html>
