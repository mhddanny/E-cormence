<x-master-layout title="Admin | Create Produk">
  @push('css')
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/theme/monokai.css') }}">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.css') }}">  
  @endpush

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

                      <div class="form-group produk-type">
                        <label for="type">Type</label>
                        <select class="custom-select produk-type" name="type" id="produk-type">
                          <option value="">None</option>
                          <option value="simple">Simple</option>
                          <option value="configurable">Configurable</option>
                        </select>
                      </div>

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

                      <div class="configurable-attributes" id="configurable-attributes">
                        @if (!empty($configurableAttributes))
                          <label class="text-primary mt-4">Configurable Attributes</label>                         
                            <div class="form-group">
                              @foreach ($configurableAttributes as $attribute)
                                <label for="{{$attribute->code}}">{{ $attribute->code }}</label>
                                <select class="custom-select" name="{{ $attribute->code. '[]' }}" multiple >
                                  <option value="">None</option>
                                  @foreach ($attribute->attributeOptions as $item)                                  
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                  @endforeach
                                </select>
                              @endforeach
                            </div>
                        @endif
                      </div>
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

    @push('script')
      <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
      <!-- CodeMirror -->
      <script src="{{ asset('AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
      <script src="{{ asset('AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
      <script src="{{ asset('AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
      <script src="{{ asset('AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
      <script src="{{ asset('AdminLTE/plugins/dropzone/min/dropzone.min.js') }}"></script>
      <script type="text/javascript">
        function showHideconfigurableAttributes(){
                  var produkType = $("#produk-type").val();
                  if (produkType == "configurable") {
                      $("#configurable-attributes").show();
                  } else {
                      $("#configurable-attributes").hide();
                  }
                }
    
                $(function () {
                  showHideconfigurableAttributes();
                  $("#produk-type").change(function() {
                    showHideconfigurableAttributes();
                  });
    
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
    @endpush
    
</x-master-layout>