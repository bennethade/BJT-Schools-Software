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
                            <input type="text" class="form-control" name="other_name" readonly placeholder="Other Name" value="{{ old('other_name', $getRecord->other_name) }}">
                            <div style="color: red;">{{ $errors->first('other_name') }}</div>
                        </div>

                        {{-- <div class="form-group col-md-6">
                            <label>Gender <span style="color: red">*</span> </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="">Select Class</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                                <option {{ (old('gender', $getRecord->gender) == 'Other') ? 'selected' : '' }} value="Other">Other</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('gender') }}</div>
                        </div> --}}

                        <div class="form-group col-md-6">
                            <label>Date of Birth <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="date_of_birth" readonly value="{{ old('date_of_birth', $getRecord->date_of_birth) }}">
                            <div style="color: red;">{{ $errors->first('date_of_birth') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Caste <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="caste" readonly placeholder="Caste" value="{{ old('caste', $getRecord->caste) }}">
                            <div style="color: red;">{{ $errors->first('caste') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Religion <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="religion" readonly placeholder="Religion" value="{{ old('religion', $getRecord->religion) }}">
                            <div style="color: red;">{{ $errors->first('religion') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Mobile Number <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="mobile_number" readonly placeholder="Mobile Number" value="{{ old('mobile_number', $getRecord->mobile_number) }}">
                            <div style="color: red;">{{ $errors->first('mobile_number') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Blood Group </label>
                            <input type="text" class="form-control" name="blood_group" readonly placeholder="Blood Group" value="{{ old('blood_group', $getRecord->blood_group) }}">
                            <div style="color: red;">{{ $errors->first('blood_group') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Height </label>
                            <input type="text" class="form-control" name="height" readonly placeholder="Height" value="{{ old('height', $getRecord->height) }}">
                            <div style="color: red;">{{ $errors->first('height') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Weight </label>
                            <input type="text" class="form-control" name="weight" readonly placeholder="Weight" value="{{ old('weight', $getRecord->weight) }}">
                            <div style="color: red;">{{ $errors->first('weight') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                          <label>Profile Picture </label>
                          {{-- <input type="file" class="form-control" name="profile_picture" > --}}
                          {{-- <div style="color: red;">{{ $errors->first('profile_picture') }}</div> --}}
                          @if(!empty($getRecord->getProfile()))
                              <img src="{{ $getRecord->getProfile() }}" class="img-circle" alt="" style="width: 100px;">
                          @endif
                      </div>

                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  {{-- <button type="submit" class="btn btn-primary">Update</button> --}}
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