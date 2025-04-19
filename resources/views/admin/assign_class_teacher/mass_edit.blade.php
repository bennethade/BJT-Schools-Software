@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Class Teacher</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
         
              <form method="POST" action="">
                @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label>Class Name</label>
                    <select class="form-control" name="class_id" required>
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class)
                            <option {{ ($getRecord->class_id == $class->id) ? 'selected' : ''  }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Term</label>
                    <select class="form-control" name="exam_id" required>
                        <option value="">Select</option>
                        @foreach ($getExam as $exam)
                            <option {{ ($getRecord->exam_id == $exam->id) ? 'selected' : ''  }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label>Teacher Name</label>
                        @foreach ($getTeacher as $teacher)
                            <div>
                                <label style="font-weight: normal">
                                    @php
                                        $checked = '';
                                    @endphp
                                    @foreach ($getAssignTeacherId as $teacherId)
                                        @if ($teacherId->teacher_id == $teacher->id)
                                            @php
                                                $checked = "checked";
                                            @endphp
                                        @endif
                                    @endforeach
                                    <input {{ $checked }} type="checkbox" value="{{ $teacher->id }}" name="teacher_id[]" id="">{{ $teacher->name }} {{ $teacher->last_name }} {{ $teacher->other_name }}    
                                </label>
                            </div>
                        @endforeach
                  </div>

                  <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" name="status">
                        <option {{ ($getRecord->status == 0) ? 'selected' : ''  }} value="0">Active</option>
                        <option {{ ($getRecord->status == 1) ? 'selected' : ''  }} value="1">Inactive</option>
                    </select>
                  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection