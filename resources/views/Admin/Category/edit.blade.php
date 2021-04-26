@extends('layouts.backend.master')

@section('title')
  Admin | Edit Categoris
@endsection

@section('css')

@endsection

@section('section')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Category</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Categori All</a></li>
              <li class="breadcrumb-item active"> Edit Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="card card-default">
          <form action="{{ route('category.update', [$category->kd_kategori]) }}" method="post" enctype="multipart/form-data">
            @csrf
            {{method_field('PUT')}}
            <div class="card-header">
              <h3 class="card-title">Edit Category</h3>

              {{-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div> --}}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group {{ $errors->has('kategori') ? 'has-error' : '' }}">
                    <label for="kategori">Kategori</label>
                    <input name="kategori" type="text" class="form-control  @error('kategori') is-invalid @enderror" value="{{ $category->kategori }}"  placeholder="Enter Categori" >
                      @error('kategori')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label for="parent_id">Sub-Kategori</label>
                    <select class="custom-select" name="parent_id" >
                        <option value="">None</option>
                          @foreach ($parent as $row)
                            <option value="{{ $row->kd_kategori }}" {{ $category->parent_id == $row->kd_kategori ? 'selected' : '' }}>{{ $row->kategori }}</option>
                          @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="tipe">Tipe</label>
                    <select class="custom-select" id="tipe" name="tipe">
                      <option value="">Tipe</option>
                      <option value="Fashion Pria" @if ($category->tipe == "Fashion Pria") Selected @endif>Fashion pria</option>
                      <option value="Fashion Wanita" @if ($category->tipe == "Fashion Wanita") Selected @endif>Fashion Wanita</option>
                    </select>
                  </div>
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="gambar_kategori">Gambar Sebelum</label>
                    <div class="col-sm-10">
                      <img class="img_thumbnail" src="{{ asset('uploads/'.$category->gambar_kategori) }}" alt="" width="100px">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="gambar_kategori">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="gambar_kategori" class="custom-file-input @error('gambar_kategori') is-invalid @enderror" id="">
                        <label class="custom-file-label" for="gambar_kategori">Choose file</label>
                      </div>
                      @error('gambar_kategori')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                </div>
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
    </section>
  </div>

@endsection

@section('script')
  <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <script type="text/javascript">
            $(function () {
                $('#datetimepicker4').datetimepicker({
                    format: 'L'
                });
            });
            $(document).ready(function () {
              bsCustomFileInput.init();
            });
  </script>
@endsection
