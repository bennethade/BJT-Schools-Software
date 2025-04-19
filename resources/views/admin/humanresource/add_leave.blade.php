@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Staff Leave</h1>
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
                        <div class="form-group col-md-6">
                            <label>Staff Name <span style="color: red">*</span> </label>
                            <select name="staff_id" id="" class="form-control" required>
                                <option value="">Select a staff</option>
                                @foreach ($getTeacher as $staff)
                                    <option value="{{ $staff->id }}">{{ $staff->name }} {{ $staff->last_name }} {{ $staff->other_name }}</option>    
                                @endforeach
                            </select>
                            <div style="color: red;">{{ $errors->first('staff_name') }}</div>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Leave Purpose <span style="color: red">*</span> </label>
                            <textarea class="form-control" name="leave_purpose" id="" rows="2" required placeholder="Add a description for the leave">{{ old('leave_purpose') }}</textarea>
                            <div style="color: red;">{{ $errors->first('leave_purpose') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>Start Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="start_date" required value="{{ old('start_date') }}">
                            <div style="color: red;">{{ $errors->first('start_date') }}</div>
                        </div>

                        <div class="form-group col-md-3">
                            <label>End Date <span style="color: red">*</span> </label>
                            <input type="date" class="form-control" name="end_date" required value="{{ old('end_date') }}">
                            <div style="color: red;">{{ $errors->first('end_date') }}</div>
                        </div>


                        <div class="form-group col-md-3">
                            <label>Document (Image file)</label>
                            <input type="file" class="form-control" name="document" >
                            <div style="color: red;">{{ $errors->first('document') }}</div>
                        </div>


                        <div class="form-group col-md-3">
                            <label>Status <span style="color: red">*</span> </label>
                            <select name="status" id="" class="form-control" required>
                                <option {{ (old('status') == 'Approved') ? 'selected' : '' }} value="Approved">Approved</option> 
                                <option {{ (old('status') == 'Pending') ? 'selected' : '' }} value="Pending">Pending</option> 
                                <option {{ (old('status') == 'Rejected') ? 'selected' : '' }} value="Rejected">Rejected</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('status') }}</div>
                        </div>

                    </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            
          </div>
          
        </div>
        
      </div>
    </section>
  </div>

@endsection