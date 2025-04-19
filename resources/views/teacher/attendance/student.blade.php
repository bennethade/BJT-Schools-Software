@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Student Attendance</h1>
            </div>
         </div>
      </div>

   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Student Attendance</h3>
            </div>
            <form method="get" action="">
               <div class="card-body">
                  <div class="row">
                     
                     <div class="form-group col-md-4">
                        <label>Class</label>
                        <select class="form-control" name="class_id" id="getClass" required>
                           <option value="">Select</option>
                           @foreach ($getClass as $class)
                           <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }} {{ $class->class_description }}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group col-md-4">
                        <label>Term</label>
                        <select class="form-control" name="exam_id" id="getExam" required>
                           <option value="">Select</option>
                           @foreach ($getExam as $exam)
                           <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                           @endforeach
                        </select>
                     </div>


                     <div class="form-group col-md-2">
                        <label>Attendance Date</label>
                        <input type="date" class="form-control" id="getAttendanceDate" value="{{ Request::get('attendance_date') }}" required name="attendance_date">
                     </div>


                     <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('teacher.attendance.student') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
                @if(!empty(Request::get('class_id')) && !empty(Request::get('attendance_date')))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Attendance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getStudent) && !empty($getStudent->count()))
                                        @foreach ($getStudent as $value)
                                            @php
                                                $attendance_type = 0;
                                                $getAttendance = $value->getAttendance($value->id, Request::get('class_id'), Request::get('exam_id'), Request::get('attendance_date')); //This is going to the user model

                                                if(!empty($getAttendance->attendance_type))
                                                {
                                                    $attendance_type = $getAttendance->attendance_type;
                                                }
                                            @endphp

                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                                                <td>
                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="1" {{ $attendance_type == '1' ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">Present
                                                    </label>

                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="2" {{ $attendance_type == '2' ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">Late
                                                    </label>

                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="3" {{ $attendance_type == '3' ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">Absent
                                                    </label>

                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="4" {{ $attendance_type == '4' ? 'checked' : '' }} id="{{ $value->id }}" class="SaveAttendance" name="attendance{{ $value->id }}">Half Day
                                                    </label>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
      var exam_id = $('#getExam').val();
      var attendance_date = $('#getAttendanceDate').val();

      
      $.ajax({
         type: "POST",
         url : "{{ url('teacher/attendance/student/save') }}",  
         data: {
            "_token" : "{{ csrf_token() }}",
            student_id : student_id,
            attendance_type : attendance_type,
            class_id : class_id,
            exam_id : exam_id,
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