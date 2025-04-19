@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Admin</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <form method="POST" action="{{ route('admin.insert') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" required placeholder="Enter Name" value="{{ old('name') }}">
                  </div>

                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" required placeholder="Enter email" value="{{ old('email') }}">
                    <div style="color: red;">{{ $errors->first('email') }}</div>
                  </div>

                  <div class="form-group">
                    <label>Admin Type</label>
                    <select name="user_type" class="form-control">
                      <option value="">Select</option>
                      <option value="Super Admin">Super Admin</option>
                      <option value="School Admin">School Admin</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div>

                  <div class="form-group">
                    <label>Profile Picture </label>
                    <input type="file" class="form-control" name="profile_picture" >
                    <div style="color: red;">{{ $errors->first('profile_picture') }}</div>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection