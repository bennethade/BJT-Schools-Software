@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1 style="color: brown">Pending Leave Requests</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               @include('_message')
                   
                <div class="card" style="overflow: auto">
                    <div class="card-header">
                        <h3 class="card-title">Leave Request List</h3>
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
                                    <td style="min-width: 170px;">
                                        <a href="{{ route('employee.leave.request.approve', [$value->id]) }}" class="btn btn-sm btn-success">Approve</a>
                                        <a href="{{ route('employee.leave.request.reject', [$value->id]) }}" class="btn btn-sm btn-danger">Reject</a>
                                    </td>
                                 </tr>
                                @empty
                                    <td colspan="100%">
                                        <p>No Leave Data Found!</p>
                                    </td>
                                @endforelse
                            </tbody>
                    </table>
     
                </div>
                
            </div>
         </div>
         
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection