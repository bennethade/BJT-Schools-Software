@extends('layouts.app')

@section('content')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
      <div class="col-sm-9">
        <h1> Assign This CBT: <span style="color: brown;">{{ $getRecord->exam_title }}</span></h1>
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

        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('teacher.cbt.assign.store', $getRecord->id) }}">
          @csrf
          <div class="card-body">
          <div class="form-group">
            <label>Choose Term</label>
            <select class="form-control" name="exam_id" required>
            <option value="">Select</option>
            @foreach ($getExam as $exam)
        <option value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
      @endforeach
            </select>
          </div>


          <div class="form-group">
            <label>Select Classes to Assign to</label>
            @foreach ($getClass as $class)
        <div>
        <label style="font-weight: normal">
          <input type="checkbox" value="{{ $class->id }}" name="class_id[]" id="">{{ $class->name }}
          {{ $class->description }}
        </label>
        </div>
      @endforeach
          </div>

          <div class="form-group">
            <label>Status</label>
            <select class="form-control" name="status">
            <option value="1">Active</option>
            <option value="0">Inactive</option>
            </select>
          </div>

          </div>

          <div class="card-footer">
          <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
        </div>
      </div>

      </div>
    </div>
    </section>
  </div>

@endsection