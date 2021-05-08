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
    <li class="nav-item dropdown user user-menu mt-2">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        @if(Auth::check())
          {{-- <img src="{{ asset('img/userlogo.png') }}" class="user-image" alt="User Image"> --}}
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        @endif
      </a>
      <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        @if(Auth::check())
        <li class="user-header">
            @if (!Auth::user()->image)
              <img src="{{ asset('default.png') }}" class="img-circle" alt="User Image">
            @else
              <img src="{{ asset('default.png') }}" class="img-circle" alt="User Image">
            @endif
            <p>
              {{ Auth::user()->name }}
              <small>{{ Auth::user()->level }}</small>

            </p>
          </li>
        @endif
        <!-- Menu Body -->
        <!-- Menu Footer-->
        <li class="user-footer">
          <div class="row mb-2">
            <div class="col-sm-6 text-left">
              <a type="submit" class="btn btn-outline-info btn-sm"> Lock Account</a>
            </div>
            <div class="col-sm-6 text-right">
              <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger btn-sm"> Sing Out</button>
              </form>
            </div>
          </div>
        </li>
      </ul>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
