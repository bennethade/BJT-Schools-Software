@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1> 
            <span style="color: blue">{{ $getClassName->class_name }}</span> <span style="color: brown">{{ $getExamName->name }} {{ $getExamName->session }}</span> STUDENTS
            
            @if ($getClassName->class_section == 'Nursery School')
              <a href="{{ route('midterm.nursery.subject.view',[$getClassName->id, $getExamName->id]) }}" class="btn btn-warning btn-sm" style="margin-left: 50px;">Mid-Term Learning Objectives</a>

              <a href="{{ route('nursery.subject.view',[$getClassName->id, $getExamName->id]) }}" class="float-right btn btn-primary btn-sm">{{ $getExamName->name }} Exam L. Objectives</a>
            @endif
          </h1>
          {{-- <h1>Student List : ({{ $getRecord->total() }}) Total Students</h1> --}}
        </div>

        <div class="col-sm-6" style="text-align: right;">
            
        </div>
        
        
      </div>
    </div>
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Search Student</h3>
        </div>
        
        <form method="get" action=" ">
          <div class="card-body">
            <div class="row">

                {{-- <div class="form-group col-md-2">
                    <label>Student ID</label>
                    <input type="text" class="form-control" name="id" placeholder="Enter Student ID" value="{{ Request::get('id') }}">
                </div> --}}
                
              <div class="form-group col-md-6">
                <label>Search Student Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter First Name" value="{{ Request::get('name') }}">
              </div>

              {{-- <div class="form-group col-md-3">
                <label>Surname</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Other Name</label>
                <input type="text" class="form-control" name="other_name" placeholder="Enter Last Name" value="{{ Request::get('other_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-3">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Admission Number</label>
                <input type="text" class="form-control" name="admission_number" placeholder="Admission Number" value="{{ Request::get('admission_number') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Roll Number</label>
                <input type="text" class="form-control" name="roll_number" placeholder="Roll Number" value="{{ Request::get('roll_number') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Gender</label>
                <select name="gender" id="" class="form-control">
                  <option value="">Select Gender</option> 
                  <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                  <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                  <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option> 
              </select>
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Religion</label>
                <input type="text" class="form-control" name="religion" placeholder="religion" value="{{ Request::get('religion') }}">
              </div> --}}




              <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                <a href="{{ route('assign_student.student_list',[$getClassName->class_id, $getExamName->id]) }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
              </div>
              
            </div>
          </div>
          <!-- /.card-body -->
        </form>
      </div>    

    </div>
  </section>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <div class="col-md-12">

          @include('_message')




            @if(!empty($getSearchStudent))

                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title" style="color: red">Your Search Result</h3>
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
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Parent Name</th>
                            <th>Creaded Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                          @forelse ($getSearchStudent as $value)
                            
                              <tr>
                              <td>{{ $value->id }}</td>
                              <td>
                                  @if (!empty($value->getProfile()))
                                    <img src="{{ $value->getProfile() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                  @endif
                                  
                              </td>
                              <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                              <td>{{ $value->email }}</td>
                              <td>{{ $value->gender }}</td>
                              <td>{{ $value->parent_name }}</td>
                              
                              <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                              <td style="min-width: 150px;">
                                  <a href="{{ url('admin/assign_student/student_list/' . $getClassName->class_id . '/' . $getExamName->id . '/' . $value->id) }}" class="btn btn-primary btn-sm">Assign To {{ $getClassName->class_name }}</a>
                              </td>
                              </tr>
                          @empty

                              <td colspan="100%">
                                  <p style="color: red">Student Record Not Found!</p>
                              </td>
                            
                          @endforelse                        
                        </tbody>
                    </table>

                    <div style="padding: 10px; float: right;">

                        
                    </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            @endif










          <div class="card">
            <div class="card-header">
              <h3 class="card-title">List Of Students Already Assigned To Class</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Student Name</th>
                    <th>Parent Name</th>
                    <th>Email</th>
                    <th>Admission Number</th>
                    <th>Roll Number</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Religion</th>
                    <th>Mobile Number</th>
                    <th>Admission Date</th>
                    <th>Status</th>
                    <th>Password</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  
                  @php
                    $id = 1
                  @endphp

                  @forelse ($getRecord as $value)
                    <tr>
                      <td>{{ $id++ }}</td>
                      <td>
                        @if (!empty($value->getProfileDirect()))
                          <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                        @endif
                      </td>
                      <td>{{ $value->user_name }} {{ $value->user_last_name }} {{ $value->user_other_name }}</td>
                      <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->admission_number }}</td>
                      <td>{{ $value->roll_number }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->gender }}</td>
                      {{-- <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td> --}}

                      <td style="min-width: 100px;">
                          @if (!empty($value->date_of_birth) && $value->date_of_birth != '0000-00-00')
                              {{ date('d-m-Y', strtotime($value->date_of_birth)) }}
                          @else
                              <span style="color: red;">Date Not Available</span>
                          @endif
                      </td>

                      <td>{{ $value->religion }}</td>
                      <td>{{ $value->mobile_number }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->admission_date)) }}</td>
                      <td>{{ ($value->status == 0) ? 'Active' :'Inactive' }}</td>
                      <td>{{ $value->keep_track }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 390px;">
                        <a href="{{ url('admin/assign_student/edit', [$value->student_id]) }}" class="btn btn-primary btn-sm">Edit Data</a>
                        <a href="{{ url('admin/assign_student/student_list/remove/' . $getClassName->class_id . '/' . $getExamName->id . '/' . $value->student_id) }}" class="btn btn-danger btn-sm">Remove</a>

                        @if ($value->lock_student == 1 )
                          <a href="{{ url('admin/assign_student/student_list/unlock_student/' . $getClassName->class_id . '/' . $getExamName->id . '/' . $value->student_id) }}" class="btn btn-warning btn-sm">Unlock Student</a>  
                        @else
                          <a href="{{ url('admin/assign_student/student_list/lock_student/' . $getClassName->class_id . '/' . $getExamName->id . '/' . $value->student_id) }}" class="btn btn-warning btn-sm">Lock Student</a>  
                        @endif

                        @if ($getClassName->class_section == 'Nursery School')
                        
                        @else
                          <a href="{{ url('admin/student_subject/subject_list/view_subjects', [$getClassName->class_id, $getExamName->id, $value->student_id]) }}" class="btn btn-success btn-sm">View Subjects</a>
                        @endif
                        
                        
                        {{-- <a href="{{ url('chat?receiver_id=/'.base64_encode($value->id)) }}" class="btn btn-success btn-sm">Send Message</a> --}}
                      </td>
                    </tr>
                  @empty

                    <td colspan="100%">
                        <p style="color: red">No Student Assigned Yet</p>
                    </td>
                    
                  @endforelse
                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
              </div>

            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>



@endsection


