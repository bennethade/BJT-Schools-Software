@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Nursery Subject Comments</h1>
            </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Comment</h3>
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
                        <a href="{{ route('examinations.subject_comment') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </section>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
               @include('_message')
              

               @if (!empty($getSubject) && !empty($getSubject->count()))
                   
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Comment Entry</h3>
                     </div>
                     <!-- /.card-header -->
                     <div class="card-body p-0" style="overflow: auto;">
                        <table class="table table-striped">
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
                                             @endphp
                                             @foreach ($getSubject as $subject)
                                                @php
                                                

                                                   $getComment = $subject->getComment(Request::get('class_id'), Request::get('exam_id'), $student->id, $subject->subject_id);


                                                @endphp
                                                <td>
                                                   <div style="margin-bottom: 5px;">
                                                      
                                                      <input type="hidden" name="mark[{{ $i }}][id]" value="{{ $subject->id }}">
                                                      <input type="hidden" name="mark[{{ $i }}][subject_id]" value="{{ $subject->subject_id }}">

                                                   </div>
                                                   
                                                   <div style="margin-bottom: 15px;">
                                                      Comment
                                                      <textarea name="mark[{{ $i }}][comment]" id="comment_{{ $student->id }}{{ $subject->subject_id }}" cols="" rows="6" placeholder="Subject Comment" class="form-control" style="width: 250px;">{{ !empty($getComment->comment) ? $getComment->comment : '' }}</textarea>
                                                   </div>
                                                   

                                                   <div style="margin-bottom: 15px;">
                                                        <button type="button" class="SaveSingleSubject btn btn-primary" id="{{ $student->id }}"
                                                                data-val="{{ $subject->subject_id }}" data-exam="{{ Request::get('exam_id') }}"
                                                                data-class="{{ Request::get('class_id') }}">Save</button>

                                                                {{-- data-schedule="{{ $subject->id }}"  --}}
                                                   </div>
                                                   

                                                </td>
                                                @php
                                                 $i++;
                                                @endphp
                                             @endforeach
                                             <td style="min-width: 250px;">

                                                @if (Auth::user()->user_type == 'Super Admin' || Auth::user()->user_type == 'School Admin' || Auth::user()->user_type == '1')
                                                    <a href="{{ url('admin/examinations/print_nursery_goals?exam_id=' . Request::get('exam_id') . '&student_id=' . $student->id) }}" class="btn btn-sm btn-warning" style="margin-top:30px;" target="_blank">View Result</a>
                                                @else
                                                    <a href="{{ url('other_roles/print_nursery_goals/print?exam_id=' . Request::get('exam_id') . '&student_id=' . $student->id) }}" class="btn btn-sm btn-warning" style="margin-top:30px;" target="_blank">View Result</a>
                                                @endif

                                                   
                                             </td>
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
         
      </div>
   </section>
</div>
@endsection

@section('script')

<script type="text/javascript">


   //FOR SINGLE COLUMN SCORE SAVING

    // $(document).on('click', '.SaveSingleSubject', function(e) { 
    //     var student_id = $(this).attr('id');
    //     var subject_id = $(this).attr('data-val');
    //     var exam_id = $(this).attr('data-exam');
    //     var class_id = $(this).attr('data-class');
    //     var id = $(this).attr('data-schedule');
    //     var comment = $('#comment_'+student_id+subject_id).val();

    //     $.ajax({
    //         type: "POST",
    //         url : "{{ url('admin/examinations/single_submit_subject_comment') }}",
    //         data: {
    //             "_token" : "{{ csrf_token() }}",
    //             id : id,
    //             student_id : student_id,
    //             subject_id : subject_id,
    //             exam_id : exam_id,
    //             class_id : class_id,
    //             comment : comment
    //         },
    //         dataType : "json",
    //         success: function(data) {
    //             alert(data.message);
    //         }
    //     });

    // });





   
////FOR MULTIPLE SAVE BUTTON
   $(document).ready(function() {
      
        $(document).on('click', '.SaveSingleSubject', function(e) {
            e.preventDefault();

            var $thisButton = $(this);
            var student_id = $thisButton.attr('id');
            var subject_id = $thisButton.attr('data-val');
            var exam_id = $thisButton.attr('data-exam');
            var class_id = $thisButton.attr('data-class');
            //  var id = $thisButton.attr('data-schedule');
            
            var comment = $('#comment_' + student_id + subject_id).val();

            if (!comment) {
                alert("PLEASE ENTER COMMENT.");
                return;
            }

            $thisButton.prop('disabled', true);

            $.ajax({
                type: "POST",
                url: "{{ url('admin/examinations/single_submit_subject_comment') }}",
                data: {
                "_token": "{{ csrf_token() }}",
                // id: id,
                student_id: student_id,
                subject_id: subject_id,
                exam_id: exam_id,
                class_id: class_id,
                comment: comment
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
                setTimeout(function() {
                    $thisButton.prop('disabled', false);
                }, 4000);
                }
            });
        });
    });





</script>

@endsection