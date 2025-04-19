@extends('layouts.app')
@section('styles')
<style type="text/css"></style>
@endsection
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-12">
               <h1>Nursery Midterm Subject Goals <span style="color: red; font-size:18px;">(For Midterm ONLY)</span></h1>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Class Details</h3>
                </div>
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label>Class <span style="color: red;">*</span></label>
                                <select name="class_id" id="getClass" class="form-control" required>
                                    <option value="">Select Class</option>
                                    @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Term <span style="color: red;">*</span></label>
                                <select name="exam_id" id="getExam" class="form-control" required>
                                    <option value="">Select Term</option>
                                    @foreach ($getExam as $exam)
                                        <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label>Student Name <span style="color: red;">*</span></label>
                                <select name="student_id" id="getStudent" class="form-control" required>
                                    <option value="">Select</option>
                                    @if(isset($getStudentList))  
                                        @foreach ($getStudentList as $student) 
                                            <option value="{{ $student->student_id }}" 
                                                {{ (Request::get('student_id') == $student->student_id) ? 'selected' : '' }}>
                                                {{ $student->user_name }} {{ $student->user_last_name }} {{ $student->user_other_name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>


                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                <a href="{{ route('teacher.nursery_midterm.goals') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
            <div class="col-md-12">
                @if(!empty(Request::get('class_id')) && !empty(Request::get('exam_id')) && !empty(Request::get('student_id')))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Midterm Subject Goal List</h3>
                            <a href="{{ url('teacher/print_nursery_midterm_goals?class_id=' . $getSingleClassName->class_id . '&exam_id=' . Request::get('exam_id') . '&student_id=' . Request::get('student_id')) }}" class="btn btn-sm btn-warning float-right" style="" target="_blank">Print Result</a>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Subject Name</th>
                                        <th>Subject Category</th>
                                        <th>Learning Outcome</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp

                                    @if (!empty($getSubject) && $getSubject->count())
                                        @foreach ($getSubject as $subject)
                                            @php
                                                $goal = $existingGoals->get($subject->id);
                                                $outcome = $goal ? $goal->learning_outcome : '';
                                            @endphp
                                            <tr>
                                                <td>{{ $id++ }}</td>
                                                <td>{{ $subject->name }}</td>
                                                <td>{{ $subject->category_name }}</td>
                                                <td width="250px">
                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="1" data-subject-id="{{ $subject->id }}" data-category-id="{{ $subject->category_id }}" class="SaveSubject" name="subject{{ $subject->id }}" {{ $outcome == '1' ? 'checked' : '' }}> Em
                                                    </label>

                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="2" data-subject-id="{{ $subject->id }}" data-category-id="{{ $subject->category_id }}" class="SaveSubject" name="subject{{ $subject->id }}" {{ $outcome == '2' ? 'checked' : '' }}> Ep
                                                    </label>

                                                    <label style="margin-right:15px;">
                                                        <input type="radio" value="3" data-subject-id="{{ $subject->id }}" data-category-id="{{ $subject->category_id }}" class="SaveSubject" name="subject{{ $subject->id }}" {{ $outcome == '3' ? 'checked' : '' }}> Ex
                                                    </label>

                                                    {{-- <label style="margin-right:15px;">
                                                        <input type="radio" value="4" data-subject-id="{{ $subject->id }}" data-category-id="{{ $subject->category_id }}" class="SaveSubject" name="subject{{ $subject->id }}" {{ $outcome == '4' ? 'checked' : '' }}> E
                                                    </label> --}}
                                                </td>
                                            </tr>
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
   $(function () {
    $('#getClass, #getExam').change(function() {
        var class_id = $('#getClass').val();
        var exam_id = $('#getExam').val();
        var selected_student_id = "{{ Request::get('student_id') }}"; // Get previously selected student

        if (class_id && exam_id) {
            $.ajax({
                type: "POST",
                url: "{{ url('teacher/ajax_get_student') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id: class_id,
                    exam_id: exam_id,
                },
                dataType: "json",
                success: function(data) {
                    $('#getStudent').html(data.success);  // Populate the select box with all students

                    // If a student was previously selected, mark it as selected
                    if (selected_student_id) {
                        $('#getStudent').val(selected_student_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('An error occurred while fetching students.');
                }
            });
        } else {
            $('#getStudent').html('<option value="">Select</option>');
        }
    });
});


$(document).on('click', '.SaveSubject', function() {
    var $this = $(this); // Save the clicked radio button
    var class_id = $('#getClass').val();
    var exam_id = $('#getExam').val();
    var student_id = $('#getStudent').val();
    var subject_id = $(this).data('subject-id');
    var category_id = $(this).data('category-id');
    var learning_outcome = $(this).val();

    // Disable the radio button for 4 seconds
    $this.prop('disabled', true);

    if (class_id && exam_id && student_id && subject_id && category_id) {
        $.ajax({
            type: 'POST',
            url: '{{ route("teacher.save_midterm.goal") }}', // Create a route for saving goals
            data: {
                "_token": "{{ csrf_token() }}",
                class_id: class_id,
                exam_id: exam_id,
                student_id: student_id,
                subject_id: subject_id,
                category_id: category_id,
                learning_outcome: learning_outcome
            },
            success: function(response) {
                alert('Goal saved successfully');

                // Enable the radio button after 4 seconds
                setTimeout(function() {
                    $this.prop('disabled', false);
                }, 4000);
            },
            error: function(xhr) {
                console.error(xhr.responseText);
                alert('An error occurred while saving the goal');

                // Re-enable the radio button immediately in case of an error
                $this.prop('disabled', false);
            }
        });
    } else {
        // In case data is missing, re-enable the button immediately
        $this.prop('disabled', false);
    }
});


</script>
@endsection