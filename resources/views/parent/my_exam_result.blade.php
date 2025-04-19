@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
                <h1><span style="color: blue;"> {{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }}</span> Exam Result</h1>
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
                            <h3 class="card-title" style="color: blue;"> <b>{{ $value['exam_name'] }} {{ $value['exam_session'] }}</b></h3>
                            
                            <a href="{{ url('parent/my_ca_result/print?exam_id=' . $value['exam_id'] . '&student_id='.$getStudent->id) }}" class="btn btn-warning btn-sm" style="float: right; margin-left: 10px;" target="_blank" >C.A Result</a>

                            <a class="btn btn-primary btn-sm" style="float: right;" target="_blank" href="{{ url('parent/my_exam_result/print?exam_id=' . $value['exam_id'] . '&student_id='.$getStudent->id) }}">Exam Result</a>
                        </div>

                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                    <th>Subject Name</th>
                                    <th>CA</th>
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
                                            if(!empty($exam['total_score']))
                                            {
                                                $totalMark = $exam['ca'] + $exam['exam'];
                                            }
    
                                            
                                        @endphp
                                        <tr>
                                            <td style="width: 200px;">{{ $exam['subject_name'] }}</td>
                                            <td>{{ $exam['ca'] }}</td>
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
    
                                            //For Final Grade
                                            $getGrade = App\Models\MarksGrade::getGrade($percentage);
                                        @endphp
                                        <td colspan="2"><b>Percentage : {{ number_format($percentage, 2) }}%</b></td>
                                        <td colspan="2"><b>Final Grade : {{ $getGrade }}</b></td>
    
    
                                        <td colspan="3">
                                            <b>Result : 
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