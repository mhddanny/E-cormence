@extends('layouts.backend.master')

@section('title')
  Admin | Index Attributes
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
            <h1 class="m-0">Attributes All</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item active">Attributes</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a class="btn btn-sm btn-outline-success" href="{{ route('attribute.create') }}">Create</a><span class="glyphicon glyphicon-plus"></span>
              </div>
              <div class="card-body">
                <table table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th width="30%">Action</th>
                        </tr>
                   </thead>
                   <tbody>
                     @foreach ($attribute as $row)
                     <tr>
                         <td>{{ $loop->iteration  }}</td>
                         <td>{{ $row->code }}</td>
                         <td>{{ $row->name }}</td>
                         <td>{{ $row->type }}</td>
                         <td>
                            @can('edit_attributes')
                                <a href="{{ url('admin/attributes/'. $attribute->id .'/edit') }}" class="btn btn-warning btn-sm">edit</a>
                            @endcan

                            @can('add_attributes')
                                @if ($attribute->type == 'select')
                                    <a href="{{ url('admin/attributes/'. $attribute->id .'/options') }}" class="btn btn-success btn-sm">options</a>
                                @endif
                            @endcan


                           <form class="" action="{{ route('attribute.destroy',[$row->id]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                             @csrf
                             {{ method_field('Delete') }}
                             <a class="btn btn-sm btn-outline-warning" href="{{ route('attribute.edit',[$row->id]) }}"><i class="fas fa-edit"></i> Edit</a>
                             <a class="btn btn-sm btn-outline-info " href="{{ route('attributeoption',[$row->id]) }}"><i class="fas fa-plus"></i> Option</a>
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
    <!-- /.content -->
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
