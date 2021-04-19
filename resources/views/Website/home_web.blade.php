@extends('layouts.website.master_web1')

@section('title')
    E-Cormence | Home
@endsection

@section('css')

@endsection

@section('section')

  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-10">
              {{-- <div class="card">
                  {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                  {{-- <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif  --}}

                      <section class="content">
                        <div class="main_box">
                          <div class="container">
                            <div class="row">
                              <div class="col-sm-12 text-center mt-4 mb-4">
                                <h2>Produk Terbaru</h2>
                                <p>Tampil trendi dengan kumpulan produk kekinian kami.</p>
                              </div>
                            </div>
                            <div class="row">
                              @forelse ($produk as $row)
                                <div class="col-sm-3">
                                  <div class="card card-primary card-outline">
                                    <div class="card-header ">
                                      @if (!$row->image)
                                        <img src="{{ asset('no_image.jpeg') }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="...">
                                        @else
                                          <img src="{{ asset('uploads/'.$row->image) }}"  style="width:300px;height:250px;" class="img-thumbnail" alt="...">
                                      @endif
                                    </div>
                                    <div class="card-body">
                                      <div class="text-center">
                                        <h5>{{ $row->name}}</h5>
                                        <p class="card-text">@rupiah($row->price)</p>
                                      </div>
                                    </div>
                                    <div class="card-footer">
                                      <div class="text-center">
                                        <a href="{{ url('/shop/'. $row->slug) }}" class="btn btn-block btn-outline-primary btn-sm"><i class="fa fa-shopping-cart"></i> Produk Detail</a>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!-- /.col-md-6 -->
                              @empty
                                <div class="col-lg-12">
                                    <h3 class="text-center">Tidak ada produk</h3>
                                </div>
                              @endforelse
                            </div>
                          </div>
                        </div>
                      </section>

                  {{-- </div>
              </div> --}}
          </div>
      </div>
  </div>

@endsection

@section('script')

@endsection
