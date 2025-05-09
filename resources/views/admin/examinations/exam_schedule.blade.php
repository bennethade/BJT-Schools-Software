@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Exam Schedule</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Exam Schedule</h3>
            </div>
            <form method="get" action=" ">
               <div class="card-body">
                  <div class="row">
                     <div class="form-group col-md-3">
                        <label>Exam</label>
                        <select class="form-control" name="exam_id" required>
                           <option value="">Select</option>
                           @foreach ($getExam as $exam)
                           <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <label>Class</label>
                        <select class="form-control" name="class_id" required>
                           <option value="">Select</option>
                           @foreach ($getClass as $class)
                           <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('examinations.exam_schedule') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
            <!-- /.col -->
            <div class="col-md-12">
               @include('_message')
               <!-- /.card -->
               @if (!empty($getRecord))
               <form action="{{ url('admin/examinations/exam_schedule_insert') }}" method="POST">
                  @csrf
                  <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                  <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Exam Schedule</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body p-0">
                        <table class="table table-striped">
                           <thead>
                              @php
                              $id = 1
                              @endphp
                              <tr>
                                 <th>Subject Name</th>
                                 <th>Exam Date</th>
                                 <th>Start Time</th>
                                 <th>End Time</th>
                                 <th>Room Number</th>
                                 <th>Full Mark</th>
                                 <th>Pass Mark</th>
                              </tr>
                           </thead>
                           <tbody>
                                @php
                                   $i = 1; 
                                @endphp
                              @foreach ($getRecord as $value)
                              <tr>
                                 <td>{{ $value['subject_name'] }}
                                    <input type="hidden" class="form-control" value="{{ $value['subject_id'] }}" name="schedule[{{ $i }}][subject_id]">
                                 </td>
                                 <td>
                                    <input type="date" class="form-control" value="{{ $value['exam_date'] }}" name="schedule[{{ $i }}][exam_date]">
                                 </td>
                                 <td>
                                    <input type="time" class="form-control" value="{{ $value['start_time'] }}" name="schedule[{{ $i }}][start_time]">
                                 </td>
                                 <td>
                                    <input type="time" class="form-control" value="{{ $value['end_time'] }}" name="schedule[{{ $i }}][end_time]">
                                 </td>
                                 <td>
                                    <input type="text" class="form-control" value="{{ $value['room_number'] }}" name="schedule[{{ $i }}][room_number]">
                                 </td>
                                 <td>
                                    {{-- <input type="number" class="form-control" value="{{ $value['full_mark'] }}" name="schedule[{{ $i }}][full_mark]"> --}}
                                    <input readonly type="number" class="form-control" value="{{ $value['full_mark'] ?? 100 }}" name="schedule[{{ $i }}][full_mark]">
                                 </td>
                                 <td>
                                    <input readonly type="number" class="form-control" value="{{ $value['pass_mark'] ?? 50 }}" name="schedule[{{ $i }}][pass_mark]">
                                 </td>
                              </tr>
                                @php
                                    $i++; 
                                @endphp
                              @endforeach
                           </tbody>
                        </table>
                        <div style="text-align: center; padding:20px;">
                           <button class="btn btn-primary">Submit</button>
                        </div>
                     </div>
                     <!-- /.card-body -->
                  </div>
               </form>
               @endif
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