@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Student Promotion</h1>
            </div>

            <div class="col-sm-6">
               {{-- <a href="{{ route('attendance.teacher.add') }}" class="btn btn-primary" style="float: right;">Add Attendance</a> --}}
            </div>
         </div>

         @include('_message')
         
      </div>

   </section>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                <form action="" method="POST">
                    @csrf
                    <div class="card" style="padding: 20px;">
                    {{-- <div class="row" style="text-align: center"> --}}
                        {{-- @foreach ($getClass as $class)
                                <a class="btn btn-danger" href="{{ route('assign_student.term_list',[$class->id]) }}" style="margin: 10px; padding:15px;">{{ $class->name }} {{ $class->description }}</a>
                        @endforeach --}}
    
                        <div class="col-sm-6">
                            <h2>Promote From</h2>
                        </div>
    
                        <div class="form-group">
                            <label>Choose Class <span style="color: red;">*</span></label>
                            <select name="class_id" class="form-control" required>
                                <option value="">Select Class</option>
                                @foreach ($getClass as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                @endforeach
                            </select>
                        </div>
    
    
                        <div class="form-group">
                            <label>Choose Term <span style="color: red;">*</span></label>
                            <select name="exam_id" class="form-control" required>
                                <option value="">Select Term</option>
                                @foreach ($getExam as $exam)
                                    <option value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
    
                    <br>
    
                    <div class="card" style="padding: 20px;">
                        <div class="col-sm-6">
                            <h2>Promote To</h2>
                        </div>
    
                        <div class="form-group">
                            <label>Choose Class <span style="color: red;">*</span></label>
                            <select name="new_class_id" class="form-control" required>
                                <option value="">Select Class</option>
                                @foreach ($getClass as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                @endforeach
                            </select>
                        </div>
    
    
                        <div class="form-group">
                            <label>Choose Term <span style="color: red;">*</span></label>
                            <select name="new_exam_id" class="form-control" required>
                                <option value="">Select Term</option>
                                @foreach ($getExam as $exam)
                                    <option value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                @endforeach
                            </select>
                        </div>
    
                    </div>

                    <div class="form-group">
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    
                </form>
            </div>
         </div>
      </div>
   </section>


   
</div>
@endsection
