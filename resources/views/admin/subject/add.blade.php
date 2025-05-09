@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Subject</h1>
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
              
              <form method="POST" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject Name</label>
                    <input type="text" class="form-control" name="name" required placeholder="Enter Name">
                  </div>

                  <div class="form-group">
                    <label>Subject Type</label>
                    <select class="form-control" name="type">
                      <option value="">Select Type</option>
                        <option value="theory">Theory</option>
                        <option value="practical">Practical</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>School Section</label>
                    <select class="form-control" name="school_section">
                        <option value="">Choose Section</option>
                        <option value="Nursery School">Nursery School</option>
                        <option value="Primary School">Primary School</option>
                        <option value="Junior Secondary School">Junior Secondary School</option>
                        <option value="Senior Secondary School">Senior Secondary School</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option value="0">Active</option>
                        <option value="1">Inactive</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->

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