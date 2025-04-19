@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Category</h1>
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
                <h3 class="card-title">Category Details</h3>
              </div>
              <form method="POST" action="">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Category Name</label>
                    <input type="text" class="form-control" name="name" required value="{{ $getRecord->name }}">
                  </div>

                  <div class="form-group">
                    <label>Category Color</label>
                    <input type="text" class="form-control" name="color" value="{{ $getRecord->color }}">
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option {{ ( $getRecord->status == 1) ? 'selected' : '' }} value="1">Active</option>
                        <option {{ ( $getRecord->status == 0) ? 'selected' : '' }} value="0">Inactive</option>
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