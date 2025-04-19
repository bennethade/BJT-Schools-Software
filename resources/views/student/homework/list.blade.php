@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>My Homework</h1>
        </div>
        
      </div>
    </div>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <div class="col-md-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search My Homework</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject_name" placeholder="Subject Name" value="{{ Request::get('subject_name') }}">
                  </div>

                  {{-- <div class="form-group col-md-3">
                    <label>Homework Date From</label>
                    <input type="date" class="form-control" name="homework_date_from" value="{{ Request::get('homework_date_from') }}">
                  </div> --}}

                  {{-- <div class="form-group col-md-3">
                    <label>Homework Date To</label>
                    <input type="date" class="form-control" name="homework_date_to" value="{{ Request::get('homework_date_to') }}">
                  </div> --}}


                  {{-- <div class="form-group col-md-3">
                    <label>Submission Date From</label>
                    <input type="date" class="form-control" name="submission_date_from" value="{{ Request::get('submission_date_from') }}">
                  </div> --}}

                  {{-- <div class="form-group col-md-3">
                    <label>Submission Date To</label>
                    <input type="date" class="form-control" name="submission_date_to" value="{{ Request::get('submission_date_to') }}">
                  </div> --}}


                  {{-- <div class="form-group col-md-3">
                    <label>Created Date From</label>
                    <input type="date" class="form-control" name="created_date_from" value="{{ Request::get('created_date_from') }}">
                  </div> --}}

                  {{-- <div class="form-group col-md-3">
                    <label>Created Date To</label>
                    <input type="date" class="form-control" name="created_date_to" value="{{ Request::get('created_date_to') }}">
                  </div> --}}

                  <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('student.my_homework') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </form>
          </div>


          @include('_message')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Homework List</h3>
            </div>
            <div class="card-body p-0">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1
                  @endphp
                  <tr>
                    <th>#</th>
                    <th>Class</th>
                    <th>Subject</th>
                    <th>Homework Date</th>
                    <th>Submission Date</th>
                    <th>Document</th>
                    <th>Description</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->class_name }}</td>
                        <td>{{ $value->subject_name }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->homework_date)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->submission_date)) }}</td>
                        <td>
                          @if (!empty($value->getDocument()))
                            <a href="{{ $value->getDocument() }}" class="btn btn-primary btn-sm" download="">Download</a>
                          @endif
                        </td>
                        <td>{!! $value->description !!}</td>
                        <td>{{ $value->created_by }}</td>
                        <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 200px;">
                          <a href="{{ url('student/my_homework/submit_homework/'.$value->id) }}" class="btn btn-primary btn-sm">Submit Homework</a>
                      </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="100%">Record Not Found</td>
                      </tr>
                    @endforelse
                </tbody>
              </table>
              <div style="padding: 10px; float: right;">
                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
             </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </section>
</div>



@endsection