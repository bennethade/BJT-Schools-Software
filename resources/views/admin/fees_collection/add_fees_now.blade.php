@extends('layouts.app')

@section('content')





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Fees</h1>
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
             
              <form method="POST" action="{{ route('admin.insert') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label class="col-form-label">Class Name: {{ $getStudent->class_name }}</label>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Total Amount: ${{ number_format($getStudent->amount, 2) }}</label>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Paid Amount:</label>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Remaining Amount:</label>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" required placeholder="Enter Name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label  class="form-control">Amount<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="amount">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-control">Payment Type <span style="color: red;">*</span></label>
                        <select class="form-control" name="payment_type" id="">
                            <option value="">Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-control">Remark</label>
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                  
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>




















    <div>
        <div>
            <div>
                <div>
                <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>

                <form action="" method="POST">
                    {{-- @csrf --}}
                    {{ csrf_field() }}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Class Name: {{ $getStudent->class_name }}</label>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Total Amount: ${{ number_format($getStudent->amount, 2) }}</label>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Paid Amount:</label>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Remaining Amount:</label>
                        </div>

                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Amount<span style="color: red;">*</span></label>
                            <input type="number" class="form-control" name="amount">
                        </div>
                        
                        <div class="form-group">
                            <label class="col-form-label">Payment Type <span style="color: red;">*</span></label>
                            <select class="form-control" name="payment_type" id="">
                                <option value="">Select</option>
                                <option value="Cash">Cash</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Remark</label>
                            <textarea class="form-control" name="remark"></textarea>
                        </div>
                    </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


