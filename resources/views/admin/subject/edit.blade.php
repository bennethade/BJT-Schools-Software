@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subject</h1>
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
                <h3 class="card-title">Subject Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" name="name" required value="{{ $getRecord->name }}" placeholder="Enter Subject Name">
                  </div>

                  <div class="form-group">
                    <label>Subject Type</label>
                    <select class="form-control" name="type">
                        <option value="">Select Type</option>
                        <option {{ ( $getRecord->type == 'theory') ? 'selected' : '' }} value="theory">Theory</option>
                        <option {{ ( $getRecord->type == 'practical') ? 'selected' : '' }} value="practical">Practical</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>School Section</label>
                    <select class="form-control" name="school_section">
                        <option value="">Select Section</option>
                        <option {{ ( $getRecord->school_section == 'Nursery School') ? 'selected' : '' }} value="Nursery School">Nursery School</option>
                        <option {{ ( $getRecord->school_section == 'Primary School') ? 'selected' : '' }} value="Primary School">Primary School</option>
                        <option {{ ( $getRecord->school_section == 'Junior Secondary School') ? 'selected' : '' }} value="Junior Secondary School">Junior Secondary School</option>
                        <option {{ ( $getRecord->school_section == 'Senior Secondary School') ? 'selected' : '' }} value="Senior Secondary School">Senior Secondary School</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option {{ ( $getRecord->status == 0) ? 'selected' : '' }} value="0">Active</option>
                        <option {{ ( $getRecord->status == 1) ? 'selected' : '' }} value="1">Inactive</option>
                    </select>
                  </div>

                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection