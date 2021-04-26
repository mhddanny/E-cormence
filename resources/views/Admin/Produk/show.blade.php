@extends('layouts.backend.master')

@section('title')
  Admin | Show Produk
@endsection

@section('css')
  <!-- CodeMirror -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/theme/monokai.css') }}">


@endsection

@section('section')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Product All</a></li>
              <li class="breadcrumb-item active">Edit Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Produk Menu</h3>
              </div>
              <div class="card-body">
                <div class="nav flex-column">
                  <a href="{{ route('produk.show',[$produk->kd_produk])}}" class="nav-link">Produk Details</a>
                  <a href="{{ route('imageproduk', [$produk->kd_produk]) }}" class="nav-link">Produk Image</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card card-default">
              <form action="{{ route('produk.update',[$produk->kd_produk]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                {{ method_field('PUT')}}
                <div class="card-header">
                  <h3 class="card-title">Edit Product</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
                        <label for="kode">SKU</label>
                        <input name="kode" type="text" class="form-control  @error('kode') is-invalid @enderror" value="{{ $produk->kode }}"  placeholder="Enter SKU" >
                          @error('kode')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ $produk->name }}"  placeholder="Enter Name" >
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="kd_kategori">Category</label>
                        <select class="custom-select" name="kd_kategori" multiple>
                            <option value="">None</option>
                            @foreach ($category as $row)
                              <option value="{{ $row->kd_kategori }}"
                                @if ($produk->kd_kategori == "$row->kd_kategori")
                                  Selected
                                @endif >{{ $row->kategori }}
                              </option>
                            @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label for="price">Price</label>
                        <input name="price" type="number" class="form-control  @error('price') is-invalid @enderror" value="{{ $produk->price }}"  placeholder=".00" >
                          @error('price')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('weight') ? 'has-error' : '' }}">
                      <label for="weight">Weight (gram)</label>
                      <input name="weight" type="number" class="form-control  @error('weight') is-invalid @enderror" value="{{$produk->weight}}"  placeholder="0" >
                        @error('weight')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group {{ $errors->has('lenght') ? 'has-error' : '' }}">
                        <label for="length">Lenght (cm)</label>
                        <input name="length" type="number" class="form-control  @error('length') is-invalid @enderror" value="{{ $produk->length }}"  placeholder="0" >
                          @error('length')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                    <div class="col-4">
                      <div class="form-group {{ $errors->has('width') ? 'has-error' : '' }}">
                      <label for="width">Width (cm)</label>
                      <input name="width" type="number" class="form-control  @error('width') is-invalid @enderror" value="{{ $produk->width }}"  placeholder="0" >
                        @error('width')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group {{ $errors->has('height') ? 'has-error' : '' }}">
                        <label for="height">Heigth (cm)</label>
                        <input name="height" type="number" class="form-control  @error('height') is-invalid @enderror" value="{{ $produk->height }}"  placeholder="0" >
                          @error('height')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                    </div>
                    <div class="col-10">
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control  @error('description') is-invalid @enderror" value=""  placeholder="Enter Description">
                          {{ $produk->description }}
}                        </textarea>
                          @error('description')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                    </div>
                    <div class="col-10">
                      <div class="form-group">
                        <label for="status">Status</label>
                        <select class="custom-select" name="status" >
                            <option value="">-- Set Status --</option>
                            <option value="0" @if ($produk->status == "0") Selected @endif>Draff</option>
                            <option value="1" @if ($produk->status == "1") Selected @endif>Active</option>
                            <option value="2" @if ($produk->status == "2") Selected @endif>Inctive</option>
                        </select>
                      </div>
                    </div>

                    <!-- /.col -->

                    <!-- /.col -->
                  </div>
                  <!-- /.row -->
                  <!-- /.row -->
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection

@section('script')

  <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- CodeMirror -->
  <script src="{{ asset('AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>

  <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
                // Summernote
                $('#summernote').summernote()
                $('#description').summernote()

                // CodeMirror
                CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
                  mode: "htmlmixed",
                  theme: "monokai"
                });
            });
            $(document).ready(function () {
              bsCustomFileInput.init();
            });
  </script>

@endsection
