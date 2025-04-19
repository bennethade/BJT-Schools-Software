@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Behavior Chart</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Behavior Chart</h3>
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
                        <a href="{{ route('examinations.behavior_chart') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                     </div>
                  </div>
               </div>
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
              

               <div class="col-md-12">
                @if(!empty(Request::get('exam_id')) && !empty(Request::get('class_id')))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Student Name</th>
                                        <th>Generosity</th>
                                        <th>Punctuality</th>
                                        <th>Class Attendance</th>
                                        <th>Responsibility in Assignment</th>
                                        <th>Attentiveness</th>
                                        <th>Initiative</th>
                                        <th>Neatness</th>
                                        <th>Self Control</th>
                                        <th>Relationship with Staff</th>
                                        <th>Relationship with Students</th>
                                        <th>Merits</th>
                                        <th>Demerits/Detention</th>
                                        <th>Class Tutor's Mid-Term Comment</th>
                                        <th>Class Tutor's Exam Comment</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @if (!empty($getStudent) && !empty($getStudent->count()))
                                        @foreach ($getStudent as $value)
                                            <form action="" method="POST" class="SubmitForm" id="SubmitForm">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $value->id }}">
                                                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                <tr>
                                                    
                                                    {{-- <td>{{ $value->id }}</td> --}}
                                                    <td>{{ $id++ }}</td>
                                                    <td style="min-width: 200px;">{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>

                                                    {{-- <td>
                                                        <input type="number" name="number_of_times_present" style="width: 60px;" value="{{ $behaviorRecords[$value->id]->number_of_times_present ?? '' }}">
                                                    </td> --}}
                                                    
                                                    {{-- <td>
                                                        <input type="number" name="number_of_times_absent" style="width: 60px;" value="{{ $behaviorRecords[$value->id]->number_of_times_absent ?? '' }}">
                                                    </td> --}}

                                                    <td>

                                                        <label style="margin-right:15px;">
                                                            <select name="generosity" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->generosity == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->generosity == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->generosity == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->generosity == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->generosity == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="punctuality" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->punctuality == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->punctuality == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->punctuality == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->punctuality == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->punctuality == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="class_attendance" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->class_attendance == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->class_attendance == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->class_attendance == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->class_attendance == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->class_attendance == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="responsibility_in_assignments" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->responsibility_in_assignments == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->responsibility_in_assignments == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->responsibility_in_assignments == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->responsibility_in_assignments == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->responsibility_in_assignments == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="attentiveness" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->attentiveness == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->attentiveness == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->attentiveness == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->attentiveness == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->attentiveness == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="initiative" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->initiative == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->initiative == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->initiative == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->initiative == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->initiative == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>
                                                    
                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="neatness" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->neatness == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->neatness == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->neatness == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->neatness == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->neatness == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="self_control" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->self_control == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->self_control == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->self_control == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->self_control == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->self_control == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="relationship_with_staff" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_staff == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_staff == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_staff == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_staff == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_staff == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="relationship_with_students" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_students == '5' ? 'selected' : '' }} value="5">5</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_students == '4' ? 'selected' : '' }} value="4">4</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_students == '3' ? 'selected' : '' }} value="3">3</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_students == '2' ? 'selected' : '' }} value="2">2</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->relationship_with_students == '1' ? 'selected' : '' }} value="1">1</option>
                                                            </select>
                                                        </label>
                                                    </td>
                            
                                                    <td>
                                                        <textarea name="merits" class="form-control" style="width: 200px">{{ $behaviorRecords[$value->id]->merits ?? '' }}</textarea>
                                                    </td>
                                                    
                                                    <td>
                                                        <textarea name="demerits_detention" class="form-control" style="width: 200px">{{ $behaviorRecords[$value->id]->demerits_detention ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="class_tutor_midterm_comment" class="form-control" style="width: 300px">{{ $behaviorRecords[$value->id]->class_tutor_midterm_comment ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="class_tutor_comment" class="form-control" style="width: 300px">{{ $behaviorRecords[$value->id]->class_tutor_comment ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <button type="submit" class="btn btn-success" style="">Save</button>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Generosity</th>
                                                    <th>Punctuality</th>
                                                    <th>Class Attendance</th>
                                                    <th>Responsibility in Assignment</th>
                                                    <th>Attentiveness</th>
                                                    <th>Initiative</th>
                                                    <th>Neatness</th>
                                                    <th>Self Control</th>
                                                    <th>Relationship with Staff</th>
                                                    <th>Relationship with Students</th>
                                                    <th>Merits</th>
                                                    <th>Demerits/Detention</th>
                                                    <th>Class Tutor's Mid-Term Comment</th>
                                                    <th>Class Tutor's Exam Comment</th>
                                                    <th>Action</th>
                                                </tr>
                                                
                                            </form>

                                        @endforeach
                                    @endif
                                </tbody>                                
                                
                            </table>

                        </div>
                    </div>
                @endif
            </div>
            </div>
            <!-- /.col -->
         </div>
         
      </div>
   </section>
</div>
@endsection







@section('script')

<script type="text/javascript">
  
</script>

@endsection