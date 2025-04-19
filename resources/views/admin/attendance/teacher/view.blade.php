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
               @if (Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == '1')
                    <a href="{{ route('attendance.teacher.add') }}" class="btn btn-primary" style="float: right;">Clock In/Out</a>
                @else
                    <a href="{{ route('other_roles.attendance.teacher.add') }}" class="btn btn-success" style="float: right;">Clock In/Out</a>
                @endif
            </div>
         </div>
      </div>

   </section>

   <section class="content">
      <div class="container-fluid">
         @include('_message')
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Teacher Attendance</h3>
            </div>
            <form method="get" action=" ">
               <div class="card-body">
                  <div class="row">


                     <div class="form-group col-md-3">
                        <label>Attendance Date</label>
                        <input type="date" class="form-control" id="getAttendanceDate" value="{{ Request::get('attendance_date') }}" required name="attendance_date">
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
                @if(!empty(Request::get('attendance_date')))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Teacher List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Teacher Name</th>
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
                                          <td>{{ $value->teacher_id }}</td>
                                          <td>{{ $value->teacher_name }}</td>
                                          <td>{{ $value->attendance_date }}</td>
                                          <td>{{ $value->arrival_time }}</td>
                                          <td>{{ $value->closing_time }}</td>
                                          <td>
                                          @if ($value->attendance_type == 1)
                                             Present
                                          @elseif ($value->attendance_type == 2)
                                             Late
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

@section('script')

<script type="text/javascript">
 $('.SaveAttendance').change(function(e) {
      var student_id = $(this).attr('id');
      var attendance_type = $(this).val();
      var class_id = $('#getClass').val();
      var attendance_date = $('#getAttendanceDate').val();



      
      
      $.ajax({
         type: "POST",
         url : "{{ url('admin/attendance/student/save') }}",  
         data: {
            "_token" : "{{ csrf_token() }}",
            student_id : student_id,
            attendance_type : attendance_type,
            class_id : class_id,
            attendance_date : attendance_date,
            
         },
         dataType : "json",
         success: function(data) {
            alert(data.message);
         }
      });

   });
</script>

@endsection