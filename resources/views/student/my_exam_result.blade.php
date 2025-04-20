@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
       <!-- Content Header (Page header) -->
       <section class="content-header">
          <div class="container-fluid">
             <div class="row mb-2">
                <div class="col-sm-6">
                   <h1>My Exam Result</h1>
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

                @foreach ($getRecord as $value)
                                                <div class="col-md-12">
                                                    <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title" style="color: blue;"> <b>{{ $value['exam_class'] }} {{ $value['exam_name'] }} {{ $value['exam_session'] }}</b></h3>

                                                        @if ($value['exam_name'] == 'Term 3')
                                                            <a class="btn btn-info btn-sm float-right" style="background: #ec24a0; color: white; margin-left: 5px;" target="_blank" href="{{ url('student/cumulative_exam_result/print?class_id=' . Request::get('class_id') . '&exam_id=' . $value['exam_id'] . '&student_id=' . Auth::user()->id) }}">Print Cumulative Result</a>
                                                        @endif

                                                        <a class="btn btn-primary btn-sm" style="float: right;" target="_blank"
                                                            href="{{ url('student/my_exam_result/print?exam_id=' . $value['exam_id'] . '&student_id=' . Auth::user()->id) }}">Exam Result</a>

                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body p-0" style="overflow: auto;">
                                                        <table class="table table-striped">
                                                            <thead>
                                                                <tr>
                                                                <th>Subject Name</th>
                                                                <th>CA</th>
                                                                <th>Project</th>
                                                                <th>Exam</th>
                                                                <th>Total Score</th>
                                                                <th>Pass Mark</th>
                                                                <th>Full Mark</th>
                                                                <th>Grade</th>
                                                                <th>Result</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                    $total_score = 0;
                    $full_mark = 0;
                    $totalPassMark = 0;
                                                                @endphp

                                                                @foreach ($value['subject'] as $exam)
                                                                    @php
                                                                        $total_score = $total_score + $exam['total_score'];
                                                                        $full_mark = $full_mark + $exam['full_mark'];
                                                                        $result_validation = 0;
                                                                        $totalPassMark = $totalPassMark + $exam['pass_mark'];


                                                                        //For Subject Grade Computation
                                                                        if (!empty($exam['total_score'])) {
                                                                            $totalMark = $exam['ca'] + $exam['project'] + $exam['exam'];
                                                                        }

                                                                    @endphp
                                                                    <tr>
                                                                        <td style="width: 200px;">{{ $exam['subject_name'] }}</td>
                                                                        <td>{{ $exam['ca'] }}</td>
                                                                        <td>{{ $exam['project'] }}</td>
                                                                        <td>{{ $exam['exam'] }}</td>
                                                                        <td>{{ $exam['total_score'] }}</td>
                                                                        <td>{{ $exam['pass_mark'] }}</td>
                                                                        <td>{{ $exam['full_mark'] }}</td>
                                                                        <td>
                                                                            {{-- For Subject Grade --}}
                                                                            @php
                        $getSubjectGrade = App\Models\MarksGrade::getGrade($totalMark);
                                                                            @endphp
                                                                            @if (!empty($getSubjectGrade))
                                                                                {{ $getSubjectGrade }} <br>
                                                                            @endif
                                                                        </td>
                                                                        <td>
                                                                            @if ($exam['total_score'] >= $exam['pass_mark'])
                                                                                <span style="color: green; font-weight: bold;">Pass</span>
                                                                            @else
                                                                                @php
                            $result_validation = 1;
                                                                                @endphp
                                                                                <span style="color: red; font-weight: bold;">Fail</span>
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                @endforeach

                                                                <tr>
                                                                    <td colspan="2"><b>Grand Total: {{ $total_score }}/{{ $full_mark }}</b></td>
                                                                    @php
                    $percentage = ($total_score * 100) / $full_mark;
                    $getGrade = App\Models\MarksGrade::getGrade($percentage);
                                                                    @endphp
                                                                    <td colspan="3"><b>Percentage : {{ number_format($percentage, 2) }}%</b></td>
                                                                    <td colspan="2"><b>Final Grade : {{ $getGrade }}</b></td>

                                                                    <td colspan="3">
                                                                        <b>Final Result : 
                                                                            @if($total_score >= $totalPassMark) 
                                                                                <span style="color: green; font-weight: bold;">Pass</span>
                                                                            @else 
                                                                                <span style="color: red; font-weight: bold;">Fail</span>
                                                                            @endif
                                                                        </b>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    </div>
                                                </div>                
                @endforeach

             </div>
          </div>

       </section>

    </div>
@endsection