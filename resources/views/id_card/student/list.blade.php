@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Student ID Card</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Students</h3>
            </div>
            <form method="get" action=" ">
               <div class="card-body">
                  <div class="row">
                     
                     <div class="form-group col-md-4">
                        <label>Class</label>
                        <select class="form-control" name="class_id" required>
                           <option value="">Select</option>
                           @foreach ($getClass as $class)
                           <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group col-md-4">
                        <label>Exam</label>
                        <select class="form-control" name="exam_id" required>
                           <option value="">Select</option>
                           @foreach ($getExam as $exam)
                           <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                           @endforeach
                        </select>
                     </div>
                     
                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('student.id_list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </form>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               @include('_message')
              

               @if (!empty(Request::get('class_id')) && !empty(Request::get('exam_id')))
                   
                  <div class="card" style="overflow: auto">
                     <div class="card-header">
                        <h3 class="card-title">Student List</h3>
                     </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Photo</th>
                                  <th>Student Name</th>
                                  <th>Class</th>
                                  <th>Gender</th>
                                  <th>Action</th>
                                </tr>
                              </thead>

                              <tbody>
                                 @php
                                     $id = 1;
                                 @endphp
                                @forelse ($getStudent as $value)
                                <tr>
                                    <td>{{ $id++ }}</td>
                                    <td>
                                      @if (!empty($value->getProfileDirect()))
                                        <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                      @endif
                                    </td>
                                    <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                                    <td>{{ $value->class_name }}</td>
                                    <td>{{ $value->gender }}</td>
                                    <td style="min-width: 50px;">
                                      <a href="{{ route('student.id_print', [$value->id]) }}" class="btn btn-primary" target="blank">Print ID Card</a>
                                    </td>
                                  </tr>
                                @empty
                                    <td colspan="100%">
                                        <p>No Student found for the choosen class and term</p>
                                    </td>
                                @endforelse
                              </tbody>
                        </table>

                    
                     
                     
                  </div>
                  
               @endif

            </div>
         </div>
         
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection