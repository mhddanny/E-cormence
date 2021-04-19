@extends('layouts.website.master_web1')

@section('title')
  E-Cormence | Daftar Keranjang
@endsection

@section('css')
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
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
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ route('listCart') }}">Card</a></li>
              <li class="breadcrumb-item active">Checkout</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="conten-body">
      <div class="container">
        <div class="py-5 text-center">
          {{-- <img class="d-block mx-auto mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> --}}
          <h2>Checkout</h2>
          <p class="lead">Masukan Data Informasi Pengiriman  ...!</p>
        </div>

        <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
              <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted">Your cart</span>
                {{-- @foreach ($carts as $cart)
                  <span class="badge badge-secondary badge-pill">{{ $cart['qty']->count() }}</span>
                @endforeach --}}
              </h4>
              <ul class="list-group mb-3">
                @if (!session($carts))
                  @foreach ($carts as $row)
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">{{ $row['name']}}</h6>
                        <small class="text-muted">{{ $row['kode'] }}</small>
                      </div>
                      <strong class="text-gray-dark">x {{ $row['qty'] }}</strong>
                      <span class="text-muted">@rupiah($row['price'])</span>
                    </li>
                    {{-- <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Second product</h6>
                    <small class="text-muted">Brief description</small>
                  </div>
                  <span class="text-muted">$8</span>
                </li>
                <li class="list-group-item d-flex justify-content-between lh-condensed">
                  <div>
                    <h6 class="my-0">Third item</h6>
                    <small class="text-muted">Brief description</small>
                  </div>
                  <span class="text-muted">$5</span>
                </li> --}}
                    @endforeach
                      <li class="list-group-item d-flex justify-content-between lh-condensed">
                      <div>
                        <h6 class="my-0">Kurir</h6>
                        <small class="text-muted"></small>
                      </div>
                      <span class="ongkir">Rp 0</span>
                    </li>
                  @else
                    <div class="text-center">
                      <h4>Tidak ada Pesanan</h4>
                    </div>
                    @endif
                      {{-- <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                          <h6 class="my-0">Promo code</h6>
                          <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                      </li> --}}
                      <li class="list-group-item d-flex justify-content-between">
                          <span>Subtotal </span>
                          <strong>@rupiah($subtotal)</strong>
                      </li>
                      <li class="list-group-item d-flex justify-content-between">
                          <span>Total </span>
                          <strong id="total">@rupiah($subtotal)</strong>
                      </li>
                </ul>
          </div>
          <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form class="" action="#" method="post" >
              @csrf
              <div class="mb-3 {{$errors->has('name') ? 'has-error' : ''}}">
                <label for="name">Nama Lengkap</label>
                <div class="input-group ">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Full Name" value="{{ old('name') }}" required >
                </div>
                @if (@$errors->has('name'))
                  <span class="help-block">{{$errors->first('name')}}</span>
                @endif
              </div>

              <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                <label for="email">Email</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                  </div>
                  <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com" required>
                </div>
                  @if (@$errors->has('email'))
                    <span class="help-block">{{$errors->first('email')}}</span>
                  @endif
              </div>

              <div class="form-group {{$errors->has('nohp') ? 'has-error' : ''}}">
                  <label for="nohp">No Tlpn</label>

                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="number" class="form-control" name="nohp" id="number" placeholder="No Hp" value="{{ old('nohp') }}" required >
                  </div>
                  @if (@$errors->has('nohp'))
                    <span class="help-block">{{$errors->first('nohp')}}</span>
                  @endif
                  <!-- /.input group -->
                </div>

              {{-- <div class="mb-3 {{$errors->has('ktp') ? 'has-error' : ''}}">
                <label for="ktp">KTP</label>
                <input type="number" class="form-control" name="ktp" id="ktp" placeholder="Masukan No KTP" value="{{ old('ktp') }}" >
                  @if (@$errors->has('ktp'))
                    <span class="help-block">{{$errors->first('ktp')}}</span>
                  @endif
              </div> --}}

              <div class="form-group {{$errors->has('ktp') ? 'has-error' : ''}}">
                <label for="ktp">No KTP</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                  </div>
                  <input type="number" class="form-control" name="ktp" id="ktp" placeholder="Masukan No KTP" required>
                </div>
                @if (@$errors->has('ktp'))
                  <span class="help-block">{{$errors->first('ktp')}}</span>
                @endif
              </div>

              <div class="mb-3"  {{$errors->has('alamat') ? 'has-error' : ''}}>
                <label for="alamat">Alamat</label>
                <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}" required>
                @if (@$errors->has('alamat'))
                  <span class="help-block">{{$errors->first('alamat') }}</span>
                @endif
              </div>

              {{-- <div class="mb-3">
                <label for="alamat2">Address 2 <span class="text-muted">(Optional)</span></label>
                <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
              </div> --}}

              <div class="row">
                <div class="col-md-5 mb-3">
                  <label for="province_id">Kota</label>
                  <input type="text" class="form-control" name="Kota" value="">
                </div>
                <div class="col-md-5 mb-3">
                  <label for="portal">Porta</label>
                  <input type="number" class="form-control" name="porta" value="">
                </div>

                {{-- <div class="col-md-3 mb-3">
                  <label for="zip">Kode POS</label>
                  <input type="text" class="form-control" id="zip" placeholder="" >
                  <div class="invalid-feedback">
                    Zip code required.
                  </div>
                </div> --}}
              </div>
              <hr class="mb-4">

              <button class="btn btn-primary btn-lg btn-block" type="submit" >Continue to checkout</button>
              <hr class="mb-4">
            </form>
          </div>
        </div>

      </div>
    </section>

  </div>

@endsection

@section('script')
  <!-- Select2 -->
  <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
  <!-- Bootstrap4 Duallistbox -->
  <script src="{{ asset('AdminLTE/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
  <!-- InputMask -->
  <script src="{{ asset('AdminLTE/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
  <!-- Bootstrap Switch -->
  <script src="{{ asset('AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>

  <script>
       $(document).ready(function(){
          //KETIKA SELECT BOX DENGAN ID province_id DIPILIH
          $('#province_id').on('change', function() {
              //MAKA AKAN MELAKUKAN REQUEST KE URL /API/CITY
              //DAN MENGIRIMKAN DATA PROVINCE_ID
              $.ajax({
                  url: "{{ url('/api/city') }}",
                  type: "GET",
                  data: { province_id: $(this).val() },
                  success: function(html){
                      //SETELAH DATA DITERIMA, SELEBOX DENGAN ID CITY_ID DI KOSONGKAN
                      $('#city_id').empty()
                      //KEMUDIAN APPEND DATA BARU YANG DIDAPATKAN DARI HASIL REQUEST VIA AJAX
                      //UNTUK MENAMPILKAN DATA KABUPATEN / KOTA
                      $('#city_id').append('<option value="">Pilih Kabupaten/Kota</option>')
                      $.each(html.data, function(key, item) {
                          $('#city_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                      })
                  }
              });
          })

          //LOGICNYA SAMA DENGAN CODE DIATAS HANYA BERBEDA OBJEKNYA SAJA
          $('#city_id').on('change', function() {
              $.ajax({
                  url: "{{ url('/api/district') }}",
                  type: "GET",
                  data: { city_id: $(this).val() },
                  success: function(html){
                      $('#district_id').empty()
                      $('#district_id').append('<option value="">Pilih Kecamatan</option>')
                      $.each(html.data, function(key, item) {
                          $('#district_id').append('<option value="'+item.id+'">'+item.name+'</option>')
                      })
                  }
              });
          })

            //JIKA KECAMATAN DIPILIH
            $('#district_id').on('change', function() {
            //MEMBUAT EFEK LOADING SELAMA PROSES REQUEST BERLANGSUNG
            $('#courier').empty()
            $('#courier').append('<option value="">Loading...</option>')

            //MENGIRIM PERMINTAAN KE SERVER UNTUK MENGAMBIL DATA API
            $.ajax({
                url: "{{ url('/api/cost') }}",
                type: "POST",
                data: { destination: $(this).val(), weight: $('#weight').val() },
                success: function(html){
                    //BERSIHKAN AREA SELECT BOX
                    $('#courier').empty()
                    $('#courier').append('<option value="">Pilih Kurir</option>')

                    //LOOPING DATA ONGKOS KIRIM
                    $.each(html.data.results, function(key, item) {
                        let value = item.courier + '-' + item.service + '-'+ item.cost
                        let courier = item.courier + '-' + item.service + ' (Rp '+ item.cost +')'
                        //DAN MASUKKAN KE DALAM OPTION SELECT BOX
                        $('#courier').append('<option value="'+item.courier + '-' + item.service + '-'+ item.cost+'">'+item.courier + '-' + item.service + ' (Rp '+ item.cost +')'+'</option>')
                    })
                }
              });
            })

            //JIKA KURIR DIPILIH
            $('#courier').on('change', function() {
            //UPDATE INFORMASI BIAYA PENGIRIMAN
            let split = $(this).val().split('-')
                        $('#ongkir').text('Rp ' + split[2])

            //UPDATE INFORMASI TOTAL (SUBTOTAL + ONGKIR)
            let subtotal = "{{ $subtotal }}"
            let total = parseInt(subtotal) + parseInt(split['2'])
                        $('#total').text('Rp' + total)
            })
          });
    </script>
@endsection
