@extends('layouts.website.master_web1')

@section('title')
    E-Cormence |  Produk Detail {{ $produk->name }}
@endsection

@section('css')

@endsection

@section('section')

  <div class="content-wrapper" style="min-height: 1416.81px;">

    <section class="content-header">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
              {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> --}}
              <h4>Produk {{$produk->slug}}</h4>

          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Produk</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section>
      <div class="content">
        <div class="container">
          <div class="card-primary card-outline">
            <div class="body">
              <div class="bg-light color-palette col-5 col-sm-3">
                <div class=" mt-4 mb-4">
                  <span>
                    <h4 class="">Kategori</h4>
                  </span>
                </div>
              </div>

              <div class="row">
                <div class="col-5 col-sm-3">
                  <div class="nav flex-column nav-tabs" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                    @if (!empty($kategories))

                      @foreach ($kategories as $kat)
                        <div class="bg-white disabled color-palette">
                          <span><a class="nav-link text-secondary" href="{{ url('/category/'. $kat->slug)}} ">{{ $kat->kategori }}</a></span>
                        </div>

                        @foreach ($kat->child as $child)
                          <div class="bg-white disabled color-palette">
                            <ul >
                              <li>
                                <a class="nav-link text-secondary" href="{{ url('/category/'. $child->slug) }}">{{ $child->kategori }}</a>
                              </li>
                            </ul>
                          </div>
                        @endforeach
                      @endforeach
                    @endif
                  </div>
                </div>

                <div class="col-sm-9 padding-right">
                  <div class="product-details"><!--product-details-->
                    <div class="card card-solid">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-12 col-sm-6">
                            <h3 class="d-inline-block d-sm-none">LOWA Men???s Renegade GTX Mid Hiking Boots Review</h3>
                            <div class="col-12">
                              @if (!$produk->image)
                                <img src="{{ asset('no_image.jpeg') }}"  style="width:400px;height:450px;" class="img-thumbnail" alt="...">
                                @else
                                <img src="{{ asset('uploads/'.$produk->image) }}" class="product-image" style="width:400px;height:450px;" alt="Product Image">
                              @endif
                            </div>

                          </div>
                          <div class="col-12 col-sm-6">
                            <form action="{{ route('addToCart') }}" method="POST">
                              @csrf
                              <h3 class="my-3">{{ $produk->name }}</h3>
                              <p>Kode Produk: {{ $produk->kode}}</p>
                              <p>Berat Produk : {{$produk->weight}} gram</p>
                              {!! $produk->description !!}
                              <p>
                                {{-- @if (auth()->guard('customer')->check())
                                <label>Afiliasi Link</label>
                                <input type="text"
                                  value="{{ url('/produks/ref/' . auth()->guard('customer')->user()->id . '/' . $produk->kd_produk) }}"
                                  readonly class="form-control">
                                @endif --}}
                              </p>
                              <hr>
                              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"
                                class="increase items-count" type="button">
                                <i class="fas fa-plus"></i>
                              </button>
                              <input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty" />
                              <!-- BUAT INPUTAN HIDDEN YANG BERISI ID PRODUK -->
                              <input type="hidden" name="kd_produk" value="{{ $produk->kd_produk }}" class="form-control">
                              <button onclick="var result = document.getElementById('sst'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"
                                class="reduced items-count" type="button">
                                <i class="fas fa-minus"></i>
                              </button>

                              <div class="bg-primary color-palette py-2 px-3 mt-4">
                                <h2 class="mb-0">
                                  @rupiah($produk->price)
                                </h2>
                                <h4 class="mt-0">
                                  <small>Ex Tax: @rupiah($produk->price) </small>
                                </h4>
                              </div>

                            <div class="mt-4">
                              <button type="submit" class="btn btn-success cart">
                                <i class="fa fa-shopping-cart mr-2"></i>
                                Add to cart
                              </button>
                            </div>

                            <div class="mt-4 product-share">
                              <a href="#" class="text-gray">
                                <i class="fab fa-facebook-square fa-2x"></i>
                              </a>
                              <a href="#" class="text-gray">
                                <i class="fab fa-twitter-square fa-2x"></i>
                              </a>
                              <a href="#" class="text-gray">
                                <i class="fas fa-envelope-square fa-2x"></i>
                              </a>
                              <a href="#" class="text-gray">
                                <i class="fas fa-rss-square fa-2x"></i>
                              </a>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div><!--/product-details-->

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('script')

@endsection
