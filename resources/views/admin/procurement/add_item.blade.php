@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Procurement</h1>
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
                        <div class="form-group col-md-12">
                            <label>Item Name <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" name="item_name" required placeholder="Item Name" value="{{ old('item_name') }}">
                            <div style="color: red;">{{ $errors->first('item_name') }}</div>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Description <span style="color: red"></span> </label>
                            <textarea class="form-control" name="description" id="" rows="3">{{ old('description') }}</textarea>
                            <div style="color: red;">{{ $errors->first('description') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Purchase Date</label>
                            <input type="date" class="form-control" name="purchase_date" value="{{ old('purchase_date') }}">
                            <div style="color: red;">{{ $errors->first('purchase_date') }}</div>
                        </div>


                        {{-- <div class="form-group col-md-6">
                            <label>Gender <span style="color: red">*</span> </label>
                            <select name="gender" id="" class="form-control" required>
                                <option value="">Select Gender</option> 
                                <option {{ (old('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                                <option {{ (old('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                                <option {{ (old('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option> 
                            </select>
                            <div style="color: red;">{{ $errors->first('gender') }}</div>
                        </div> --}}

                        
                        <div class="form-group col-md-4">
                            <label>Amount <span style="color: red"></span> </label>
                            <input type="text" class="form-control" name="amount" placeholder="amount" value="{{ old('amount') }}">
                            <div style="color: red;">{{ $errors->first('amount') }}</div>
                        </div>

                        <div class="form-group col-md-4">
                            <label>Item Image </label>
                            <input type="file" class="form-control" name="image" >
                            <div style="color: red;">{{ $errors->first('image') }}</div>
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