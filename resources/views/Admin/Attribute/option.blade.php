@extends('layouts.backend.master')

@section('title')
  Admin | Attribute {{ !empty($attributeoption) ? $attributeoption->name : $data->name }}
@endsection

@section('css')
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

@endsection

@section('section')
  
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Attribute Option {{ !empty($attributeoption) ? $attributeoption->name : $data->name }}</h1>

        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('attribute.index') }}">Attribute All</a></li>
              <li class="breadcrumb-item active">Attributes Option</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-5">
          <div class="card card-default">
            @if (!empty($attributeoption))
            <form action="{{ route('attribute_update',[$attributeoption->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                {{method_field('PUT')}}          
            @else
            <form action="{{ route('attribute_add',[$data->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
            @endif
            
              <div class="card-header">
                <h3 class="card-title">{{ !empty($attributeoption) ? 'Edit Option' : 'Add Option' }}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                      <label for="name">Name</label>
                      <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ !empty($attributeoption) ? $attributeoption->name : old('name') }}"  placeholder="" >
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" name="tombol" class="btn btn-info pull-right">Save</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Data Option {{ !empty($attributeoption) ? $attributeoption->name : $data->name }}</h3>
            </div>
            <div class="card-body">
              <table table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Name</th>
                        <th width="30%">Action</th>
                    </tr>
               </thead>
               <tbody>
                 @foreach ($data->attributeOptions as $row)
                 <tr>
                     <td>{{ $loop->iteration  }}</td>
                     <td>{{ $row->name }}</td>
                     <td>
                       <form class="" action="{{ route('attribute_delete',[$row->id]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                         @csrf
                         {{ method_field('Delete') }}
                         
                         <a class="btn btn-sm btn-outline-warning" href="{{ route('attribute_edit',[$row->id]) }}"><i class="fas fa-edit"></i> Edit</a>
                         <button type="submit" name="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                       </form>
                     </td>
                 </tr>
               @endforeach
               </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@endsection

@section('script')
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

@endsection
