@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Collect Fees</h1>
        </div>
      </div>
    </div>
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Student Fees</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-2">
                    <label>Class</label>
                    <select name="class_id" class="form-control">
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group col-md-2">
                    <label>Term</label>
                    <select name="exam_id" class="form-control">
                        <option value="">Select Term</option>
                        @foreach ($getExam as $exam)
                            <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                        @endforeach
                    </select>
                  </div>
                  
                  <div class="form-group col-md-2">
                    <label>Student ID</label>
                    <input type="text" class="form-control" name="student_id" placeholder="Student ID" value="{{ Request::get('student_id') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Student First Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter First Name" value="{{ Request::get('name') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Student Last Name</label>
                    <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
                  </div>

                  <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('fees_collection.collect_fees') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </form>
          </div>
          
    </div>
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">

          @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Student List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Class Name</th>
                    <th>Fee Amount</th>
                    <th>Paid Amount</th>
                    <th>Remaining Amount</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @if (!empty($getRecord))
                        @forelse ($getRecord as $value)
                            @php
                                $paid_amount = $value->getPaidAmount($value->id, $value->class_id);

                                $remainingAmount = $value->amount - $paid_amount;
                            @endphp
                            <tr>
                                <td>{{ $value->id }}</td>
                                <td>{{ $value->user_name }} {{ $value->user_last_name }} {{ $value->user_other_name }}</td>
                                <td>{{ $value->class_name }}</td>
                                <td>N{{ number_format($value->amount, 2) }}</td>
                                <td>N{{ number_format($paid_amount, 2) }}</td>
                                <td>N{{ number_format($remainingAmount, 2) }}</td>
                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                <td style="min-width: 150px;">
                                    <a href="{{ url('admin/fees_collection/collect_fees/add_fees/'.$value->id) }}" class="btn btn-success">Collect Fees</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100%">Record Not Found</td>
                            </tr>
                        @endforelse
                    @else
                        <tr>
                            <td colspan="100%">Search Students</td>
                        </tr>
                    @endif
                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                @if (!empty($getRecord))

                    {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
                @endif


                {{--
                  GO TO APPSERVICEPROVIDER AND ADD THE CODE BELOW FOR THIS PAGINATION TO WORK PROPERLY


                    public function boot(): void
                    {
                        paginator::useBootstrap();
                    }
                --}}
              </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>



@endsection