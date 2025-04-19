@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Subject Teacher</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
       
              <form method="POST" action="">
                @csrf
                <div class="card-body">
                  
                    <div class="form-group">
                    <label>Class Name</label>
                    <select class="form-control" name="class_id" required>
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class)
                            <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Term</label>
                    <select class="form-control" name="exam_id" required>
                        <option value="">Select Term</option>
                        @foreach ($getExam as $exam)
                            <option {{ ($getRecord->exam_id == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label>Teacher</label>
                    <select class="form-control" name="teacher_id" required>
                        <option value="">Select Teacher</option>
                        @foreach ($getTeacher as $teacher)
                            <option {{ ($getRecord->teacher_id == $teacher->id) ? 'selected' : '' }} value="{{ $teacher->id }}">{{ $teacher->name }} {{ $teacher->last_name }} {{ $teacher->other_name }}</option>
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label>Subject Name</label>
                        @foreach ($getSubject as $subject)

                            @php
                                $checked = "";
                            @endphp

                            @foreach ($getAssignSubjectId as $subjectAssign)

                                @if($subjectAssign->subject_id == $subject->id)
                                    @php
                                        $checked = "checked";
                                    @endphp
                                @endif

                            @endforeach

                            <div>
                                <label style="font-weight: normal">
                                    <input {{ $checked }} type="checkbox" value="{{ $subject->id }}" name="subject_id[]" id="">{{ $subject->name }}
                                </label>
                            </div>
                        @endforeach
                  </div>

                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection