@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit CBT</h1>
      </div>
      </div>
    </div>
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
      <div class="row">
      <!-- left column -->
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="card card-primary">

        <form method="POST" action="{{ route('teacher.cbt.update', [$getRecord->id]) }}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
          <div class="form-group">
            <label>CBT Exam Name <span style="color: red;">*</span></label>
            <input type="text" class="form-control" name="exam_title"
            value="{{ old('exam_title', $getRecord->exam_title) }}">
          </div>

          <div class="form-group">
            <label>Class <span style="color: red;">*</span></label>
            <select name="class_id" id="" class="form-control" required>
            <option value="">Select Class</option>
            @foreach ($getClass as $class)
        <option {{ (old('class_id', $getRecord->class_id) == $class->id) ? 'selected' : '' }}
          value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
      @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Term <span style="color: red;">*</span></label>
            <select name="exam_id" id="" class="form-control" required>
            <option value="">Select Term</option>
            @foreach ($getExam as $exam)
        <option {{ (old('exam_id', $getRecord->exam_id) == $exam->id) ? 'selected' : '' }}
          value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
      @endforeach
            </select>
          </div>

          <div class="form-group">
            <label>Subject <span style="color: red;">*</span></label>
            <select name="subject_id" id="" class="form-control" required>
            <option value="">Select Subject</option>
            @foreach ($getSubject as $subject)
                <option {{ (old('subject_id', $getRecord->subject_id) == $subject->subject_id) ? 'selected' : '' }}
                value="{{ $subject->subject_id }}">{{ $subject->subject_name }} {{ $subject->subject_description }}</option>
            @endforeach
            </select>
          </div>

          <div class="form-group">
            <label class="col-form-label">Overall Score <span style="color: red">*</span> </label>
            <input type="text" name="overall_score" id="" class="form-control" required value="{{ $getRecord->overall_score }}">
            <div style="color: red;">{{ $errors->first('overall_score') }}</div>
          </div>

          <div class="form-group">
            <label class="col-form-label" for="duration">Exam Duration (in minutes): <span
              style="color: red;">*</span></label>
            <input type="number" name="duration" class="form-control"
            value="{{ old('duration', $getRecord->duration) }}" min="1" max="240" required>
            <small class="form-text text-muted">
            Please specify the duration of the exam (e.g., 30, 60, 90...)
            </small>
          </div>

          <div class="form-group">
            <label class="col-form-label">Status <span style="color: red">*</span> </label>
            <select name="status" id="" class="form-control" required>
            <option value="">Select Status</option>
            <option {{ (old('status', $getRecord->status) == 1) ? 'selected' : '' }} value="1">Active</option>
            <option {{ (old('status', $getRecord->status) == 0) ? 'selected' : '' }} value="0">Inactive</option>
            </select>
            <div style="color: red;">{{ $errors->first('status') }}</div>
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