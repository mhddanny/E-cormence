@extends('layouts.website.master_web1')

@section('title')
    E-Cormence | Produk ALL
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
              <h4>Produk ALL</h4>

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
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <form action="{{ route('addToCart') }}" method="POST">
                    @csrf
                    <div class="row">
                      @forelse ($produk as $row)
                        <div class="col-md-3">
                          <div class="card mb-3 shadow-sm text-center" >
                            @if ($row->produkImages->first())
                              <img src="{{ asset('uploads/'.$row->produkImages->first()->path) }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="{{ $row->name }}">
                            @else
                              <img src="{{ asset('no_image.jpeg') }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="...">
                            @endif
                            {{-- <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: Thumbnail"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"/><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg> --}}
                            <div class="card-body">
                              <h4><span style="color:blue;font-weight:bold">@rupiah($row->price_label())</span></h4>
                              <p class="card-text">{{ $row->name}}</p>
                              <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                  {{-- <button type="submit" class="btn btn-sm btn-outline-primary"><i class="fa fa-shopping-cart"></i> Add to Cart</button> --}}
                                  <a href="{{ url('/produk/shop/'. $row->slug) }}" class="btn btn-sm btn-outline-primary"><i class="far fa-eye"> View</i></a>
                                </div>
                                <small class="text-muted">{{ $row->created_at->diffforHumans()}}</small>
                              </div>
                            </div>
                          </div>
                        </div>
                      @empty
                        <div class="col-md-9">
                            <h3 class="text-center">Tidak ada produk</h3>
                        </div>
                      @endforelse
                    </div>
                  </form>
                </div>
                {{ $produk->links() }}
              </div>
            </div>
          </div>
          <!-- /.card -->
        </div>

        </div>
      </div>
    </section>
  </div>

@endsection

@section('script')

@endsection
