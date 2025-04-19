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
                        <div class="form-group col-md-4">
                            <label>First Name <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="name" required readonly placeholder="First Name" value="{{ old('name', $getRecord->name) }}">
                            <div style="color: red;">{{ $errors->first('name') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Last Name <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="last_name" required readonly placeholder="Last Name" value="{{ old('last_name', $getRecord->last_name) }}">
                            <div style="color: red;">{{ $errors->first('last_name') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Other Name</label>
                            <input type="text" class="form-control" name="other_name" placeholder="Other Name" readonly value="{{ old('other_name', $getRecord->other_name) }}">
                            <div style="color: red;">{{ $errors->first('other_name') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Gender <span style="color: red">*</span> </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="">Select Gender</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : '' }} value="Other">Other</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('gender') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Date of Birth <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $getRecord->date_of_birth) }}">
                            <div style="color: red;">{{ $errors->first('date_of_birth') }}</div>
                        </div>

                        
                        <div class="form-group col-md-6">
                            <label>Mobile Number <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number', $getRecord->mobile_number) }}">
                            <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Marital Status <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="marital_status" placeholder="Marital Status" value="{{ old('marital_status', $getRecord->marital_status) }}">
                            <div style="color: red;">{{ $errors->first('marital_status') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Profile Picture </label>
                            <input type="file" class="form-control" name="profile_picture" >
                            <div style="color: red;">{{ $errors->first('profile_picture') }}</div>
                            @if(!empty($getRecord->getProfile()))
                                <img src="{{ $getRecord->getProfile() }}" class="img-circle" alt="" style="width: 50px;">
                            @endif
                        </div>

                        <div class="form-group col-md-6">
                            <label>Current Address <span style="color: red">*</span> </label>
                            <textarea class="form-control" name="address" required rows="3" placeholder="Current Address">{{ old('address', $getRecord->address) }}</textarea>
                            <div style="color: red;">{{ $errors->first('address') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Permanent Address <span style="color: red"></span> </label>
                            <textarea class="form-control" name="permanent_address" rows="3" placeholder="Permanent Address">{{ old('permanent_address', $getRecord->permanent_address) }}</textarea>
                            <div style="color: red;">{{ $errors->first('permanent_address') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Work Experience <span style="color: red"></span> </label>
                            <textarea class="form-control" name="work_experience" rows="3" placeholder="Word Experience">{{ old('work_experience', $getRecord->work_experience) }}</textarea>
                            <div style="color: red;">{{ $errors->first('work_experience') }}</div>
                        </div>


                        <div class="form-group col-md-6">
                            <label>Qualification <span style="color: red"></span> </label>
                            <textarea class="form-control" name="qualification" rows="3" placeholder="Qualification">{{ old('qualification', $getRecord->qualification) }}</textarea>
                            <div style="color: red;">{{ $errors->first('qualification') }}</div>
                        </div>

                    </div>
                  

                    <hr>
                    <hr>

                  <div class="form-group">
                    <label>Email address <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" required readonly placeholder="Enter email" value="{{ old('email', $getRecord->email) }}">
                    <div style="color: red;">{{ $errors->first('email') }}</div>
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