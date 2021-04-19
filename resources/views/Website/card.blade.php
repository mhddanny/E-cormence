@extends('layouts.website.master_web1')

@section('title')
    E-Cormence | Daftar Karajang
@endsection

@section('css')

@endsection

@section('section')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Card</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="content">
   <div class="container-sm">
     <form action="{{ route('update_card') }}" method="post">
       @csrf
       <div class="card">
           <div class="card-header text-center">
             <h3 class="card-title ">Keranjang Pesanan</h3>
           </div>
           <!-- /.card-header -->
           <div class="card-body p-0">
               <table class="table text-center">
                 <thead>
                   <tr>
                     <th>Produk</th>
                     <th>Nama</th>
                     <th>Harga</th>
                     <th>Kuantitas</th>
                     <th>Total</th>
                     <th></th>
                   </tr>
                 </thead>
                 <tbody>
                   @if (!session($carts))
                        @foreach ($carts as $row)
                          <tr>
                            <td>
                               <img src="{{ asset('uploads/'.$row['image']) }}" class="img-thumbnail" width="150" height="150" alt="Cinque Terre">
                            </td>
                           <td>
                              <h5><label>{{ $row['name']}}</label></h5>
                            </td>
                            <td>
                             <label for="">@rupiah($row['price'])</label>
                            </td>
                            <td>
                               <div class="cart_quantity_button">
                                 <a class="cart_quantity_up" onclick="var result = document.getElementById('sst{{ $row['kd_produk'] }}'); var sst = result.value; if( !isNaN( sst )) result.value++;return false;"> <i class="fas fa-plus"></i></a>
                                 <input class="cart_quantity_input" type="text" name="qty[]" id="sst{{ $row['kd_produk'] }}" maxlength="12" value="{{ $row['qty'] }}" title="Quantity:" class="input-text qty">
                                 <input type="hidden" name="kd_produk[]" value="{{ $row['kd_produk'] }}" class="form-control">
                                 <a class="cart_quantity_down" onclick="var result = document.getElementById('sst{{ $row['kd_produk'] }}'); var sst = result.value; if( !isNaN( sst ) &amp;&amp; sst > 0 ) result.value--;return false;"> <i class="fas fa-minus"></i> </a>
                               </div>
                             </td>
                             <td>
                               <label for="">@rupiah($row['price'] * $row['qty'])</label>
                             </td>
                             <td>
                               <a class="cart_quantity_delete" href="{{ url('/cart/remove/'. $row['kd_produk'])}}"><i class="fas fa-trash-alt text-red"></i></a>
                             </td>
                           </tr>
                         @endforeach

                         @else
                           <tr>
                             <td>
                               <h4 > Tidak ada pesanan </h4>
                             </td>
                           </tr>
                         </tr>
                       @endif
                 </tbody>
               </table>
           </div>
           <div class="card-footer">
             <button type="submit" name="submit" class="btn btn-outline-success btn-block">Update</button>
           </div>
         </form>
         <!-- /.card-body -->
      </div>
        <div class="row mb-3">
          {{-- <div class="col-6 themed-grid-col">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
              <h6 class="border-bottom border-gray pb-2 mb-0">Keranjang Pesanan</h6>
              <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <strong class="d-block text-gray-dark">@username</strong>
                  Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>
              </div>
              <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#e83e8c"></rect><text x="50%" y="50%" fill="#e83e8c" dy=".3em">32x32</text></svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <strong class="d-block text-gray-dark">@username</strong>
                  Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>
              </div>
              <div class="media text-muted pt-3">
                <svg class="bd-placeholder-img mr-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img" aria-label="Placeholder: 32x32"><title>Placeholder</title><rect width="100%" height="100%" fill="#6f42c1"></rect><text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text></svg>
                <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <strong class="d-block text-gray-dark">@username</strong>
                  Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.
                </p>
              </div>
              <small class="d-block text-right mt-3">
                <a href="#">All updates</a>
              </small>
            </div>
          </div> --}}
          <div class="col-12 themed-grid-col">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
              <h6 class="border-bottom border-gray pb-2 mb-0">Bill</h6>
              {{-- <div class="media text-muted pt-3">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Sub Total</strong>
                    @if (!session($carts))
                      @foreach ($carts as $cart)
                      <strong class="text-gray-dark">x {{ $cart['qty'] }}</strong>
                      @endforeach
                    @else
                      <strong class="text-gray-dark">x 0</strong>
                     @endif
                    <label>@rupiah($subtotal)</label>
                  </div>
                </div>
              </div> --}}
              <div class="media text-muted pt-3">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Sub Total</strong>
                    <strong class="text-gray-dark"></strong>
                    <label>@rupiah($subtotal)</label>
                  </div>
                </div>
              </div>
              <div class="media text-muted pt-3">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Biaya Pengiriman</strong>
                    <strong class="text-gray-dark"></strong>
                    <label>Free</label>
                  </div>
                </div>
              </div>
              <div class="media text-muted pt-3">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                  <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Total</strong>
                    <strong class="text-gray-dark"></strong>
                    <label>@rupiah($subtotal)</label>
                  </div>
                </div>
              </div>
              <small class="d-block text-right mt-3">
                <a class="btn btn-outline-primary btn-block" href="{{ route('checkout') }}">Check Out</a>
              </small>
            </div>
          </div>
        </div>


       {{-- <form action="{{ route('update_cart') }}" method="post">
         @csrf
         <div class="row mb-3">
           <div class="col-6 themed-grid-col">
             <div class="card">
               <div class="card-header">
                 <h3 class="card-title">Keranjang Pesanan</h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body p-0">
                 <div class="left">
                <div class="coupon">
                  <form action="#" target="_blank">
                    <input name="Coupon" placeholder="Enter Your Coupon">
                    <button class="btn">Apply</button>
                  </form>
                </div>
                <div class="checkbox">
                  <label class="checkbox-inline" for="2"><input name="news" id="2" type="checkbox"> Shipping (+10$)</label>
                </div>
              </div>
               </table>
             </div>
             <!-- /.card-body -->
           </div>
         </div>
         <div class="col-6 themed-grid-col">
           <div class="card card-warning">
             <div class="card-header">
               <h3 class="card-title">Apakah sudah sesuai yang Anda inginkan ?</h3>
             </div>
             <!-- /.card-header -->
             <div class="card-body">
               <form role="form">
                 <div class="row">
                   <div class="col-sm-6">
                     <!-- text input -->
                     <label>PRODUK</label><br>
                     <label for="">SUB TOTAL</label><br>
                     <label for="">BIAYA PEBGIRIMAN</label><br>
                     <label for="">Total</label>
                   </div>
                   <div class="col-sm-6">
                     <label for="">
                       x
                       @foreach ($carts as $cart)
                         {{$cart['qty']}} {{$cart['harga']}}
                       @endforeach
                     </label><br>
                     <label>@rupiah($subtotal)</label><br>
                     <label for="">Free</label><br>
                     <label for="">@rupiah($subtotal)}</label><br>
                   </div>
                 </div>
                 <button type="submit" name="submit" class="btn btn-default btn-sm">Update</button>
                 <a class="btn btn-default btn-sm" href="{{ route('checkout') }}">Check Out</a>
               </form>
             </div>
             <!-- /.card-body -->
           </div>
         </div>
       </div>
      </form> --}}
   </div>
 </div>
</div>

@endsection

@section('script')

@endsection
