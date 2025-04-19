@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">

        <div class="col-sm-9">
          <h1>Fees Collection Report</h1>
        </div>

        <div class="col-sm-3" style="text-align: right;">
            
        </div>
        
      </div>
    </div>
  </section>





  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <div class="col-md-12">


            <div class="card">
                <div class="card-header">
                   <h3 class="card-title">Search Collect Fees Report</h3>
                </div>
                <form method="get" action=" ">
                   <div class="card-body">
                      <div class="row">
                         
                        <div class="form-group col-md-3">
                            <label>Student ID</label>
                            <input type="text" class="form-control" placeholder="Student ID" value="{{ Request::get('student_id') }}" name="student_id">
                         </div>
    
    
                        <div class="form-group col-md-3">
                            <label>Student First Name</label>
                            <input type="text" class="form-control" placeholder="Student Name" value="{{ Request::get('student_name') }}" name="student_name">
                         </div>
    
                        <div class="form-group col-md-3">
                            <label>Student Last Name</label>
                            <input type="text" class="form-control" placeholder="Student Last Name" value="{{ Request::get('student_last_name') }}" name="student_last_name">
                         </div>
    
                         <div class="form-group col-md-3">
                            <label>Class</label>
                            <select class="form-control" name="class_id">
                               <option value="">Select</option>
                               @foreach ($getClass as $class)
                               <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }}</option>
                               @endforeach
                            </select>
                         </div>
    
    
                         <div class="form-group col-md-3">
                            <label>Created Date From</label>
                            <input type="date" class="form-control" value="{{ Request::get('created_date_from') }}" name="created_date_from">
                         </div>
    
    
                         <div class="form-group col-md-3">
                            <label>Created Date To</label>
                            <input type="date" class="form-control" value="{{ Request::get('created_date_to') }}" name="created_date_to">
                         </div>
    
    
                         <div class="form-group col-md-3">
                            <label>Payment Type</label>
                            <select class="form-control" name="payment_type">
                                <option value="">Select</option>
                                <option {{ (Request::get('payment_type') == 'Cash') ? 'selected' : '' }} value="Cash">Cash</option>
                                <option {{ (Request::get('payment_type') == 'Cheque') ? 'selected' : '' }} value="Cheque">Cheque</option>
                                <option {{ (Request::get('payment_type') == 'Paypal') ? 'selected' : '' }} value="Paypal">Paypal</option>
                                <option {{ (Request::get('payment_type') == 'Stripe') ? 'selected' : '' }} value="Stripe">Stripe</option>
                            </select>
                         </div>
    
                         <div class="form-group col-md-3">
                            <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                            <a href="{{ route('fees_collection.collect_fees_repot') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                         </div>
    
                      </div>
    
                      
                   </div>
                   <!-- /.card-body -->
                </form>
             </div>

          @include('_message')


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Collect Fees Report</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Class Name</th>
                    <th>Total Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Payment Type</th>
                    <th>Remark</th>
                    <th>Created By</th>
                    <th>Initiated Date</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->student_id }}</td>
                            <td>{{ $value->student_name }} {{ $value->student_last_name }} {{ $value->student_other_name }}</td>
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
                            <td colspan="100%">Record Not Found</td>
                        </tr>
                    @endforelse
                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}

                {{-- {{ $getRecord->links() }} --}}


                {{--
                  GO TO APPSERVICEPROVIDER AND ADD THE CODE BELOW FOR THIS PAGINATION TO WORK PROPERLY


                    public function boot(): void
                    {
                        paginator::useBootstrap();
                    }
                --}}
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>



@endsection


@section('script')

@endsection
