@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Club</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              {{-- <div class="card-header">
                <h3 class="card-title">Edit Club</h3>
              </div> --}}
              
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="form-group col-md-7">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name',$getRecord->name) }}">
                  </div>

                  <div class="form-group col-md-7">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description" value="{{ old('description',$getRecord->description) }}">
                  </div>

                  <div class="form-group col-md-7">
                    <label>Amount</label>
                    <input type="text" class="form-control" name="amount" value="{{ old('amount',$getRecord->amount) }}">
                  </div>

                    <div class="form-group col-md-7">
                        <label>Status</label>
                        <select name="status" id="" class="form-control" required>
                            <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }}  value="1">Active</option> 
                            <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }}  value="0">Inactive</option> 
                        </select>
                    </div>

                 </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection