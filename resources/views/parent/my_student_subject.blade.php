@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1> <span style="color: blue;">{{ $getUser->name }} {{ $getUser->last_name }} {{ $getUser->other_name }}</span></h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
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
                     <h3 class="card-title">{{ $getUser->name }}'s Subjects</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th>S/N</th>
                              <th>Subject Name</th>
                              <th>Subject Type</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           @php
                           $id = 1
                           @endphp
                           @foreach ($getRecord as $value)
                           <tr>
                              <td>{{ $id++ }}</td>
                              <td>{{ $value->subject_name }}</td>
                              <td>{{ $value->subject_type }}</td>
                              <td>
                                 {{-- <a href="{{ url('parent/my_student/subject/class_timetable/' . $value->class_id . '/' . $value->subject_id) }}" class="btn btn-primary">My Class Timetable</a> --}}
                                 {{-- <a href="{{ url('/parent/my_student/subject/class_timetable' . $value->class_id . $value->subject_id) }}" class="btn btn-primary">My Class Timetable</a> --}}
                                 <a href="{{ route('parent.my_timetable',[$value->class_id, $value->subject_id, $getUser->id]) }}" class="btn btn-primary">My Class Timetable</a>
                                </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                  </div>
                  <!-- /.card-body -->
               </div>
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>
@endsection