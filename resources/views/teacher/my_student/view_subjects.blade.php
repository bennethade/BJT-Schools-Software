@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        @if (!empty($getStudent) && !empty($getStudent->count()))
            <div class="row mb-2">
                <div class="col-sm-4">
                <h4>{{ strtoupper($getStudent->student_name) }} {{ strtoupper($getStudent->student_last_name) }}</h4>
                </div>
                <div class="col-sm-6">
                <h4><span style="color: blue">{{ $getSingleClassName->class_name }} {{ $getSingleClassName->class_description }}</span> <span style="color: brown">{{ $getSingleExamName->name }} {{ $getSingleExamName->session }} </span></h4>
                </div>
                <div class="col-sm-2">
                    <a href="{{ url('teacher/my_exam_result/print?exam_id=' . $getExam->id . '&student_id='.$getStudent->student_id) }}" class="btn btn-success" target="blank">Print Result</a>
                </div>
            </div>
        @endif
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            
            <div class="card card-primary">
              
              
              <form method="POST" action="">
                @csrf

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Assign All Subjects</button>
                </div>
              </form>
            </div>


          </div>
          

          <div class="col-md-12">
            @include('_message')
            <!-- /.card -->
            <div class="card">
               <div class="card-header">
                  <h3 class="card-title">Student's Subject List</h3>
               </div>
               <!-- /.card-header -->
               <div class="card-body p-0" style="overflow: auto;">
                  <table class="table table-striped">
                     <thead>
                        @php
                        $id = 1
                        @endphp
                        <tr>
                           <th>S/N</th>
                           <th>Subject Name</th>
                           <th>Created By</th>
                           <th>Created Date</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @forelse($getRecord as $value)
                            <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $value->subject_name }} {{ $value->subject_description }}</td>
                            
                            <td>{{ $value->created_by_name }}</td>
                            <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                            <td>
                                <a href="{{ route('teacher.student_subject.delete.subject', [$value->id]) }}" class="btn btn-warning">Delete</a>
                            </td>
                            </tr>
                        @empty
                            <td colspan="100%">
                                <p style="color: red">Click on the 'Assign All Subjects' Button At The Top To Show Student's Subjects</p>
                            </td>
                        @endforelse
                     </tbody>
                  </table>
                  <div style="padding: 10px; float: right;">
                     {{-- {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }} --}}
                  </div>
               </div>
            </div>
         </div>


        </div>
      </div>
    </section>
  </div>

@endsection