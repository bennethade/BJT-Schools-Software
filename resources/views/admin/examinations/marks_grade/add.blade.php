@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Marks Grade</h1>
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
                    <label>Grade Name</label>
                    <input type="text" class="form-control" name="name" required placeholder="Enter Exam Name" value="{{ old('name') }}">
                  </div>

                  <div class="form-group">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Example: Excellent" value="{{ old('description') }}">
                  </div>
                  
                  <div class="form-group">
                    <label>Percent From</label>
                    <input type="text" class="form-control" name="percent_from" required placeholder="Enter Exam Name" value="{{ old('percent_from') }}">
                  </div>


                  <div class="form-group">
                    <label>Percent To</label>
                    <input type="text" class="form-control" name="percent_to" required placeholder="Enter Exam Name" value="{{ old('percent_to') }}">
                  </div>

                  <div class="form-group">
                    <label>School Section</label>
                    <select name="section" class="form-control">
                      <option value="">Select</option>
                      <option value="Primary School">Primary School</option>
                      <option value="Junior Secondary">Junior Secondary</option>
                      <option value="Senior Secondary">Senior Secondary</option>
                    </select>
                  </div>

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