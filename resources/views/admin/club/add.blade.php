@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Club</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              
              <form method="POST" action="{{ route('club.insert') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group col-md-7">
                    <label>Club Name</label>
                    <input type="text" class="form-control" name="name" required placeholder="Enter Name" value="{{ old('name') }}">
                  </div>

                  <div class="form-group col-md-7">
                    <label>Description</label>
                    <input type="text" class="form-control" name="description" placeholder="Enter Description" value="{{ old('description') }}">
                  </div>

                  <div class="form-group col-md-7">
                    <label>Amount</label>
                    <input type="number" class="form-control" name="amount" required placeholder="Enter Amount" value="{{ old('amount') }}">
                  </div>

                  <div class="form-group col-md-7">
                    <label for="">Status</label>
                    <select name="status" id="" class="form-control">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
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