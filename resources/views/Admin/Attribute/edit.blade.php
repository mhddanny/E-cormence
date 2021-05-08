<x-master-layout title="Admin | Edit Attribute">
  @push('css')
        <!-- DataTables -->
      <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
      <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">      
  @endpush

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Attribute {{ $attribute->name }}</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('attribute.index') }}">Product All</a></li>
              <li class="breadcrumb-item active">Edit Attribute</li>
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
              <form action="{{ route('attribute.update', [$attribute->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                {{method_field('PUT')}}
                <div class="card-header">
                  <h3 class="card-title">Edit Attribute {{ $attribute->name }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                        <label for="code">code</label>
                        <input name="code" type="text" class="form-control  @error('code') is-invalid @enderror" value="{{ $attribute->code }}" readonly="readonly">
                          @error('code')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ $attribute->name }}" >
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>
                      
                      <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="type">Type</label>
                        <select class="custom-select @error('type') is-invalid @enderror" id="type" name="type" disabled>
                          <option value="">-- Set Status --</option>
                          <option value="text" @if ($attribute->type == "text") Selected @endif>Text</option>
                          <option value="textarea" @if ($attribute->type == "textarea") Selected @endif>Textarea</option>
                          <option value="price" @if ($attribute->type == "price") Selected @endif>Price</option>
                          <option value="boolean" @if ($attribute->type == "boolean") Selected @endif>Boolean</option>
                          <option value="select" @if ($attribute->type == "select") Selected @endif>Select</option>
                          <option value="datetime" @if ($attribute->type == "datetime") Selected @endif>Datetime</option>
                          <option value="date" @if ($attribute->type == "date") Selected @endif>Date</option>
                        </select>
                        <input name="type" value="{{ $attribute->type }}" hidden>

                        @error('type')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                    </div>  
            
                    <div class="col-10">
                        <p class="mt-4">Validate</p>
                        <div class="form-group">
                            <label for="is_required">is Required ?</label>
                            <select class="custom-select" name="is_required" id="is_unique" >
                                <option value="0" @if ($attribute->is_required == "0") Selected @endif></option>
                                <option value="1" @if ($attribute->is_required == "1") Selected @endif>Yes</option>
                              
                            </select>
                          </div>

                      <div class="form-group">
                        <label for="is_unique">is Unique ?</label>
                        <select class="custom-select" name="is_unique" id="is_unique" >
                            <option value="0" @if ($attribute->is_unique == "0") Selected @endif></option>
                            <option value="1" @if ($attribute->is_unique == "1") Selected @endif>Yes</option>
                        </select>
                      </div>

                      <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                        <label for="validation">Validation</label>
                        <select class="custom-select @error('validation') is-invalid @enderror" name="validation" id="validation" >
                          <option value=""></option>
                          <option value="number" @if ($attribute->validation == "number") Selected @endif>Number</option>
                          <option value="decimal" @if ($attribute->validation == "decimal") Selected @endif>Decimal</option>]
                          <option value="email" @if ($attribute->validation == "email") Selected @endif>Email</option>
                          <option value="url" @if ($attribute->validation == "url") Selected @endif>URL</option>
                        </select>
                        @error('validation')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                        @enderror
                      </div>

                    </div>

                    <div class="col-10">
                      <p class="mt-4">Configuration</p>
                        <div class="form-group">
                          <label for="is_configureble">Use in Configuration Produk</label>
                          <select class="custom-select" id="is_configurable" name="is_configureble">
                            <option value="0" @if ($attribute->is_configureble == "0") Selected @endif></option>
                            <option value="1" @if ($attribute->is_configureble == "1") Selected @endif>Yes</option>
                          </select>
                        </div>
  
                        <div class="form-group">
                          <label for="is_filterable">Use in Filtering Produk</label>
                          <select class="custom-select" name="is_filterable" id="is_filterable">
                            <option value="0" @if ($attribute->is_filterable == "0") Selected @endif></option>
                            <option value="1" @if ($attribute->is_filterable == "1") Selected @endif>Yes</option>
                          </select>
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
  @endpush
</x-master-layout>