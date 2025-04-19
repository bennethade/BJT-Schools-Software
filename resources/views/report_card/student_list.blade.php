@extends('layouts.app')

@section('content')

   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
                  <h1>Student Report Card</h1>
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
                           <a href="{{ route('admin.report_card') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
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
                                    <th>S/N</th>
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

                                       <td style="min-width: 450px;">
                                          @if ($getSingleClassName->class_section == "Nursery School")
                                             @if (Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == '1')
                                                <a href="{{ url('admin/examinations/print_nursery_midterm_goals?class_id=' . $getSingleClassName->class_id . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}" class="btn btn-success" target="_blank">C.A Result</a>

                                                <a href="{{ url('admin/examinations/print_nursery_goals?class_id=' . $getSingleClassName->class_id . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}" class="btn btn-warning" target="_blank">Exam Result</a>
                                             @else
                                                <a href="{{ url('other_roles/print_nursery_midterm_goals/print?class_id=' . $getSingleClassName->class_id . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}" class="btn btn-success" target="_blank">C.A Result</a>

                                                <a href="{{ url('other_roles/print_nursery_goals/print?class_id=' . $getSingleClassName->class_id . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}" class="btn btn-warning" target="_blank">Exam Result</a>
                                             @endif
                                          @else
                                             
                                             <a href="{{ url('admin/my_ca_result/print?exam_id=' . Request::get('exam_id') . '&student_id='.$value->id) }}" class="btn btn-success" target="_blank" >C.A Result</a>

                                             <a href="{{ url('admin/my_exam_result/print?exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}" class="btn btn-warning" target="_blank" style="margin: 5px;">Exam Result</a>

                                             @if ($getSingleExamName->name == 'Term 3')
                                                   <a class="btn" style="background: #ec24a0; color: white;" target="_blank" href="{{ url('admin/examinations/cumulative_exam_result/print?class_id=' . Request::get('class_id') . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}">Print Cumulative Result</a>
                                             @endif

                                          @endif
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
   </div>
@endsection