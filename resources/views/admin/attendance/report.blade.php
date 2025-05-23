@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Attendance Report <span style="color: blue;">(Total: {{ $getRecord->total() }})</span></h1>
            </div>
         </div>
      </div>

   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Attendance Report</h3>
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
                        <label>Attendance From</label>
                        <input type="date" class="form-control" value="{{ Request::get('attendance_from') }}" name="attendance_from">
                     </div>


                     <div class="form-group col-md-3">
                        <label>Attendance To</label>
                        <input type="date" class="form-control" value="{{ Request::get('attendance_to') }}" name="attendance_to">
                     </div>


                     <div class="form-group col-md-3">
                        <label>Attendance Type</label>
                        <select class="form-control" name="attendance_type">
                            <option value="">Select</option>
                            <option {{ (Request::get('attendance_type') == 1) ? 'selected' : '' }} value="1">Present</option>
                            <option {{ (Request::get('attendance_type') == 2) ? 'selected' : '' }} value="2">Late</option>
                            <option {{ (Request::get('attendance_type') == 3) ? 'selected' : '' }} value="3">Absent</option>
                            <option {{ (Request::get('attendance_type') == 4) ? 'selected' : '' }} value="4">Half Day</option>
                        </select>
                     </div>

                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('attendance.report') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Attendance List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student ID</th>
                                        <th>Student Name</th>
                                        <th>Class Name</th>
                                        <th>Attendance Status</th>
                                        <th>Attendance Date</th>
                                        <th>Created By</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getRecord as $value)
                                        <tr>
                                            <td>{{ $value->student_id }}</td>
                                            <td>{{ $value->student_name }} {{ $value->student_last_name }} {{ $value->student_other_name }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>
                                                @if ($value->attendance_type == 1)
                                                    Present
                                                @elseif ($value->attendance_type == 2)
                                                    Late
                                                @elseif ($value->attendance_type == 3)
                                                    Absent
                                                @elseif ($value->attendance_type == 4)
                                                    Half Day
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($value->attendance_date)) }}</td>
                                            <td>{{ $value->created_name }} {{ $value->created_last_name }}</td>
                                            <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100">Record Not Found</td>
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