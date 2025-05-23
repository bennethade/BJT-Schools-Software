@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>My Exam Timetable </h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         @include('_message')
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
               <!-- /.card -->
               
               @foreach ($getRecord as $value)

                    <h2 style="font-size: 32px; margin-bottom:15px;"> Class: <span style="color: blue;">{{ $value['class_name'] }} {{ $value['class_description'] }}</span></h2>
                    @foreach ($value['exam'] as $exam)                    
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title"><b>{{ $exam['exam_name'] }} {{ $exam['exam_session'] }}</b></h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Subject Name</th>
                                        <th>Day</th>
                                        <th>Exam Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Room Number</th>
                                        <th>Full Mark</th>
                                        <th>Pass Mark</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($exam['subject'] as $valueS)
                                            <tr>
                                                <td>{{ $valueS['subject_name'] }}</td>                            
                                                <td>{{ date('l', strtotime($valueS['exam_date'])) }}</td>                            
                                                <td width="100">{{ date('d-m-Y', strtotime($valueS['exam_date'])) }}</td>                            
                                                <td>{{ date('h:i:A', strtotime($valueS['start_time'])) }}</td>                            
                                                <td>{{ date('h:i:A', strtotime($valueS['end_time'])) }}</td>                            
                                                <td>{{ $valueS['room_number'] }}</td>                            
                                                <td>{{ $valueS['full_mark'] }}</td>                            
                                                <td>{{ $valueS['pass_mark'] }}</td>                            
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endforeach
               @endforeach
               <!-- /.card -->
            </div>
            <!-- /.col -->
         </div>
         <!-- /.row -->
         <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
   </section>
</div>
@endsection