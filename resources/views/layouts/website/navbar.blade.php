
<nav class="main-header navbar navbar-expand-md sticky-top navbar-light navbar-white">
  <div class="container">
    <a href="{{ route('home') }}" class="navbar-brand">
      <img src="{{ asset('e-corm.jpg') }}" alt="E-Cormence" class="brand-image img-circle elevation-3"
           style="opacity: .8" width="80px">
      <span class="brand-text font-weight-light">E-Cormence</span>
    </a>

    <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="col-lg-8 pr-0">
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('web.produk') }}" class="nav-link">Produk</a>
          </li>
        </ul>
      </div>
    </div>
    <!-- Right navbar links -->
    <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">

      <!-- Messages Dropdown Menu -->
      {{-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-shopping-cart"></i>
          <span class="badge badge-danger navbar-badge">
            @if (!session($carts))
              {{ count($carts) }}
            @else
              {{0}}
            @endif
          </span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @if (!session($carts))
               @foreach ($carts as $row)
                <a href="{{route('listCart')}}" class="dropdown-item">
                  <!-- Message Start -->
                  <div class="media">
                    <img src="{{ asset('uploads/'.$row['image']) }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                    <div class="media-body">
                      <h3 class="dropdown-item-title">
                        {{ $row['name']}}
                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                      </h3>
                      <p class="text-sm">Call me whenever you can...</p>
                      <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                    </div>
                  </div>
                  <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              @endforeach
            @else
                <a href="{{ route('listCart') }}">Record Don,t</a>
          @endif
        </div>
      </li> --}}
      <!-- Notifications Dropdown Menu -->

      <li class="nav-item">
        <a class="nav-link" href="{{ route('listCart') }}">
          <i class="fas fa-shopping-cart"></i>
        </a>
      </li>

        @if (Auth::check())
          <li class="nav-item ">
            <form action="{{ route('logout') }}" method="post">
              @csrf
              <button type="submit" class="btn btn-outline-danger btn-sm ml-5 mt-1"> <i class="fas fa-sign-out-alt"></i></button>
            </form>
          </li>
        @else
          <li class="nav-item md-3">
            <form action="{{ route('login') }}" method="get">
              @csrf
              <button type="submit" class="btn btn-outline-primary btn-sm ml-5 mt-1"> <i class="fas fa-sign-out-alt"></i></button>
            </form>
            {{-- <a class="nav-link" href="{{ route('login') }}">
              <i class="fas fa-sign-in-alt"></i>
            </a> --}}
          </li>
        @endif

      {{-- @if (auth()->guard('customer')->check())
        <li class="nav-item dropdown user user-menu mt-2">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('img/userlogo.png') }}" class="user-image" alt="User Image">

            <span class="hidden-xs">{{ auth()->guard('customer')->user()->name }}</span>

          </a>
          <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <!-- User image -->
            <li class="user-header">
              <img src="{{ asset('img/userlogo.png') }}" class="img-circle" alt="User Image">
              <p>

                {{ Auth::guard('customer')->user()->name }}
                <small>{{ Auth::guard('customer')->user()->email }}</small>


              </p>
            </li>
            <!-- Menu Body -->
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="row mb-2">
                <div class="col-sm-6 text-left">
                  <a href="{{ route('customer.dashboard')}}" type="button" class="btn btn-outline-info btn-sm"> Lock Account</a>
                </div>
                <div class="col-sm-6 text-right">
                  <form action="{{ route('customer.logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm"> Sing Out</button>
                  </form>
                </div>
              </div>
            </li>
          </ul>
        </li>
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ route('customer.logout') }}">
            <i class="fas fa-sign-out-alt"></i>
          </a>
        </li> --}}
      {{-- @else --}}
        {{-- <li class="nav-item">
          <a class="nav-link" href="{{ route('customer.login') }}">
            <i class="fas fa-sign-in-alt"></i>
          </a>
        </li> --}}
      {{-- @endif --}}

    </ul>
  </div>
</nav>

    <!-- /.navbar -->
