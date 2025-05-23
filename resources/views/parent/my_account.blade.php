@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>My Account</h1>
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

            @include('_message')

            <!-- general form elements -->
            <div class="card card-primary">
              
              <!-- form start -->
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">

                        <div class="form-group col-md-3">
                            <label>Title <span style="color: red">*</span> </label>
                            <select name="title" id="" class="form-control" required>
                                <option value="">Select</option> 
                                <option {{ (old('title', $getRecord->title) == 'Mr') ? 'selected' : '' }} value="Mr">Mr</option> 
                                <option {{ (old('title', $getRecord->title) == 'Mrs') ? 'selected' : '' }} value="Mrs">Mrs</option> 
                                <option {{ (old('title', $getRecord->title) == 'Ms') ? 'selected' : '' }} value="Ms">Ms</option> 
                                <option {{ (old('title', $getRecord->title) == 'Mr and Mrs') ? 'selected' : '' }} value="Mr and Mrs">Mr and Mrs</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('title') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>First Name <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="name" required placeholder="First Name" value="{{ old('name', $getRecord->name) }}">
                            <div style="color: red;">{{ $errors->first('name') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Other Name</label>
                            <input type="text" class="form-control" name="other_name" placeholder="Other Name" value="{{ old('other_name', $getRecord->other_name) }}">
                            <div style="color: red;">{{ $errors->first('other_name') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                          <label>Last Name <span style="color: red"></span> </label>
                          <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{ old('last_name', $getRecord->last_name) }}">
                          <div style="color: red;">{{ $errors->first('last_name') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Gender <span style="color: red">*</span> </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="">Select Gender</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('gender') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Mobile Number <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="mobile_number" required placeholder="Mobile Number" value="{{ old('mobile_number', $getRecord->mobile_number) }}">
                            <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Profile Picture </label>
                            <input type="file" class="form-control" name="profile_picture" >
                            <div style="color: red;">{{ $errors->first('profile_picture') }}</div>
                            
                            @if(!empty($getRecord->getProfile()))
                                <img src="{{ $getRecord->getProfile() }}" class="img-circle" alt="" style="width: 50px;">
                            @endif
                        </div>

                        
                        <div class="form-group col-md-4">
                            <label>Occupation <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="occupation" placeholder="occupation" value="{{ old('occupation', $getRecord->occupation) }}">
                            <div style="color: red;">{{ $errors->first('occupation') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Address <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="address" required placeholder="Address" value="{{ old('address', $getRecord->address) }}">
                            <div style="color: red;">{{ $errors->first('address') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Email address <span style="color: red">*</span></label>
                          <input readonly type="email" class="form-control" name="email" required placeholder="Enter email" value="{{ old('email', $getRecord->email) }}">
                          <div style="color: red;">{{ $errors->first('email') }}</div>
                        </div>

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