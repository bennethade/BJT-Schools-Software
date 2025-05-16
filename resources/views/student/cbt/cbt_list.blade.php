@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>My Pending CBT List</h1>
                    </div>
                </div>
            </div>
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
                                    <a href="{{ route('student.cbt.list') }}" class="btn btn-success"
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
                                                <th>Status</th>

                                                @if (!empty($alreadyTakenMap))
                                                    <th>Score</th>
                                                @else
                                                    <th>Action</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($getCBT as $value)
                                                <tr>
                                                    <td>{{ $id++ }}</td>

                                                    <td>{{ $value->exam_title }}</td>
                                                    <td>{{ $value->class_name }}</td>
                                                    <td>{{ $value->term_name }} {{ $value->term_session }}</td>
                                                    <td>{{ $value->subject_name }}</td>
                                                    <td>
                                                        @if ($value->status == 1)
                                                            <p class="badge badge-success">Active</p>
                                                        @else
                                                            <p class="badge badge-warning">Inactive</p>
                                                        @endif
                                                    </td>



                                                    <td style="min-width: 50px;">
                                                        @if (!empty($alreadyTakenMap[$value->cbt_exam_id]))
                                                            <b>{{ $alreadyTakenMap[$value->cbt_exam_id]->score }}</b>
                                                        @else
                                                            <a href="{{ route('student.cbt.take_cbt', [Request::get('class_id'), Request::get('exam_id'), $value->subject_id, $value->cbt_exam_id]) }}" class="btn btn-info btn-sm">Take Exam</a>
                                                        @endif
                                                    </td>

                                                </tr>

                                            @empty
                                                <tr>
                                                    <td colspan="100%">
                                                        <p style="color: red;">No pending CBT Found for the chosen class and term
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