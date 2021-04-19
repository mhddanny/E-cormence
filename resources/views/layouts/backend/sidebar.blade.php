<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="{{ asset('e-corm.jpg')}}" width="100px" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">E-Cormence</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    @if(Auth::check())
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (!Auth::user()->image)
            <img src="{{ asset('default.png') }}" class="img-circle elevation-2" alt="User Image">
          @else
            <img src="{{ Auth()->user()->image }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">
                {{ Auth::user()->name }}</p>
          </a>
        </div>
      </div>
    @endif
  <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('produk.index') }}" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Produk
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('produk.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Semua Produk</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('category.index') }}" class="nav-link">
                <i class="far fa-circle nav-icon "></i>
                <p>Kategori</p>
              </a>
            </li>

          </ul>
        </li>

        <li class="nav-item">
          <a href="{{ route('home') }}" target="_blank" class="nav-link" >
            <i class="nav-icon fas fa-store"></i>
            <p>
              Toko
            </p>
          </a>
        </li>

        @if (auth()->user()->level == 'admin')
          <li class="nav-header">MANAGEMEN USER</li>
          <li class="nav-item">
            <a href="{{ route('user.index') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User
              </p>
            </a>
          </li>
        @endif
        <li class="nav-header">Laporan</li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
