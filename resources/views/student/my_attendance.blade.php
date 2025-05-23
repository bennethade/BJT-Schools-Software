@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>My Attendance <span style="color: blue;">(Total: {{ $getRecord->total() }})</span></h1>
            </div>
         </div>
      </div>

   </section>
   
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">


                <div class="card">
                    <div class="card-header">
                       <h3 class="card-title">Search My Attendance</h3>
                    </div>
                    <form method="get" action=" ">
                       <div class="card-body">
                          <div class="row">
                            
                            <div class="form-group col-md-3">
                                <label>Class</label>
                                <select class="form-control" name="class_id">
                                   <option value="">Select</option>
                                   @foreach ($getClass as $value)
                                       <option {{ (Request::get('class_id') == $value->class_id) ? 'selected' : '' }} value="{{ $value->class_id }}">{{ $value->class_name }}</option>
                                   @endforeach
                                </select>
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


                             <div class="form-group col-md-2">
                                <label>Attendance From</label>
                                <input type="date" class="form-control" value="{{ Request::get('attendance_from') }}" name="attendance_from">
                             </div>


                             <div class="form-group col-md-2">
                                <label>Attendance To</label>
                                <input type="date" class="form-control" value="{{ Request::get('attendance_to') }}" name="attendance_to">
                             </div>
        

                             <div class="form-group col-md-2">
                                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                <a href="{{ route('student.my_attendance') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                             </div>
        
                          </div>
        
                       </div>
                       <!-- /.card-body -->
                    </form>
                 </div>


                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Attendance</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Class Name</th>
                                        <th>Attendance Status</th>
                                        <th>Attendance Date</th>
                                        <th>Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($getRecord as $value)
                                        <tr>
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
                                            <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="100%">Record Not Found!</td>
                                        </tr>
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
      </div>
   </section>
</div>
@endsection

@section('script')


@endsection