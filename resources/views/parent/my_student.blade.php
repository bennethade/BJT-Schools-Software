@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>My Student List</h1>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- /.col -->
                <div class="col-md-12">
                    @include('_message')
                    <!-- /.card -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">My Student(s)</h3>
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
                                        <th>Student Name</th>
                                        <!--<th>Email</th>-->
                                        <th>Admission Number</th>
                                        <th>Roll Number</th>
                                        <!--<th>Gender</th>-->
                                        <!--<th>Date Of Birth</th>-->
                                        <!--<th>Caste</th>-->
                                        <!--<th>Religion</th>-->
                                        <!--<th>Mobile Number</th>-->
                                        <!--<th>Admission Date</th>-->
                                        <!--<th>Blood Group</th>-->
                                        <!--<th>Height</th>-->
                                        <!--<th>Weight</th>-->
                                        <!--<th>Password</th>-->
                                        <!--<th>Created Date</th>-->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr>
                                        <td>{{ $id++ }}</td>
                                        <td>
                                            @if (!empty($value->getProfileDirect()))
                                            <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                            @endif
                                        </td>
                                        <td style="min-width: 200px;">{{ $value->last_name }} {{ $value->name }} {{ $value->other_name }}</td>
                                        <!--<td>{{ $value->email }}</td>-->
                                        <td>{{ $value->admission_number }}</td>
                                        <td>{{ $value->roll_number }}</td>
                                        <!--<td>{{ $value->gender }}</td>-->
                                        <!--<td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td>-->
                                        <!--<td>{{ $value->caste }}</td>-->
                                        <!--<td>{{ $value->religion }}</td>-->
                                        <!--<td>{{ $value->mobile_number }}</td>-->
                                        <!--<td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->admission_date)) }}</td>-->
                                        <!--<td>{{ $value->blood_group }}</td>-->
                                        <!--<td>{{ $value->height }}</td>-->
                                        <!--<td>{{ $value->height }}</td>-->
                                        <!--<td>{{ $value->keep_track }}</td>-->
                                        <!--<td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>-->
                                        <td style="min-width: 250px;">
                                            <a class="btn btn-secondary btn-sm" style="margin-bottom: 15px;" href="{{ route('parent.my_student_fees') }}">School Fees</a>
                                            <a class="btn btn-success btn-sm" style="margin-bottom: 15px;" href="{{ route('parent.my_student_results') }}">Exam Result</a>
                                            <!--<a class="btn btn-warning btn-sm" style="margin-bottom: 15px;" href="{{ route('parent.student.subject', [$value->id]) }}">Subjects</a>-->
                                            <!--<a class="btn btn-primary btn-sm" style="margin-bottom: 15px;" href="{{ route('parent.student.exam_timetable', [$value->id]) }}">Exam Timetable</a>-->
                                            {{-- <a class="btn btn-success btn-sm" style="margin-bottom: 15px;" href="{{ route('parent.student.exam_result', [$value->id]) }}">Exam Result</a> --}}
                                            <!--<a class="btn btn-sm" style="margin-bottom: 15px; background: purple; color: white;" href="{{ route('parent.student.attendance', [$value->id]) }}">Attendance</a>-->
                                            <!--<a class="btn btn-sm" style="margin-bottom: 15px; background: #ec24a0; color: white;" href="{{ route('parent.student.homework', [$value->id]) }}">New Homework</a>-->
                                            <!--<a class="btn btn-sm" style="margin-bottom: 15px; background: #ec7024; color: white;" href="{{ route('parent.student.submitted_homework', [$value->id]) }}">Submitted Homework</a>-->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div style="padding: 10px; float: right;">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection