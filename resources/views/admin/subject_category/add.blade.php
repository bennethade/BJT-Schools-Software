@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Subject Category</h1>
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
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="name" required placeholder="Enter Name">
                  </div>


                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>Category Color</label>
                        <input type="text" class="form-control" name="color" placeholder="Enter Category Color">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="status">
                            <option value="1">Active</option>
                            {{-- <option value="0">Inactive</option> --}}
                        </select>
                    </div>
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