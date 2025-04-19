@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Teacher Attendance</h1>
            </div>
            <div class="col-sm-6">
               <a href="{{ route('teacher.attendance.clock_in_now') }}" class="btn btn-primary" style="float: right;">Clock In/Out</a>
            </div>
         </div>
      </div>

   </section>

   <section class="content">
      <div class="container-fluid">
         @include('_message')
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Your Attendance Status</h3>
            </div>
            <form method="get" action=" ">
               <div class="card-body">
                  <div class="row">


                     <div class="form-group col-md-3">
                        <label>From</label>
                        <input type="date" class="form-control" value="{{ Request::get('attendance_from') }}" required name="attendance_from">
                     </div>

                     <div class="form-group col-md-3">
                        <label>To</label>
                        <input type="date" class="form-control" value="{{ Request::get('attendance_to') }}" required name="attendance_to">
                     </div>


                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('attendance.teacher.view') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
            <div class="col-md-12">
                @if(!empty(Request::get('attendance_from')) && !empty(Request::get('attendance_to')))
                    <div class="card">
                        
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Attendance Date</th>
                                        <th>Arrival Time</th>
                                        <th>Closing Time</th>
                                        <th>Attendance Status</th>
                                        <th>Created By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getAttendance as $value)
                                       <tr>
                                          <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                          <td>{{ $value->arrival_time }}</td>
                                          <td>{{ $value->closing_time }}</td>
                                          <td>
                                          @if ($value->attendance_type == 1)
                                             Present
                                          @elseif ($value->attendance_type == 2)
                                             <p style="color: red">Late</p>
                                          @else
                                             Absent
                                          @endif
                                          </td>
                                          <td>{{ $value->created_by }}</td>
                                       </tr>
                                    @empty
                                       <td colspan="100%">
                                          No Data Found For The Chosen Date
                                       </td>
                                    @endforelse
                                    
                                </tbody>                                
                            </table>
                        </div>
                    </div>
                @endif
            </div>
         </div>
      </div>
   </section>
</div>
@endsection
