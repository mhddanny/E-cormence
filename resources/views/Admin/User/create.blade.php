<x-master-layout title="Admin | Create User">
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">User</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashbord</a></li>
              <li class="breadcrumb-item"><a href="{{ route('user.index') }}">User All</a></li>
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
              <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-header">
                  <h3 class="card-title">Create User</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group {{ $errors->has('username') ? 'has-error' : '' }}">
                        <label for="username">Username</label>
                        <input name="username" type="text" class="form-control  @error('username') is-invalid @enderror" value="{{ old('username') }}"  placeholder="Username" >
                          @error('username')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control  @error('name') is-invalid @enderror" value="{{ old('name') }}"  placeholder="Name" >
                          @error('name')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control  @error('email') is-invalid @enderror" value="{{ old('email') }}"  placeholder="Email" >
                          @error('email')
                              <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                              </span>
                          @enderror
                      </div>

                      <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password" class="form-control" value=""  placeholder="password" >

                          <label for="show_password">
                            	<input type="checkbox" name="show_password" id="show_password" data-show-password="#password">
                            	Show Password
                          </label>
                          @error('password')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                      </div>

                      <div class="form-group {{ $errors->has('level') ? 'has-error' : '' }}">
                        <label for="kd_kategori">Level</label>
                        <select class="custom-select" name="level" >
                            <option value="">Pilih-Level</option>
                            <option value="superadmin">Super Admin</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('level')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
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
  </section>
  @push('script')
      <script src="{{ asset('AdminLTE/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
      <script type="text/javascript">
                $(function () {
                    // Listen for click events
                    document.addEventListener('click', function (event) {

                        // If the clicked element isn't our show password checkbox, bail
                        if (event.target.id !== 'show_password') return;

                        // Get the password field
                        var password = document.querySelector('#password');
                        if (!password) return;

                        // Check if the password should be shown or hidden
                        if (event.target.checked) {
                            // Show the password
                            password.type = 'text';
                        } else {
                            // Hide the password
                            password.type = 'password';
                        }

                    }, false);

                });
                $(document).ready(function () {
                  bsCustomFileInput.init();
                });

      </script>
      
  @endpush
</x-master-layout>