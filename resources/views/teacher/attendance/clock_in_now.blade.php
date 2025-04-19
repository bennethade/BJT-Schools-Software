@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Attendance Clock In</h1>
            </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <form method="POST" action="">
                     @csrf
                     <div class="card-body">
                        
                        <div class="form-group">
                            <label for="">Name: {{ $teacher->name }} {{ $teacher->last_name }} {{ $teacher->other_name }}</label>
                            <input type="hidden" name="teacher_id" value="{{ $teacher->id }}">
                        </div>

                        <div class="form-group">
                            <label for="">Attendance Date:</label>
                            <span>{{ $attendanceDate }}</span>
                        </div>

                        <div class="form-group">
                            <label for="">Arrival Time</label>
                            <span>{{ $arrivalTime }}</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="">Closing Time</label>
                            <span>{{ $closingTime }}</span>
                        </div>
                        

                     </div>
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection