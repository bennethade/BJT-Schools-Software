@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Choose A Class</h1>
            </div>
            <div class="col-sm-6">
               {{-- <a href="{{ route('attendance.teacher.add') }}" class="btn btn-primary" style="float: right;">Add Attendance</a> --}}
            </div>
         </div>
      </div>

   </section>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 20px;">
                    <div class="row" style="text-align: center">
                        @foreach ($getClass as $class)
                                <a class="btn btn-danger" href="{{ route('teacher.assign_student.term_list',[$class->class_id]) }}" style="margin: 10px; padding:15px;">{{ $class->class_name }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
         </div>
      </div>
   </section>


   
</div>
@endsection
