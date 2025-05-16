@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My CBT Scores</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">

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
                                    <a href="{{ route('student.cbt.scores') }}" class="btn btn-success"
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
                    <div class="col-md-12">
                        @include('_message')

                        @if(!empty(Request::get('exam_id')) && !empty(Request::get('class_id')))

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">My CBT List</h3>
                                </div>
                                <div class="card-body p-0" style="overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            @php
                            $id = 1
                                            @endphp
                                            <tr>
                                                <th>S/N</th>
                                                <th>CBT Name</th>
                                                <th>Class</th>
                                                <th>Term</th>
                                                <th>Subject</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($getStudentCBTScores as $value)

                                                <tr>
                                                    <td>{{ $id++ }}</td>
                                                    <td>{{ $value->cbtExam->exam_title }}</td>
                                                    <td>{{ $value->cbtExam->class->name }}</td>
                                                    <td>{{ $value->term_name }} {{ $value->term_session }}</td>
                                                    <td>{{ $value->cbtExam->subject->name }}</td>
                                                    <td>
                                                        @if ($value->score >= 50)
                                                            <p class="badge badge-success">{{ $value->score }}</p>
                                                        @else
                                                            <p class="badge badge-danger">{{ $value->score }}</p>
                                                        @endif  
                                                    </td>
                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="100%">
                                                        <p style="color: red;">No CBT scores found for the chosen class and term
                                                        </p>
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        @endif

                    </div>
                </div>

            </div>

        </section>
    </div>
@endsection