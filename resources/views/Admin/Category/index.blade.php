@extends('layouts.backend.master')

@section('title')
  Admin | Index Categoris
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
            <h1 class="m-0">Category</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashbord</a></li>
              <li class="breadcrumb-item active">Category</li>
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
                  @if(Request::get('keyword'))
                    <a class="btn btn-sm btn-outline-success" href="{{ route('category.index') }}">Back</a>
                  @else
                    <a class="btn btn-sm btn-outline-success" href="{{ route('category.create') }}">Create</a><span class="glyphicon glyphicon-plus"></span>
                  @endif
              </div>
              <div class="card-body">
                <table table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kategori</th>
                            {{-- <th>Parent</th> --}}
                            <th>Tipe</th>
                            <th width="30%">Action</th>
                        </tr>
                   </thead>
                   <tbody>
                       @foreach($category as $row)
                       <tr>
                         <td>{{ $loop->iteration }}</td>
                         <td>{{ $row->kategori }}</td>
                         {{-- <td>{{ !$row->parent ? $row->parent->kategori : '-' }}</td> --}}
                         <td>{{ $row->tipe }}</td>
                         <td>
                           <form class="" action="{{ route('category.destroy',[$row->kd_kategori]) }}" method="post" onsubmit="return confirm('Apakah Anda Yakin Akan Menghapus Dara ini ? ')">
                             @csrf
                             {{ method_field('Delete') }}
                             <a class="btn btn-sm btn-outline-warning " href="{{ route('category.edit',[$row->kd_kategori]) }}"> <i class="fas fa-edit"></i> Edit</a>
                             <button type="submit" name="button" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash">
                             </i> Delete</button>
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
