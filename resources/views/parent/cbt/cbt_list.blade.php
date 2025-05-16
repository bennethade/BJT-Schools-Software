@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Student CBT List</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search CBT</h3>
                    </div>

                    <form method="get" action=" ">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label>Class</label>
                                    <select class="form-control" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }}
                                                value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Term</label>
                                    <select class="form-control" name="exam_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getExam as $exam)
                                            <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }}
                                                value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                    <a href="{{ route('parent.my_student_results') }}" class="btn btn-success"
                                        style="margin-top: 32px;">Refresh</a>
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
                                    <h3 class="card-title">Student List</h3>
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
                                            @foreach ($getStudent as $value)
                                                <tr>
                                                    <td>{{ $id++ }}</td>
                                                    <td>
                                                        @if (!empty($value->getProfileDirect()))
                                                            <img src="{{ $value->getProfileDirect() }}" alt=""
                                                                style="height: 50px; width: 50px; border-radius: 50px;">
                                                        @endif
                                                    </td>
                                                    <td style="min-width: 200px">{{ $value->last_name }} {{ $value->name }} {{ $value->other_name }}</td>
                                                    <td>{{ $value->email }}</td>
                                                    <td>{{ $value->gender }}</td>


                                                    <td style="min-width: 150px;">

                                                        <a class="btn btn-info btn-sm" style=""
                                                            href="{{ route('parent.student.cbt.scores', [Request::get('class_id'), Request::get('exam_id'), $value->id]) }}">View
                                                            CBT Scores</a>
                                                    </td>

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