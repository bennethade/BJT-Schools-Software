@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-4">
               <h1>Staff Leave</h1>
            </div>

            <div class="col-sm-4" style="text-align:right">
               <a href="{{ route('employee.leave.requests') }}" class="btn btn-warning">View Leave Requests</a>
            </div>

            <div class="col-sm-4" style="text-align:right">
               <a href="{{ route('employee.leave.add') }}" class="btn btn-primary">Add Staff Leave</a>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Leave</h3>
            </div>
            <form method="get" action="">
               <div class="card-body">
                  <div class="row">
                     
                     <div class="form-group col-md-4">
                        <label>Staff Name</label>
                        <input type="text" class="form-control" name="staff_name" value="{{ Request::get('staff_name') }}">
                     </div>

                     <div class="form-group col-md-4">
                        <label>Leave Purpose</label>
                        <input type="text" class="form-control" name="leave_purpose" value="{{ Request::get('leave_purpose') }}">
                     </div>
                     
                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('employee.leave.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </form>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               @include('_message')
                   
                <div class="card" style="overflow: auto">
                    <div class="card-header">
                        <h3 class="card-title">Employee Leave List</h3>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Staff Name</th>
                                <th>Leave Purpose</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Document</th>
                                <th>Created By</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                
                                @forelse ($getRecord as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $value->staff_name }} {{ $value->staff_last_name }} {{ $value->staff_other_name }}</td>
                                    <td>{{ $value->leave_purpose }}</td>
                                    <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->start_date)) }}</td>
                                    <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->end_date)) }}</td>
                                    <td>
                                        @if (!empty($value->document))
                                            <a href="{{ asset('upload/leave_document/' . $value->document) }}" download>
                                                <img src="{{ asset('upload/leave_document/' . $value->document) }}" alt="Item Image" style="height: 50px; width: 50px;">
                                            </a>
                                        @else
                                            <span>No Image Available</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->created_by_name }} {{ $value->created_by_last_name }}</td>
                                    <td style="min-width: 100px;">{{ $value->status }}</td>
                                    <td style="min-width: 170px;">
                                        <a href="{{ route('employee.leave.edit', [$value->id]) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('employee.leave.delete', [$value->id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                 </tr>
                                @empty
                                    <td colspan="100%">
                                        <p>No Leave Data Found!</p>
                                    </td>
                                @endforelse
                            </tbody>
                    </table>

                     <div style="padding: 10px; float: right;">
                        {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
                     </div>

     
                </div>
                
            </div>
         </div>
         
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection