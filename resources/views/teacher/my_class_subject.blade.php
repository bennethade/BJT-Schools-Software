@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Class And Subjects</h1>
        </div>
       
        
      </div>
    </div><!-- /.container-fluid -->
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
              <h3 class="card-title">My Class And Subjects</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  
                  <tr>
                    <th>S/N</th>
                    <th>Class Name</th>
                    <th>Subject Name</th>
                    <th>Subject Type</th>
                    <th>Class Timetable</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    $id = 1;
                  @endphp
                    @foreach ($getRecord as $value)
                    <tr>
                      <td>{{ $id++ }}</td>
                       <td>{{ $value->class_name }}</td>
                       <td>{{ $value->subject_name }}</td>
                       <td>{{ $value->subject_type}}</td>
                       <td>
                          @php
                            $classSubject = $value->getMyTimetable($value->class_id, $value->subject_id)
                          @endphp
                          @if(!empty($classSubject))

                            {{ date('h:i:A', strtotime($classSubject->start_time)) }}  </br> <span class="pl-3"> To</span></br>  {{ date('h:i:A', strtotime($classSubject->end_time)) }}

                            <br/>
                            {{-- Room Number: {{ $classSubject->room_number }} --}}
                          @endif
                       </td>
                       <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                       <td>
                        <a href="{{ route('teacher.my_timetable', [$value->class_id, $value->subject_id]) }}" class="btn btn-primary">My Class Timetable</a>
                        {{-- <a href="{{ url('teacher/my_class_subject/class_timetable' . $value->class_id . $value->subject_id) }}" class="btn btn-primary">My Class Timetable</a> --}}
                       </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

                <div style="padding: 10px; float: right;">
                    
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