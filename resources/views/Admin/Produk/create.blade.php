@extends('layouts.backend.master')

@section('title')
  Admin | Create Product
@endsection

@section('css')
  <!-- CodeMirror -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/codemirror.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/theme/monokai.css') }}">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.css') }}">

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
              <li class="breadcrumb-item active">Create Product</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-default">
              <form action="{{ route('produk.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                  <h3 class="card-title">Create Product</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group {{ $errors->has('kode') ? 'has-error' : '' }}">
                        <label for="kode">Kode</label>
                        <input name="kode" type="text" class="form-control  @error('kode') is-invalid @enderror" value="{{ old('kode') }}"  placeholder="Enter Kode" >
                          @error('kode')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}"  placeholder="Enter Name" >
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group">
                        <label for="kd_kategori">Category</label>
                        <select class="custom-select" name="kd_kategori" >
                            <option value="">None</option>
                              @foreach ($category as $row)
                                <option value="{{ $row->kd_kategori }}">{{ $row->kategori }}</option>
                              @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
                        <label for="price">Price</label>
                        <input name="price" type="number" class="form-control  @error('price') is-invalid @enderror" value="{{ old('price') }}"  placeholder=".00" >
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
                      <input name="weight" type="number" class="form-control  @error('weight') is-invalid @enderror" value="{{ old('weight') }}"  placeholder="0" >
                        @error('weight')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>
                    <div class="col-10">
                      <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control  @error('description') is-invalid @enderror" value="{{ old('description') }}"  >

                        </textarea>
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
                          <option value="0">Draff</option>
                          <option value="1">Aktif</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">

                        <div class="custom-file">
                          <input type="file" name="image" class="custom-file-input @error('sku') is-invalid @enderror" value="{{ old('image') }}"  placeholder="Choose image" id="image">
                          <label class="custom-file-label" for="customFile">Choose file</label>
                          @error('path')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                        </div>
                        {{-- <input type="file" name="image" placeholder="Choose image" id="image"> --}}
                      </div>
                    </div>
                    <div class="col-md-10">
                      <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                      alt="preview image" style="max-height: 100px;">
                    </div>

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
        </div>
      </div>
    </section>


@endsection

@section('script')
  <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
  <!-- CodeMirror -->
  <script src="{{ asset('AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
  <script src="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
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

            $(document).ready(function (e) {
              bsCustomFileInput.init();
              $.ajaxSetup({
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              });
            $('#image').change(function(){
              let reader = new FileReader();
              reader.onload = (e) => {
                  $('#preview-image-before-upload').attr('src', e.target.result);
                  }
              reader.readAsDataURL(this.files[0]);
            });
            $('#image-upload').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                  $.ajax({
                      type:'POST',
                      url: "{{ url('upload')}}",
                      data: formData,
                      cache:false,
                      contentType: false,
                      processData: false,
                      success: (data) => {
                          this.reset();
                          alert('Image has been uploaded using jQuery ajax successfully');
                      },
                      error: function(data){
                      console.log(data);
                      }
                    });
                });
            });

  </script>

@endsection
