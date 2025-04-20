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
                      <div class="form-group col-md-4">
                         <label>Exam</label>
                         <select class="form-control" name="exam_id" required>
                            <option value="">Select</option>
                            @foreach ($getExam as $exam)
                            <option {{ (Request::get('exam_id') == $exam->exam_id) ? 'selected' : '' }} value="{{ $exam->exam_id }}">{{ $exam->exam_name }} {{ $exam->exam_session }}</option>
                            @endforeach
                         </select>
                      </div>
                      <div class="form-group col-md-4">
                         <label>Class</label>
                         <select class="form-control" name="class_id" required>
                            <option value="">Select</option>
                            @foreach ($getClass as $class)
                            <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }} {{ $class->class_description }}</option>
                            @endforeach
                         </select>
                      </div>
                      <div class="form-group col-md-3">
                         <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                         <a href="{{ route('teacher.behavior_chart') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
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
                                        <th>No. Of Times Present</th>
                                        <th>No. Of Times Absent</th>
                                        <th>Creative Activities</th>
                                        <th>Handling Tools</th>
                                        <th>Handwriting</th>
                                        <th>Physical Activities</th>

                                        <th>Attitudes</th>
                                        <th>Value System</th>
                                        <th>Interest And Appreciation</th>
                                        <th>Interpersonal Relationship</th>
                                        <th>Emotional Adjustment</th>
                                        <th>Class Tutor's General Comment</th>
                                        <th>Head Teacher's Remark</th>
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

                                                    <td>
                                                        <input type="number" name="number_of_times_present" style="width: 60px;" value="{{ $behaviorRecords[$value->id]->number_of_times_present ?? '' }}">
                                                    </td>
                                                    
                                                    <td>
                                                        <input readonly type="number" name="number_of_times_absent" style="width: 60px;" value="{{ $behaviorRecords[$value->id]->number_of_times_absent ?? '' }}">
                                                    </td>

                                                    <td>

                                                        <label style="margin-right:15px;">
                                                            <select name="creative_activities" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->creative_activities == 'Excellent' ? 'selected' : '' }} value="Excellent">Excellent</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->creative_activities == 'Satisfactory' ? 'selected' : '' }} value="Satisfactory">Satisfactory</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->creative_activities == 'Interesting' ? 'selected' : '' }} value="Interesting">Interesting</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->creative_activities == 'Well Done' ? 'selected' : '' }} value="Well Done">Well Done</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="handling_tools" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handling_tools == 'Excellent' ? 'selected' : '' }} value="Excellent">Excellent</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handling_tools == 'Satisfactory' ? 'selected' : '' }} value="Satisfactory">Satisfactory</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handling_tools == 'Interesting' ? 'selected' : '' }} value="Interesting">Interesting</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handling_tools == 'Well Done' ? 'selected' : '' }} value="Well Done">Well Done</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="handwriting" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handwriting == 'Excellent' ? 'selected' : '' }} value="Excellent">Excellent</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handwriting == 'Satisfactory' ? 'selected' : '' }} value="Satisfactory">Satisfactory</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handwriting == 'Interesting' ? 'selected' : '' }} value="Interesting">Interesting</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->handwriting == 'Well Done' ? 'selected' : '' }} value="Well Done">Well Done</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="physical_activities" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->physical_activities == 'Excellent' ? 'selected' : '' }} value="Excellent">Excellent</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->physical_activities == 'Satisfactory' ? 'selected' : '' }} value="Satisfactory">Satisfactory</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->physical_activities == 'Interesting' ? 'selected' : '' }} value="Interesting">Interesting</option>
                                                                <option {{ optional($behaviorRecords[$value->id])->physical_activities == 'Well Done' ? 'selected' : '' }} value="Well Done">Well Done</option>
                                                            </select>
                                                        </label>
                                                    </td>


                                                    {{-- PERSONAL QUALITIES --}}

                                                    
                                                    <td>
                                                        <textarea name="attitudes" class="form-control" style="width: 300px; height:40px;">{{ $behaviorRecords[$value->id]->attitudes ?? '' }}</textarea>
                                                    </td>
                                                    
                                                    <td>
                                                        <textarea name="value_system" class="form-control" style="width: 300px; height:40px;">{{ $behaviorRecords[$value->id]->value_system ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="interest_and_appreciation" class="form-control" style="width: 300px; height:40px;">{{ $behaviorRecords[$value->id]->interest_and_appreciation ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="inter_personal_relationship" class="form-control" style="width: 300px; height:40px;">{{ $behaviorRecords[$value->id]->inter_personal_relationship ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="emotional_adjustment" class="form-control" style="width: 300px; height:40px;">{{ $behaviorRecords[$value->id]->emotional_adjustment ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="class_tutor_comment" class="form-control" style="width: 300px">{{ $behaviorRecords[$value->id]->class_tutor_comment ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <textarea name="head_teacher_remark" class="form-control" style="width: 300px">{{ $behaviorRecords[$value->id]->head_teacher_remark ?? '' }}</textarea>
                                                    </td>

                                                    <td>
                                                        <button type="submit" class="btn btn-success" style="">Save</button>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>No. Of Times Present</th>
                                                    <th>No. Of Times Absent</th>
                                                    <th>Creative Activities</th>
                                                    <th>Handling Tools</th>
                                                    <th>Hand Writing</th>
                                                    <th>Physical Activities</th>

                                                    <th>Attitudes</th>
                                                    <th>Value System</th>
                                                    <th>Interest And Appreciation</th>
                                                    <th>Interpersonal Relationship</th>
                                                    <th>Emotional Adjustment</th>
                                                    <th>Class Tutor's Comment</th>
                                                    <th>Head Teacher's Remark</th>
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