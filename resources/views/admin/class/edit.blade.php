@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Class</h1>
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
                <h3 class="card-title">Class Details</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Class Name</label>
                    <input type="text" class="form-control" name="name" required value="{{ $getRecord->name }}" placeholder="Class Name">
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="This Class is for...." value="{{ $getRecord->description }}">
                  </div>

                  <div class="form-group">
                    <label>School Section</label>
                    <select name="section" class="form-control">
                      <option value="">Select</option>
                      <option {{ ($getRecord->section == 'Nursery School') ? 'selected' : '' }} value="Nursery School">Nursery School</option>
                      <option {{ ($getRecord->section == 'Primary School') ? 'selected' : '' }} value="Primary School">Primary School</option>
                      <option {{ ($getRecord->section == 'Junior Secondary') ? 'selected' : '' }} value="Junior Secondary">Junior Secondary</option>
                      <option {{ ($getRecord->section == 'Senior Secondary') ? 'selected' : '' }} value="Senior Secondary">Senior Secondary</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Fee Amount (N)</label>
                    <input type="number" class="form-control" name="amount" value="{{ $getRecord->amount }}" placeholder="Enter Amount">
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="0" {{ ($getRecord->status == 0) ? 'selected' : '' }} >Active</option>
                        <option value="1" {{ ($getRecord->status == 1) ? 'selected' : '' }} >Inactive</option>
                    </select>
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