@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Student</h1>
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
              
              <!-- form start -->
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label>First Name <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="name" required placeholder="First Name" value="{{ old('name') }}">
                            <div style="color: red;">{{ $errors->first('name') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Other Name</label>
                            <input type="text" class="form-control" name="other_name" placeholder="Other Name" value="{{ old('other_name') }}">
                            <div style="color: red;">{{ $errors->first('other_name') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                          <label>Last Name <span style="color: red">*</span> </label>
                          <input type="text" class="form-control" name="last_name" required placeholder="Last Name" value="{{ old('last_name') }}">
                          <div style="color: red;">{{ $errors->first('last_name') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Admission Number <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="admission_number" placeholder="Admission Number" value="{{ old('admission_number') }}">
                            <div style="color: red;">{{ $errors->first('admission_number') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Roll Number</label>
                            <input type="text" class="form-control" name="roll_number" placeholder="Roll Number" value="{{ old('roll_number') }}">
                            <div style="color: red;">{{ $errors->first('roll_number') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Class <span style="color: red">*</span> </label>
                            <select name="class_id" id="" class="form-control" required>
                                <option value="">Select Class</option> 
                                @foreach ($getClass as $class)
                                    <option {{ (old('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                @endforeach
                            </select>
                            <div style="color: red;">{{ $errors->first('class_id') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Gender <span style="color: red">*</span> </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="">Select Gender</option> 
                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('gender') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Date of Birth <span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth') }}">
                            <div style="color: red;">{{ $errors->first('date_of_birth') }}</div>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label>Caste <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="caste" placeholder="Caste" value="{{ old('caste') }}">
                            <div style="color: red;">{{ $errors->first('caste') }}</div>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label>Religion <span style="color: red">*</span> </label>
                            <select name="religion" id="" class="form-control">
                                <option {{ (old('religion') == 'Christian') ? 'selected' : '' }}  value="Christian">Christian</option> 
                                <option {{ (old('religion') == 'Muslim') ? 'selected' : '' }}  value="Muslim">Muslim</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('religion') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Mobile Number <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" value="{{ old('mobile_number') }}">
                            <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Admission Date <span style="color: red"></span> </label>
                            <input type="date" class="form-control" name="admission_date" value="{{ old('admission_date') }}">
                            <div style="color: red;">{{ $errors->first('admission_date') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Profile Picture </label>
                            <input type="file" class="form-control" name="profile_picture" >
                            <div style="color: red;">{{ $errors->first('profile_picture') }}</div>
                        </div> 

                        <div class="form-group col-md-3">
                            <label>Blood Group </label>
                            <input type="text" class="form-control" name="blood_group" placeholder="Blood Group" value="{{ old('blood_group') }}">
                            <div style="color: red;">{{ $errors->first('blood_group') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Height </label>
                            <input type="text" class="form-control" name="height" placeholder="Height" value="{{ old('height') }}">
                            <div style="color: red;">{{ $errors->first('height') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Weight </label>
                            <input type="text" class="form-control" name="weight" placeholder="Weight" value="{{ old('weight') }}">
                            <div style="color: red;">{{ $errors->first('weight') }}</div>
                        </div>
 
                        <div class="form-group col-md-3">
                            <label>Status <span style="color: red">*</span> </label>
                            <select name="status" id="" class="form-control" required>
                                <option {{ (old('status') == 0) ? 'selected' : '' }}  value="0">Active</option> 
                                {{-- <option {{ (old('status') == 1) ? 'selected' : '' }}  value="1">Inactive</option>  --}}
                            </select>
                            <div style="color: red;">{{ $errors->first('status') }}</div>
                        </div>

                    </div>
                  

                    <hr>
                    <hr>

                  {{-- <div class="form-group">
                    <label>Email address <span style="color: red">*</span></label>
                    <input type="email" class="form-control" name="email" required placeholder="Enter email" value="{{ old('email') }}">
                    <div style="color: red;">{{ $errors->first('email') }}</div>
                  </div> --}}

                  {{-- <div class="form-group">
                    <label>Password <span style="color: red">*</span></label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                  </div> --}}
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