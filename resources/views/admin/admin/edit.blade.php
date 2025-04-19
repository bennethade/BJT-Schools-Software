@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Admin</h1>
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
              <div class="card-header">
                <h3 class="card-title">Admin Edit</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="{{ route('admin.update',[$getRecord->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name',$getRecord->name) }}">
                  </div>

                  <div class="form-group">
                    <label>Email address</label>
                    <input type="email" class="form-control" name="email" required placeholder="Enter email" value="{{ old('email',$getRecord->email) }}">
                    <div style="color: red;">{{ $errors->first('email') }}</div>
                  </div>

                  <div class="form-group">
                    <label>Admin Type</label>
                    <select name="user_type" class="form-control">
                      <option value="">Select</option>
                      <option {{ ($getRecord->user_type == 'Super Admin') ? 'selected' : '' }} value="Super Admin">Super Admin</option>
                      <option {{ ($getRecord->user_type == 'School Admin') ? 'selected' : '' }} value="School Admin">School Admin</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password" >
                    <p>Want to change password? Enter a new one then!</p>
                  </div>

                  <div class="form-group">
                    <label>Profile Picture </label>
                    <input type="file" class="form-control" name="profile_picture" >
                    <div style="color: red;">{{ $errors->first('profile_picture') }}</div>
                    @if(!empty($getRecord->getProfile()))
                        <img src="{{ $getRecord->getProfile() }}" class="img-circle" alt="" style="width: 50px;">
                    @endif
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
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