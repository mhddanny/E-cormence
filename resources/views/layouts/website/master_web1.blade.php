<!DOCTYPE html>
<html lang="lang="{{ str_replace('_', '-', app()->getLocale()) }}"">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  @include('layouts.website._asset_header')
  <style>
    .menu-sidebar-area {
      list-style-type:none; padding-left: 0; font-size: 15pt;
    }
    .menu-sidebar-area > li {
      margin:0 0 10px 0;
      list-style-position:inside;
      border-bottom: 1px solid black;
    }
    .menu-sidebar-area > li > a {
      color: black
    }
  </style>
</head>
{{-- <body class="hold-transition sidebar-mini layout-fixed"> --}}
<body class="hold-transition layout-top-nav">
@include('sweet::alert')
  <div class="wrapper">

    <!-- Navbar -->
    @include('layouts.website.navbar')
    <!-- /.navbar -->

    {{-- <!-- Main Sidebar Container -->
    @include('WF_Collection.layouts.sidebar') --}}


    <!-- Content Wrapper. Contains page content -->
    @yield('section')
    <!-- /.content-wrapper -->
    @include('layouts.website.footer')


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->
  @include('layouts.website._asset_footer')
</body>
</html>
