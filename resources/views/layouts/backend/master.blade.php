<!DOCTYPE html>
<html  lang="lang="{{ str_replace('_', '-', app()->getLocale()) }}"">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>

  @include('layouts.backend.asset_header')

  </head>
<body class="hold-transition sidebar-mini layout-fixed">
  @include('sweet::alert')

<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.backend.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.backend.sidebar')

  <!-- Content Wrapper. Contains page content -->
  @yield('section')
  <!-- /.content-wrapper -->
  @include('layouts.backend.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

  @include('layouts.backend.asset_footer')

</body>
</html>
