@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Subject CBT Scores</h1>
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
                                    <label>Class Name:</label>
                                    <select class="form-control" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }}
                                                value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <label>Term Name:</label>
                                    <select class="form-control" name="exam_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getExam as $exam)
                                            <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }}
                                                value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                    <a href="{{ route('teacher.cbt.class_score.view') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- /.col -->
                    <div class="col-md-12">
                        @include('_message')


                        <div class="col-md-12">
                            @if(!empty(Request::get('class_id')) && !empty(Request::get('exam_id')))
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">CBT List</h3>
                                    </div>
                                    <div class="card-body p-0" style="overflow: auto;">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>CBT Name</th>
                                                    <th>Assigned Class and Term</th>
                                                    <th>Subject</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $id = 1;
                                                    @endphp
                                                @if (!empty($getAllWrittenCBT) && !empty($getAllWrittenCBT->count()))
                                                    @forelse ($getAllWrittenCBT as $value)
                                                        <tr>
                                                            <td>{{ $id++ }}</td>
                                                            <td>{{ $value->exam_title }}</td>
                                                            <td>{{ $value->class_name }} - {{ $value->term_name }}
                                                                {{ $value->term_session }}
                                                            </td>
                                                            <td>{{ $value->subject_name }}</td>
                                                            <td>
                                                                <a href="{{ route('teacher.cbt.class_score.list', [Request::get('class_id'), Request::get('exam_id'), $value->cbt_exam_id]) }}" class="btn btn-info">View Scores</a>
                                                            </td>
                                                        </tr>

                                                    @empty

                                                        <td>
                                                            <p>No Record Found For The Chosen Class and Term!</p>
                                                        </td>

                                                    @endforelse

                                                @endif
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