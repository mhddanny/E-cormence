<x-master-layout title="Admin | Edit Images Produk {{ $produk->slug }}">
  @push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <!-- CodeMirror -->
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/codemirror.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/codemirror/theme/monokai.css') }}">  
  @endpush
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Product {{ $produk->slug }}</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('produk.index') }}">Product All</a></li>
              <li class="breadcrumb-item"><a href="{{ route('produk.edit',[$produk->kd_produk]) }}">Product {{ $produk->slug }}</a></li>
              <li class="breadcrumb-item active">Edit Product Images</li>
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
                  <a href="{{ route('produk.edit',[$produk->kd_produk])}}" class="nav-link">Produk Details</a>
                  <a href="{{ route('imageproduk',[$produk->kd_produk]) }}" class="nav-link">Produk Image</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-8">
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Produk Images {{ $produk->name }}</h3>
              </div>
              <div class="card-body">
                <table table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Gambar</th>
                            <th>Tanggal Uploads</th>
                            <th width="30%">Action</th>
                        </tr>
                   </thead>
                   <tbody>
                     @foreach ($images as $image)
                       <tr>
                           <td>{{ $loop->iteration  }}</td>
                           <td><img class="img-thumbnail" width="100px" src="{{ asset('uploads/'.$image->path) }}" /></td>
                           <td>{{ $image->created_at }}</td>
                           <td>
                             <form class="" action="{{ route('imagedelete',[$image->id]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                               @csrf
                               {{ method_field('Delete') }}
                               <button type="submit" name="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                             </form>
                           </td>
                       </tr>
                     @endforeach
                   </tbody>
                </table>
              </div>
              <div class="card-footer">
                {{-- <a class="btn btn-success col fileinput-button" href="{{ route('imageupload',[$produk->kd_produk]) }}"><i class="fas fa-plus"></i> <span>Add files</span></a> --}}

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                  <i class="fas fa-plus"></i> <span>Add Image</span>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Create Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('store_image',[$produk->kd_produk]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">

                  <div class="custom-file">
                    <input type="file" name="path" class="custom-file-input @error('sku') is-invalid @enderror" value="{{ old('path') }}"  placeholder="Choose image" id="image">
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
              <div class="col-md-12 mb-2">
                <img id="preview-image-before-upload" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                alt="preview image" style="max-height: 100px;">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="button" class="btn btn-primary">Save Image</button>
          </div>
      </form>
      </div>
    </div>
  </div>
  @push('script')
    <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
    <!-- CodeMirror -->
    <script src="{{ asset('AdminLTE/plugins/codemirror/codemirror.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/codemirror/mode/css/css.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/codemirror/mode/xml/xml.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/codemirror/mode/htmlmixed/htmlmixed.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ asset('AdminLTE/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script type="text/javascript">
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
        });
    </script>

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
    <script type="text/javascript">
        $(document).ready(function (e) {
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