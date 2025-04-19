@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Marks Register</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Marks Register</h3>
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
                        <a href="{{ route('examinations.marks_register') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              

               @if (!empty($getSubject) && !empty($getSubject->count()))
                   
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Marks Register</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">
                           {{-- <thead>
                              @php
                              $id = 1
                              @endphp
                              <tr>
                                 <th>STUDENT NAME</th>
                                 @foreach ($getSubject as $subject)
                                    <th>
                                        {{ $subject->subject_name }}  <br/>
                                    </th>
                                 @endforeach
                                 <th>ACTION</th>
                              </tr>
                           </thead> --}}
                           <tbody>
                                 @php
                                    $sn = 1;
                                @endphp

                                @if (!empty($getStudent) && !empty($getStudent->count()))
                                    @foreach ($getStudent as $student)
                                       <form action="" method="POST" class="SubmitForm" id="SubmitForm">
                                          @csrf
                                          <input type="hidden" name="student_id" value="{{ $student->id }}">
                                          <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                          <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">

                                          <thead>
                                            @php
                                            $id = 1
                                            @endphp
                                            <tr>
                                                <th>S/N</th>
                                               <th>STUDENT NAME</th>
                                               {{-- @foreach ($student->getStudentSubject(Request::get('class_id'), Request::get('exam_id'), $student->id) as $subject) --}}
                                               @foreach ($getSubject as $subject)
                                                  <th>
                                                      {{ $subject->subject_name }}  <br/>
                                                  </th>
                                               @endforeach
                                               <th>ACTION</th>
                                            </tr>
                                         </thead>

                                          
                                          <tr>
                                             <td>{{ $sn++ }}</td>
                                             <td style="min-width: 200px;">{{ $student->name }} {{ $student->last_name }} {{ $student->other_name }}</td>

                                             @php
                                                 $i = 1;

                                                 $totalStudentMark = 0;

                                                 $totalFullMark = 0;
                                                 
                                                 $totalPassMark = 0;

                                                 $pass_fail_validation = 0;
                                             @endphp
                                             @foreach ($getSubject as $subject)
                                                @php
                                                   $totalMark = 0;

                                                   $totalFullMark = $totalFullMark + $subject->full_mark;

                                                   $totalPassMark = $totalPassMark + $subject->pass_mark;

                                                   $getMark = $subject->getMark($student->id, Request::get('exam_id'), Request::get('class_id'), $subject->subject_id);

                                                   if(!empty($getMark))
                                                   {
                                                      $totalMark = $getMark->ca + $getMark->project + $getMark->exam;
                                                   }

                                                   $totalStudentMark = $totalStudentMark + $totalMark;

                                                @endphp
                                                <td>
                                                   <div style="margin-bottom: 15px;">
                                                      
                                                      <input type="hidden" name="mark[{{ $i }}][full_mark]" value="{{ $subject->full_mark }}">
                                                      <input type="hidden" name="mark[{{ $i }}][pass_mark]" value="{{ $subject->pass_mark }}">

                                                      <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                                      <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">

                                                      CA
                                                      <input type="number" name="mark[{{ $i }}][ca]" id="ca_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="CA" value="{{ !empty($getMark->ca) ? $getMark->ca : '' }}" class="form-control">
                                                   </div>

                                                   <div style="margin-bottom: 15px;">
                                                      Project
                                                      <input type="number" name="mark[{{ $i }}][project]" id="project_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="PJCT" value="{{ !empty($getMark->project) ? $getMark->project : '' }}" class="form-control">
                                                   </div>

                                                   <div style="margin-bottom: 15px;">
                                                      Exam
                                                      <input type="number" name="mark[{{ $i }}][exam]" id="exam_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="Exam" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" class="form-control">
                                                   </div>
                                                   
                                                   <div style="margin-bottom: 15px;">
                                                      Comment
                                                      <textarea name="mark[{{ $i }}][teacher_remark]" id="teacher_remark_{{ $student->id }}{{ $subject->subject_id }}" cols="" rows="5" placeholder="Subject Comment" class="form-control">{{ !empty($getMark->teacher_remark) ? $getMark->teacher_remark : '' }}</textarea>
                                                   </div>
                                                   

                                                   <div style="margin-bottom: 15px;">
                                                   <button type="button" class="SaveSingleSubject btn btn-primary" id="{{ $student->id }}"
                                                         data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}"
                                                         data-schedule="{{ $subject->id }}" data-class="{{ Request::get('class_id') }}">Save</button>
                                                   </div>

                                                   @if (!empty($getMark))
                                                      <div style="margin-bottom: 15px;">
                                                         <b>Subject Total: </b> {{ $totalMark }} <br/>
                                                         <b>Pass Mark: </b> {{ $subject->pass_mark }} <br>

                                                         @php
                                                            $getLoopGrade = App\Models\MarksGrade::getGrade($totalMark);
                                                         @endphp
                                                         
                                                         @if (!empty($getLoopGrade))
                                                            @if($getLoopGrade == 'F')
                                                                <b>Grade: </b> <span style="color: red; font-weight: bold;">{{ $getLoopGrade }}</span>  <br>
                                                            @else
                                                                <b>Grade: </b> <span style="color: blue; font-weight: bold;">{{ $getLoopGrade }}</span>  <br>
                                                            @endif
                                                         @endif

                                                         @if ($totalMark >= $subject->pass_mark)
                                                            <b> Result : </b><span style="color: green; font-weight: bold;">Pass</span>
                                                         @else
                                                            <b> Result : </b><span style="color: red; font-weight: bold;">Fail</span>
                                                            @php
                                                               $pass_fail_validation = 1;
                                                            @endphp
                                                         @endif
                                                      </div>                                                      
                                                   @endif
                                                   

                                                </td>
                                                @php
                                                 $i++;
                                                @endphp
                                             @endforeach
                                             <td style="min-width: 250px;">
                                                {{-- <button type="submit" class="btn btn-success" style="margin-top: 60px;">Save</button> --}}

                                                @if (Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == '1')
                                                   <a class="btn btn-success" style="margin-top: 60px;" target="_blank" href="{{ url('admin/my_exam_result/print?exam_id=' . Request::get('exam_id') . '&student_id='.$student->id) }}">Print Result</a>
                                                
                                                @else
                                                   <a class="btn btn-warning" style="margin-top: 60px;" target="_blank" href="{{ url('other_roles/my_exam_result/print?exam_id=' . Request::get('exam_id') . '&student_id='.$student->id) }}">Print Result</a>
                                                @endif


                                                @if (!empty($totalStudentMark))
                                                   
                                                   <br> <br>
                                                   <!--<b> Total Subject Mark : </b> {{ $totalFullMark }}-->
                                                   <br>
                                                   <!--<b> Total Pass Mark : </b> {{ $totalPassMark  }}-->
                                                   <br>
                                                   <b> Student Total Mark : </b> {{ $totalStudentMark }}
                                                   <br>

                                                   @php
                                                      $percentage = ($totalStudentMark * 100) / $totalFullMark;

                                                      $getGrade = App\Models\MarksGrade::getGrade($percentage);
                                                      // print_r($getGrade);
                                                   @endphp

                                                   <br>
                                                   {{-- <b>Percentage : </b>{{ round($percentage, 2) }}% --}}
                                                   <!--<b>Percentage : </b>{{ number_format($percentage, 2) }}%-->
                                                   <br>
                                                   @if (!empty($getGrade))
                                                      <!--<b>Final Grade : </b>{{ $getGrade }}-->
                                                   @endif

                                                   <br>   
                                                   @if ($totalStudentMark >= $totalPassMark)
                                                      <!--<b> Final Status : </b> <span style="color: green; font-weight: bold;">Pass</span>-->
                                                   @else
                                                      <!--<b> Final Status : </b> <span style="color: red; font-weight: bold;">Fail</span>-->
                                                   @endif

                                                @endif
                                                   
                                             </td>
                                          </tr>                                          
                                       </form>
                                       {{-- <tr>
                                          <th></th>
                                          @foreach ($getSubject as $subject)
                                             <th>
                                                 {{ $subject->subject_name }}  <br/>
                                             </th>
                                          @endforeach
                                          <th>ACTION</th>
                                       </tr> --}}
                                    @endforeach
                                    
                                @endif
                                
                           </tbody>

                        </table>
                        
                     </div>
                     <!-- /.card-body -->
                  </div>
                  
               @endif

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

@section('script')

<script type="text/javascript">


   // $('.SubmitForm').submit(function(e) {
   //    e.preventDefault();
   //    // console.log('hi');

   //    $.ajax({
   //       type: "POST",
   //       url : "{{ url('other_roles/examinations/submit_marks_register') }}",
   //       data: $(this).serialize(),
   //       dataType : "json",
   //       success: function(data) {
   //          alert(data.message);
   //       }
   //    });
   // });


   // //FOR SINGLE COLUMN SCORE SAVING
   // // $('.SaveSingleSubject').click(function(e) {  //TUTOR'S LINE

   // $(document).on('click', '.SaveSingleSubject', function(e) { //GPT'S LINE
   //    var student_id = $(this).attr('id');
   //    var subject_id = $(this).attr('data-val');
   //    var exam_id = $(this).attr('data-exam');
   //    var class_id = $(this).attr('data-class');
   //    var id = $(this).attr('data-schedule');
   //    var ca = $('#ca_'+student_id+subject_id).val();
   //    var exam = $('#exam_'+student_id+subject_id).val();
   //    var teacher_remark = $('#teacher_remark_'+student_id+subject_id).val();

   //    $.ajax({
   //       type: "POST",
   //       url : "{{ url('other_roles/single_submit_marks_register') }}",
   //       data: {
   //          "_token" : "{{ csrf_token() }}",
   //          id : id,
   //          student_id : student_id,
   //          subject_id : subject_id,
   //          exam_id : exam_id,
   //          class_id : class_id,
   //          ca : ca,
   //          exam : exam,
   //          teacher_remark : teacher_remark
   //       },
   //       dataType : "json",
   //       success: function(data) {
   //          alert(data.message);
   //       }
   //    });

   // });





   
////====UPDATED JS CODE FROM GPT TO DISABLED ACCIDENTAL CLICKS /////
   
////FOR MULTIPLE SAVE BUTTON

   $(document).ready(function() {
      $('.SubmitForm').submit(function(e) {
         e.preventDefault();

         var formValid = false;

         // Check if any of the ca or exam fields have values
         $(this).find('input[name^="mark["]').each(function() {
            var caValue = $(this).closest('tr').find('input[name$="[ca]"]').val();
            var projectValue = $(this).closest('tr').find('input[name$="[project]"]').val();
            var examValue = $(this).closest('tr').find('input[name$="[exam]"]').val();
            
            if (caValue || projectValue || examValue) {
               formValid = true;
               return false; // Exit the each loop if any of ca or project or exam value is found
            }
         });

         if (!formValid) {
            alert("Please enter either CA or Project or Exam scores for at least one subject.");
            return;
         }

         // Disable submit button
         var $submitBtn = $(this).find(':submit');
         $submitBtn.prop('disabled', true);

         $.ajax({
            type: "POST",
            url: "{{ url('other_roles/examinations/submit_marks_register') }}",
            data: $(this).serialize(),
            dataType: "json",
            success: function(data) {
               alert(data.message);
            },
            error: function(xhr, status, error) {
               console.error(xhr.responseText);
               alert("An error occurred: " + error);
            },
            complete: function() {
               // Re-enable submit button after 3 seconds
               setTimeout(function() {
                  $submitBtn.prop('disabled', false);
               }, 4000);
            }
         });
      });




///FOR SINGLE SAVE BUTTON
      

      $(document).on('click', '.SaveSingleSubject', function(e) {
         e.preventDefault();

         var $thisButton = $(this);
         var student_id = $thisButton.attr('id');
         var subject_id = $thisButton.attr('data-val');
         var exam_id = $thisButton.attr('data-exam');
         var class_id = $thisButton.attr('data-class');
         var id = $thisButton.attr('data-schedule');
         var ca = $('#ca_' + student_id + subject_id).val();
         var project = $('#project_' + student_id + subject_id).val();
         var exam = $('#exam_' + student_id + subject_id).val();
         var teacher_remark = $('#teacher_remark_' + student_id + subject_id).val();

         // Ensure at least one of CA or Exam is entered
         if (!ca && !project && !exam) {
            alert("PLEASE ENTER CA or EXAM SCORES.");
            return;
         }

         // Disable button to prevent multiple clicks
         $thisButton.prop('disabled', true);

         $.ajax({
            type: "POST",
            url: "{{ url('other_roles/single_submit_marks_register') }}",
            data: {
               "_token": "{{ csrf_token() }}",
               id: id,
               student_id: student_id,
               subject_id: subject_id,
               exam_id: exam_id,
               class_id: class_id,
               ca: ca,
               project: project,
               exam: exam,
               teacher_remark: teacher_remark
            },
            dataType: "json",
            success: function(data) {
               alert(data.message);
            },
            error: function(xhr, status, error) {
               console.error(xhr.responseText);
               alert("AN ERROR OCCURED WHILE SAVING YOUR SCORES: " + error);
            },
            complete: function() {
               // Re-enable button after 3 seconds
               setTimeout(function() {
                  $thisButton.prop('disabled', false);
               }, 4000);
            }
         });
      });
   });








</script>

@endsection