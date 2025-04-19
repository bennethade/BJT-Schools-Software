@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-12">
               <h1>Chosen Class: <span style="color: blue">{{ $className->name }} {{ $className->description }}</span></h1>
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
                    <h3>Choose A Term</h3>
                    <div class="row" style="text-align: center">
                        @foreach ($getExam as $exam)
                            <a class="btn btn-danger" href="{{ route('assign_student.student_list',[$className->id, $exam->id]) }}" style="margin: 10px; padding:10px;">{{ $exam->name }} {{ $exam->session }}</a>
                            {{-- <a class="btn btn-danger" href="{{ url('assign_student.student_list/' . $className->id . '/' . $exam->id) }}" target="blank" style="margin: 10px; padding:15px;">{{ $exam->name }}</a> --}}
                        @endforeach
                    </div>
                </div>

            </div>
         </div>
      </div>
   </section>


   
</div>
@endsection
