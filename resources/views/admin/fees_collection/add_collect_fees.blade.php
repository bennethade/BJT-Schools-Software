@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-9">
          <h1>Collect Fees for <span style="color: blue">{{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }}</span></h1>
        </div>

        <div class="col-sm-3" style="text-align: right;">
            <button type="button" class="btn btn-primary" id="addFees">Add Fees</button>
        </div>
         
      </div>
    </div>
  </section>





  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <div class="col-md-12">

          @include('_message')


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Payment Detail</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Class Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Payment Type</th>
                    <th>Remark</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($getFees as $value)
                        <tr>
                            <td>{{ $value->class_name }}</td>
                            <td>{{ number_format($value->total_amount, 2) }}</td>
                            <td>{{ number_format($value->paid_amount, 2) }}</td>
                            <td>{{ number_format($value->remaining_amount, 2) }}</td>
                            <td>{{ $value->payment_type }}</td>
                            <td>{{ $value->remark }}</td>
                            <td>{{ $value->created_by }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%">Record Not Found.</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>


<div class="modal fade" id="addFeesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Fees</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Class Name: {{ $getStudent->class_name }}</label>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Total Amount: N{{ number_format($getStudent->amount, 2) }}</label>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Paid Amount: N{{ number_format($paid_amount, 2) }}</label>
                    </div>

                    <div class="form-group">
                        @php
                            $remainingAmount = $getStudent->amount - $paid_amount;
                        @endphp
                        <label for="recipient-name" class="col-form-label">Remaining Amount: N{{ number_format($remainingAmount, 2) }}</label>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Amount<span style="color: red;">*</span></label>
                        <input type="number" class="form-control" name="amount" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-form-label">Payment Type <span style="color: red;">*</span></label>
                        <select class="form-control" name="payment_type" required>
                            <option value="">Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Cheque">Cheque</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Remark</label>
                        <textarea class="form-control" name="remark"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
  </div>



@endsection


@section('script')

<script type="text/javascript">
    $('#addFees').click(function() {
        $('#addFeesModal').modal('show');
    });
</script>

@endsection
