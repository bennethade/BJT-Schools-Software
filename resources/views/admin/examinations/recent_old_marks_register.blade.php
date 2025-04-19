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
                                                      $totalMark = $getMark->ca1  + $getMark->ca2 + $getMark->ca3 + $getMark->exam;
                                                   }

                                                   $totalStudentMark = $totalStudentMark + $totalMark;

                                                @endphp
                                                <td>
                                                   <div style="margin-bottom: 15px;">
                                                      
                                                      <input type="hidden" name="mark[{{ $i }}][full_mark]" value="{{ $subject->full_mark }}">
                                                      <input type="hidden" name="mark[{{ $i }}][pass_mark]" value="{{ $subject->pass_mark }}">

                                                      <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                                      <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">

                                                      CA 1
                                                      <input readonly type="number" name="mark[{{ $i }}][ca1]" id="ca1_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="CA1" value="{{ !empty($getMark->ca1) ? $getMark->ca1 : '' }}" class="form-control">
                                                   </div>

                                                   <div style="margin-bottom: 15px;"> 
                                                      CA 2                                                       
                                                      <input readonly type="number" name="mark[{{ $i }}][ca2]" id="ca2_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="CA2" value="{{ !empty($getMark->ca2) ? $getMark->ca2 : '' }}" class="form-control">
                                                   </div>


                                                   @if (Request::get('class_id') == '13' || Request::get('class_id') == '14' || Request::get('class_id') == '15')
                                                      <div style="margin-bottom: 15px;">  
                                                         CA 3 
                                                         <input readonly type="number" name="mark[{{ $i }}][ca3]" id="ca3_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="CA3" value="{{ !empty($getMark->ca3) ? $getMark->ca3 : '' }}" class="form-control">
                                                      </div>
                                                   @endif
                                                   

                                                   <div style="margin-bottom: 15px;">
                                                      Exam
                                                      <input readonly type="number" name="mark[{{ $i }}][exam]" id="exam_{{ $student->id }}{{ $subject->subject_id }}" style="width: 130px;" placeholder="Exam" value="{{ !empty($getMark->exam) ? $getMark->exam : '' }}" class="form-control">
                                                   </div>
                                                   

                                                   <!--<div style="margin-bottom: 15px;">-->
                                                   <!--   <button type="button" class="SaveSingleSubject btn btn-primary" id="{{ $student->id }}" -->
                                                   <!--      data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}" -->
                                                   <!--      data-schedule="{{ $subject->id }}" data-class="{{ Request::get('class_id') }}">Save</button>-->
                                                   <!--</div>-->

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

                                                <a class="btn btn-success" style="margin-top: 60px;" target="_blank" href="{{ url('admin/my_exam_result/print?exam_id=' . Request::get('exam_id') . '&student_id='.$student->id) }}">Print Result</a>

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
   $('.SubmitForm').submit(function(e) {
      e.preventDefault();
      // console.log('hi');

      $.ajax({
         type: "POST",
         url : "{{ url('admin/examinations/submit_marks_register') }}",
         data: $(this).serialize(),
         dataType : "json",
         success: function(data) {
            alert(data.message);
         }
      });
   });


   //FOR SINGLE COLUMN SCORE SAVING
   $('.SaveSingleSubject').click(function(e) {
      var student_id = $(this).attr('id');
      var subject_id = $(this).attr('data-val');
      var exam_id = $(this).attr('data-exam');
      var class_id = $(this).attr('data-class');
      var id = $(this).attr('data-schedule');
      var ca1 = $('#ca1_'+student_id+subject_id).val();
      var ca2 = $('#ca2_'+student_id+subject_id).val();
      var ca3 = $('#ca3_'+student_id+subject_id).val();
      var exam = $('#exam_'+student_id+subject_id).val();

      $.ajax({
         type: "POST",
         url : "{{ url('admin/examinations/single_submit_marks_register') }}",
         data: {
            "_token" : "{{ csrf_token() }}",
            id : id,
            student_id : student_id,
            subject_id : subject_id,
            exam_id : exam_id,
            class_id : class_id,
            ca1 : ca1,
            ca2 : ca2,
            ca3 : ca3,
            exam : exam
         },
         dataType : "json",
         success: function(data) {
            alert(data.message);
         }
      });

   });
</script>

@endsection