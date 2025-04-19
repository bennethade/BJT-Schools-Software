@extends('layouts.app')

@section('styles')

<style type="text/css">
    
</style>


@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Home Fun</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card card-primary">
             
              
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Class <span style="color: red;">*</span></label>
                    <select name="class_id" id="getClass" class="form-control" required>
                        <option value="">Select Class</option>
                        @foreach ($getClass as $class)
                            <option {{ ($getRecord->class_id == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                        @endforeach
                    </select>
                  </div>

                  <div class="form-group">
                    <label>Term <span style="color: red;">*</span></label>
                    <select name="exam_id" id="getExam" class="form-control" required>
                        <option value="">Select Exam</option>
                        @foreach ($getExam as $exam)
                            <option {{ ($getRecord->exam_id == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label>Subject <span style="color: red;">*</span></label>
                    <select name="subject_id" id="getSubject" class="form-control" required>
                        <option value="">Select</option>
                        @foreach ($getSubject as $subject)
                            <option {{ ($getRecord->subject_id == $subject->subject_id) ? 'selected' : '' }} value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                        @endforeach
                    </select>
                  </div>


                  <div class="form-group">
                    <label>Home Fun Date <span style="color: red;">*</span></label>
                    <input type="date" value="{{ $getRecord->homework_date }}" class="form-control" name="homework_date" required>
                  </div>

                  <div class="form-group">
                    <label>Submission Date <span style="color: red;">*</span></label>
                    <input type="date" value="{{ $getRecord->submission_date }}" class="form-control" name="submission_date" required>
                  </div>


                  <div class="form-group">
                    <label>Document <small>(Not More Than 5mb)</small></label>
                    <input type="file" class="form-control" name="document_file">
                    @if (!empty($getRecord->getDocument()))
                        <a href="{{ $getRecord->getDocument() }}" class="btn btn-primary btn-sm" download="">Download</a>
                    @endif
                    @error('document_file')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>


                  
                  <div class="form-group">
                    <label>Description <span style="color: red;"></span></label>
                    <textarea id="compose-textarea" name="description" class="form-control" style="height: 300px">
                        {{ $getRecord->description }}
                    </textarea>
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


@section('script')
<script src="{{ url('public/plugins/summernote/summernote-bs4.min.js') }}"></script>


    <script type="text/javascript">
        $(function () {


        $('#compose-textarea').summernote({ //For Text area
            height: 200,
        });



        $('#getClass').change(function() {
            var class_id = $(this).val();
            $.ajax({
                type: "POST",
                url: "{{ url('admin/ajax_get_subject') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    class_id : class_id,
                },
                dataType : "json",
                success: function(data) {
                    $('#getSubject').html(data.success);
                }
            });
        });

            

        });
    </script>





@endsection