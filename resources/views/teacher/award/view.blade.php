@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Student Awards</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            
            <form method="get" action=" ">
               <div class="card-body">
                  <div class="row">
                     
                     <div class="form-group col-md-3">
                        <label>Class</label>
                        <select class="form-control" name="class_id" required>
                           <option value="">Select</option>
                           @foreach ($getClass as $class)
                           <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }} {{ $class->class_description }}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group col-md-3">
                        <label>Exam</label>
                        <select class="form-control" name="exam_id" required>
                           <option value="">Select</option>
                           @foreach ($getExam as $exam)
                           <option {{ (Request::get('exam_id') == $exam->exam_id) ? 'selected' : '' }} value="{{ $exam->exam_id }}">{{ $exam->exam_name }} {{ $exam->exam_session }}</option>
                           @endforeach
                        </select>
                     </div>

                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('teacher.award.view') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                     </div>
                  </div>
               </div>
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
              

               <div class="col-md-12">
                @if(!empty(Request::get('exam_id')) && !empty(Request::get('class_id')))
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Student List</h3>
                        </div>
                        <div class="card-body p-0" style="overflow: auto;">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Student Name</th>
                                        <th>Early Bird</th>
                                        <th>Neatest Pupil</th>
                                        <th>Best Behaved Pupil</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $id = 1;
                                    @endphp
                                    @if (!empty($getStudent) && !empty($getStudent->count()))
                                        @foreach ($getStudent as $value)
                                            <form action="" method="POST">
                                                @csrf
                                                <input type="hidden" name="student_id" value="{{ $value->id }}">
                                                <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                <tr>
                                                    
                                                    {{-- <td>{{ $value->id }}</td> --}}
                                                    <td>{{ $id++ }}</td>
                                                    <td style="min-width: 200px;">{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>

                                                    <td>

                                                        <label style="margin-right:15px;">
                                                            <select name="early_bird" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($awards[$value->id])->early_bird == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="neatest_pupil" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($awards[$value->id])->neatest_pupil == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td>
                                                        <label style="margin-right:15px;">
                                                            <select name="best_behaved_pupil" id="">
                                                                <option value="">Select</option>
                                                                <option {{ optional($awards[$value->id])->best_behaved_pupil == 'Yes' ? 'selected' : '' }} value="Yes">Yes</option>
                                                            </select>
                                                        </label>
                                                    </td>

                                                    <td style="min-width: 180px;">
                                                        <button type="submit" class="btn btn-sm" style="background:purple; color:white">Save</button>
                                                        <a href="{{ route('teacher.award.view.single', [Request::get('class_id'), Request::get('exam_id'), $value->id]) }}" class="btn btn-sm btn-warning">View Award</a>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Early Bird</th>
                                                    <th>Neatest Pupil</th>
                                                    <th>Best Behaved Pupil</th>
                                                    <th>Action</th>
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
            <!-- /.col -->
         </div>
         
      </div>
   </section>
</div>
@endsection







@section('script')

<script type="text/javascript">
  
</script>

@endsection