@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Student Results</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Search Student Result</h3>
                    </div>

                    <form method="get" action=" ">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Class</label>
                                    <select class="form-control" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Term</label>
                                    <select class="form-control" name="exam_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getExam as $exam)
                                            <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                    <a href="{{ route('parent.my_student_results') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
                        <!-- /.card -->

                        @if(!empty(Request::get('exam_id')))

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
                                                <th>Email</th>
                                                <th>Gender</th>
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
                                                    <td style="min-width: 200px">{{ $value->name }} {{ $value->last_name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->gender }}</td>


                                                    @if ($getSingleClassName->section == 'Nursery School')
                                                        <td style="min-width: 50px;">
                                                            {{-- <a class="btn btn-info btn-sm" style="" target="_blank" href="{{ url('parent/print_nursery_midterm_goals?exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}">C.A Result</a> --}}

                                                            <a class="btn btn-warning btn-sm" style="" target="_blank" href="{{ url('parent/print_nursery_goals?exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}">Exam Result</a>
                                                        </td>
                                                    @else
                                                        <td style="min-width: 400px;">
                                                            {{-- <a href="{{ url('parent/my_ca_result/print?exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}" class="btn btn-warning btn-sm" style="margin-left: 5px;" target="_blank" >C.A Result</a> --}}

                                                            <a class="btn btn-primary btn-sm" style="" target="_blank" href="{{ url('parent/my_exam_result/print?class_id=' . Request::get('class_id') . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}">Exam Result</a>

                                                            @if ($getSingleExamName->name == 'Term 3')
                                                                <a class="btn btn-info btn-sm" style="background: #ec24a0; color: white;" target="_blank" href="{{ url('parent/cumulative_exam_result/print?class_id=' . Request::get('class_id') . '&exam_id=' . Request::get('exam_id') . '&student_id=' . $value->id) }}">Print Cumulative Result</a>
                                                            @endif
                                                        </td>
                                                    @endif

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        @endif
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>

            </div>

        </section>
        <!-- /.content -->
    </div>
@endsection