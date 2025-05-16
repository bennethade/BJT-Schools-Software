@extends('layouts.app')

@section('content')

                <div class="content-wrapper">
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                @if(!empty($getStudent))
                                    <div class="col-sm-9">
                                        <h1><span style="color: blue">{{ $getStudent->last_name }} {{ $getStudent->name }} {{ $getStudent->other_name }}</span>'s CBT Scores</h1>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </section>


                    <section class="content">
                        <div class="container-fluid">
                            <div class="card">

                                @include('_message')


                                <table class="table table-striped">
                                    <thead>
                                        @php
    $id = 1
                                        @endphp
                                        <tr>
                                            <th>S/N</th>
                                            <th>CBT Name</th>
                                            <th>Score</th>
                                            <th>Class</th>
                                            <th>Term</th>
                                            <th>Subject Name</th>
                                            <th>Date Taken</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($getStudentCBT as $value)
                                            <tr>
                                                <td>{{ $id++ }}</td>
                                                <td>{{ $value->cbtExam->exam_title }}</td>
                                                <td>
                                                    @if ($value->score >= 50)
                                                        <p class="badge badge-success">{{ $value->score }}</p>
                                                    @else
                                                        <p class="badge badge-danger">{{ $value->score }}</p>
                                                    @endif
                                                </td>
                                                <td>{{ $value->class->name }} {{ $value->class->description }}</td>
                                                <td>{{ $value->term_name }} {{ $value->term_session }}</td>
                                                <td>{{ $value->cbtExam->subject->name }}</td>
                                                <td>{{ date('d-M-Y', strtotime($value->completed_at)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%" style="text-align: left; color:red">No CBT Exam Taken Yet</td>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </section>




                </div>
@endsection



@section('script')

    <script type="text/javascript">

    </script>

@endsection