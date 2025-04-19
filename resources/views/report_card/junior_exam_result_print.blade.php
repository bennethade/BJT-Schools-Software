<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }} Result</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

        <style>
            @page {
                size: 8.3in 11.7in;
            }
            @page {
                size: A4;
            }
    
            .margin-bottom {
                margin-bottom: 3px;
            }

            .table-bg {
                border-collapse: collapse;
                width: 100%;
                font-size: 15px;
                text-align: center;
            }

            .score-table{
                border: 1px solid;
            }

            .th {
                border: 1px solid #000;
                padding: 10px;
            }
            .td {
                border: 1px solid #000;
                padding: 3px;
            }
            
            .text-container {
                text-align: left;
                padding-left: 5px;
            }
    
            @media print {
                @page {
                    margin: 0px;
                    margin-left: 20px;
                    margin-right: 20px;
                }
            }
        </style>

    </head>
    <body style="margin: 10px; border: 3px solid black">

        <table class="text-align: center;">
            <thead>
                <tr style="width: 100%; text-align: center;">
                    <th width="15%"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                    <th width="60%">
                        <h1 style="font-weight: 900">{!! $getSetting->school_name !!} </h1>
                        <h5 style="font-weight: 650; text-transform: uppercase;">@if (!empty($getClass->section)) {{ $getClass->section }}@endif</h5>
                        <h5 style="font-weight: 650">PROGRESS REPORT SHEET</h5>
                        <h5 style="font-weight: 650; text-transform: uppercase;">{{ $getExam->name }} {{ $getExam->session }}</h5>
                    </th>
                    <th width="15%" valign="top">
                        <img src="{{ $getStudent->getProfileDirect() }}" style="border-radius: 6px; height: 100px; width: 100px;" alt="">
                        <br>Gender: {{ $getStudent->gender }}
                    </th>
                </tr>

            </thead>

            <tbody> 

            </tbody>
        </table>

        <br>

        <table class="margin-bottom" style="width: 100%">
            <tr style="width: 100%; text-align: left;">
                <th style="border-bottom: 1px solid; width: 50%;">Name: {{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }}</th>
                <th style="border-bottom: 1px solid; width: 30%;">Class: @if (!empty($getClass->class_name)) {{ $getClass->class_name }}@endif </th>
                <!--<th style="border-bottom: 1px solid; width: 20%;">Age: {{ $integerAge }} </th>-->
                {{-- <th width="10%">Age: {{ $getStudent->date_of_birth }}</th> --}}
            </tr>
        </table>

        <table class="margin-bottom" style="width: 100%">
            <tr>
                <!--<th style="border-bottom: 1px solid; width: 20%;">Weight: {{ $getStudent->weight }} </th>-->
                <!--<th style="border-bottom: 1px solid; width: 20%;">Height: {{ $getStudent->height }} </th>-->
                <th style="border-bottom: 1px solid; width: 30%;">This Term Ends: {{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}</th>
                <th style="border-bottom: 1px solid; width: 30%;">Next Term Begins: {{ date('d-m-Y', strtotime($getExam->next_term_begins)) }}</th>
            </tr>

            <tbody> 

            </tbody>
        </table>

            <div class="container">
                <div class="row">
                    <div class="column" style="margin-right: 100px;">
                        <b>1. ATTENDANCE</b>
                        <table class="" style="padding: 1px; border: 1px solid #000;">
                            <tr>
                                <th style="border: 1px solid;">Number of Times School Opened</th>
                                <td style="border: 1px solid;">{{ $getExam->no_of_times_school_opened }}</td>
                            </tr>

                            @foreach ($getBehaviorChart as $value)
                                <tr>
                                    <th style="border: 1px solid;">Number of Times Present</th>
                                    <td style="border: 1px solid;">{{ $value->number_of_times_present }}</td>
                                </tr>
                                <tr>
                                    <th style="border: 1px solid;">Number of Times Absent</th>
                                    <!--<td style="border: 1px solid;">{{ $value->number_of_times_absent }}</td>-->
                                    <td style="border: 1px solid;">
                                        @php
                                            $number_of_times_absent = ($getExam->no_of_times_school_opened - $value->number_of_times_present);
                                        @endphp
                                        
                                        @if(!empty( $number_of_times_absent ))
                                            {{ $number_of_times_absent }}
                                        @endif
                                    </td>
                                     
                                </tr>
                            @endforeach
                            
                        </table>
                    </div>
                    <div class="column" style="margin-left: 100px;">
                        <br/>
                        <table class="" style="padding: 1px;">
                            
                            @foreach ($getBehaviorChart as $value)   
                                <tr>
                                    <th style="border-bottom: 1px solid; width: 100%;">School House: {{ $value->school_house }}</th>
                                </tr>
                            @endforeach

                            <tr>
                                <th style="border-bottom: 1px solid; width: 100%;">Class Teacher's Name: @if(!empty($getClassTeacher)){{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }}@endif</th>
                            </tr>
                        </table>
                    </div>
                </div>   
            </div>


            <div class="container">
                <div class="row">
                    <div class="column">
                        <b style="text-align: left;">2. COGNITIVE ABILITY</b>
                    </div>
                </div>
            </div>

            <div>
                <table class="table-bg score-table" style="width:100%; border: 1px solid #000; font-weight:bold;">
                    <thead>
                        <tr>
                            <th rowspan="2" class="score-table" scope="col">SUBJECTS</th>
                            <th colspan="2" class="score-table" scope="col">CONTINUOUS <br> ASSESSMENT</th>
                            <th rowspan="2" class="score-table" scope="col" style="transform: rotate(-90deg);">EXAM <br> (60%) </th>
                            <th rowspan="2" class="score-table" scope="col" style="transform: rotate(-90deg);">TOTAL <br>(100%)</th>
                            <th rowspan="2" class="score-table" scope="col" style="transform: rotate(-90deg);">HIGHEST <br>SCORE</th>
                            <th rowspan="2" class="score-table" scope="col" style="transform: rotate(-90deg);">LOWEST <br>SCORE</th>
                            <th colspan="3" class="score-table" scope="col"></th>
                        </tr>

                        <tr>
                            <th class="score-table">CA1 <br/> 20%</th>
                            <th class="score-table">CA2 <br> 20%</th>
                            <th class="score-table">GRADE</th>
                            <!--<th class="score-table">POSITION</th>-->
                            <th class="score-table">TEACHER'S REMARK</th>
                        </tr>
                    </thead>

                    <tbody>

                        @php
                            $total_score = 0;
                            $full_mark = 0;
                            $totalPassMark = 0;
                        @endphp
                    
                    @foreach ($getExamMark as $exam)
                        @php
                            $total_score = $total_score + $exam['total_score'];
                            $full_mark = $full_mark + $exam['full_mark'];
                            $result_validation = 0;
                            $totalPassMark = $totalPassMark + $exam['pass_mark'];


                            //For Subject Grade Computation
                            if(!empty($exam['total_score']))
                            {
                                $totalMark = $exam['ca1']  + $exam['ca2'] + $exam['exam'];
                            }

                        @endphp
                        <tr>
                            <td class="score-table" style="text-align:left;" scope="row">{{ $exam['subject_name'] }}</td>
                            <td class="td score-table">{{ $exam['ca1'] }}</td>
                            <td class="td score-table">{{ $exam['ca2'] }}</td>
                            <td class="td score-table">{{ $exam['exam'] }}</td>
                            <td class="td score-table">{{ $exam['total_score'] }}</td>
                            
                            <td class="td score-table">
                                @if (isset($subjectHighestScores[$exam['subject_id']]))
                                    {{ $subjectHighestScores[$exam['subject_id']] }}
                                @endif
                            </td>

                            <td class="td score-table">
                                @if (isset($subjectLowestScores[$exam['subject_id']]))
                                    {{ $subjectLowestScores[$exam['subject_id']] }}
                                @endif
                            </td>
                            
                            <td class="td score-table">
                                {{-- For Subject Grade --}}
                                @php
                                   $getSubjectGrade = App\Models\MarksGrade::getGrade($totalMark);
                                @endphp
                                @if (!empty($getSubjectGrade))
                                    <!--{{ $getSubjectGrade }} <br>-->
                                    @if( $getSubjectGrade == 'F' )
                                        <span style="color:red">{{ $getSubjectGrade }}</span>
                                    @else
                                        {{ $getSubjectGrade }}
                                    @endif
                                @endif

                            </td>
                            
                            {{-- <td class="td score-table">{{ $exam['full_mark'] }}</td> --}}
                            <!--<td class="td score-table">Position</td>-->
                            
                            <td class="td score-table">
                                @if ($exam['total_score'] >= 70)
                                    Excellent
                                @elseif ($exam['total_score'] >= 60)
                                    Very Good
                                @elseif ($exam['total_score'] >= 50)
                                    Credit
                                @elseif ($exam['total_score'] >= 40)
                                    Pass
                                @else
                                    <span style="color:red">Fail</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    
                    <!--@if($full_mark != 0)-->
                    <!--    @php-->
                    <!--        $percentage = ($total_score * 100) / $full_mark;-->
                    <!--        $getGrade = App\Models\MarksGrade::getGrade($percentage);-->
                    <!--    @endphp -->
                    <!--@endif-->

                    {{-- <tr>
                        <td class="td" colspan="2"><b>Grand Total: {{ $total_score }}/{{ $full_mark }}</b></td>
                        
                        <!--<td class="td" colspan="2"><b>Percentage : {{ number_format($percentage, 2) }}%</b></td>-->
                        <!--<td class="td" colspan="2"><b>Final Grade : {{ $getGrade }}</b></td>-->

                        <td class="td" colspan="4">
                            <b>Result : 
                                @if($total_score >= $totalPassMark) 
                                    <span style="color: green; font-weight: bold;">Pass</span>
                                @else 
                                    <span style="color: red; font-weight: bold;">Fail</span>
                                @endif
                            </b>
                        </td>
                    </tr> --}}
                        
                        
                    </tbody>
                </table>
                
            </div>

            @foreach ($getBehaviorChart as $value)


                <div style="border: 5px solid; padding: 5px; margin-top:5px;">
                    
                    <div class="container">
                        <div class="row">
                            <div class="column col-sm-6" style="margin-right: 10px;">
                                <b>3. PSYCHOMOTO SKILLS</b>
                                <table class="" style="padding: 1px; border: 1px solid #000;">
                                    <tr>
                                        <th style="border: 1px solid;"></th>
                                        <th width="40px" style="border: 1px solid;">5</th>
                                        <th width="40px" style="border: 1px solid;">4</th>
                                        <th width="40px" style="border: 1px solid;">3</th>
                                        <th width="40px" style="border: 1px solid;">2</th>
                                        <th width="40px" style="border: 1px solid;">1</th>
                                    </tr>
                                    <tr>
                                        @php
                                            $getBehaviorChart = App\Models\BehaviorChart::getBehaviorChart($getStudent, $getExam, $getClass);
                                        @endphp
                                        <th style="border: 1px solid;">Creative Activities</th>
                                        <td style="border: 1px solid;"> {!! ($value->creative_activities == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->creative_activities == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->creative_activities == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->creative_activities == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->creative_activities == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Hand Writing</th>
                                        <td style="border: 1px solid;"> {!! ($value->hand_writing == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->hand_writing == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->hand_writing == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->hand_writing == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->hand_writing == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Games/Sports</th>
                                        <td style="border: 1px solid;"> {!! ($value->games_sports == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->games_sports == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->games_sports == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->games_sports == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->games_sports == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Handling of Tools</th>
                                        <td style="border: 1px solid;"> {!! ($value->handling_of_tools == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->handling_of_tools == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->handling_of_tools == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->handling_of_tools == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->handling_of_tools == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Musical Skills</th>
                                        <td style="border: 1px solid;"> {!! ($value->musical_skills == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->musical_skills == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->musical_skills == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->musical_skills == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->musical_skills == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                </table>

                                
                                {{-- <table class="" style="padding: 1px; border: 1px solid #000;">
                                    
                                    <tr>
                                        <th style="border: 1px solid;">Grand Total:</th>
                                        <td style="border: 1px solid;">{{ $total_score }}</td>
                                        <td style="padding: 20px;"></td>
                                        <th style="border: 1px solid;">Average: </th>
                                        <td style="border: 1px solid;">{{ $total_score }}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Class Average: </th>
                                        <td style="border: 1px solid;">{{ $total_score }}</td>
                                        <td style="border: 1px solid;"></td>
                                        <td style="border: 1px solid;">Position: </td>
                                        <td style="border: 1px solid;">{{ $total_score }} </td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">No. in Class: </th>
                                        <td style="border: 1px solid;">{{ $total_score }}</td>
                                        <td style="border: 1px solid;"></td>
                                        <td style="border: 1px solid;"></td>
                                        <td style="border: 1px solid;"></td>
                                    </tr>
                                </table> --}}
                                
                                
                                @if($full_mark != 0)
                                    @php
                                        $percentage = ($total_score * 100) / $full_mark;
                                        $getGrade = App\Models\MarksGrade::getGrade($percentage);
                                    @endphp 
                                @endif

                                    
                                <table class="margin-bottom" style="width: 100%">
                                    <tr>
                                        <th style="border-bottom: 1px solid;">Grand Total: {{ $total_score }} </th>
        
                                        <th style="border-bottom: 1px solid; margin-left: 2px;">Average: {{ number_format($total_score/$getSubjectCount, 1) }} </th>
                                    </tr>
                                    <tr>
                                        <th style="border-bottom: 1px solid;">Class Average: {{ number_format($classAverage) }} </th><br><br>
                                        <!--<th style="border-bottom: 1px solid; margin-left: 2px;">Position: {{ $total_score }} </th>-->
                                        <!--<th style="border-bottom: 1px solid; margin-left: 2px;">Final Grade : @if(!empty( $getGrade )) {{ $getGrade }} @endif </th>-->
                                        
                                        <th style="border-bottom: 1px solid; margin-left: 2px;">
                                            Final Grade:
                                            
                                            @if(!empty($total_score/$getSubjectCount))
                                                @if($total_score/$getSubjectCount >= 70 && $total_score/$getSubjectCount <= 100)
                                                    A
                                                @elseif($total_score/$getSubjectCount >= 60 && $total_score/$getSubjectCount <= 69.9)
                                                    B
                                                @elseif($total_score/$getSubjectCount >= 50 && $total_score/$getSubjectCount <= 59.9)
                                                    C
                                                @elseif($total_score/$getSubjectCount >= 40 && $total_score/$getSubjectCount <= 49.9)
                                                    D
                                                @else
                                                    <span style="color:red">F</span>
                                                @endif
                                            @endif
                                        </th>
                                    </tr>
                                    <!--<tr>-->
                                    <!--    <th style="border-bottom: 1px solid;">Number in Class: -->
                                    <!--        @if ($getClass->class_name == 'J.S.S. ONE')-->
                                    <!--            {{ $getExam->jss1_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'J.S.S. TWO')-->
                                    <!--            {{ $getExam->jss2_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'J.S.S. THREE')-->
                                    <!--            {{ $getExam->jss3_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'S.S. ONE')-->
                                    <!--            {{ $getExam->sss1_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'S.S. TWO')-->
                                    <!--            {{ $getExam->sss2_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'S.S. THREE')-->
                                    <!--            {{ $getExam->sss3_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'GRADE ONE')-->
                                    <!--            {{ $getExam->grade1_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'GRADE TWO')-->
                                    <!--            {{ $getExam->grade2_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'GRADE THREE')-->
                                    <!--            {{ $getExam->grade3_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'GRADE FOUR')-->
                                    <!--            {{ $getExam->grade4_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'GRADE FIVE')-->
                                    <!--            {{ $getExam->grade5_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'GRADE SIX')-->
                                    <!--            {{ $getExam->grade6_number }}-->
                                                
                                    <!--        @elseif ($getClass->class_name == 'EXPLORER TWO')-->
                                    <!--            {{ $getExam->explorer2_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'EXPLORER ONE')-->
                                    <!--            {{ $getExam->explorer1_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'PRE-NURSERY')-->
                                    <!--            {{ $getExam->pre_nursery_number }}-->
                                    <!--        @elseif ($getClass->class_name == 'PLAY PEN')-->
                                    <!--            {{ $getExam->play_pen_number }}-->
                                    <!--        @endif-->
                                    <!--    </th>-->
                                    <!--</tr>-->
                                    
                                    <tr>
                                        <!--<th style="border-bottom: 1px solid;">Class Teacher's Remark:  {{ $value->class_teacher_remark }}</th>-->
                                        <!--<th style="border-bottom: 1px solid; width:40%; margin-left: 50px;">Signature/Date:</th> -->
                                        
                                    </tr>
                                    <tr>
                                        <!--<th style="border-bottom: 1px solid; margin-left: 20px;">Signature/Date:</th>-->
                                    </tr>
                                    
                                    
                                </table>
                                
                                <br>
                                <span style="border-bottom: 1px solid; width: 100%;"><b>Class Teacher's Remark:  {{ $value->class_teacher_remark }}</b></span>

                            </div>

                            
                            <div class="column" style="margin-left: 50px;">
                                <b>4. EFFECTIVE DOMAIN</b>
                                <table class="" style="padding: 1px; border: 1px solid #000;">
                                    <tr>
                                        <th style="border: 1px solid;"></th>
                                        <th width="40px" style="border: 1px solid;">5</th>
                                        <th width="40px" style="border: 1px solid;">4</th>
                                        <th width="40px" style="border: 1px solid;">3</th>
                                        <th width="40px" style="border: 1px solid;">2</th>
                                        <th width="40px" style="border: 1px solid;">1</th>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Attentiveness</th>
                                        <td style="border: 1px solid;"> {!! ($value->attentiveness == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attentiveness == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attentiveness == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attentiveness == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attentiveness == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Attitude to school work</th>
                                        <td style="border: 1px solid;"> {!! ($value->attitude_to_school_work == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attitude_to_school_work == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attitude_to_school_work == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attitude_to_school_work == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->attitude_to_school_work == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Emotion stability</th>
                                        <td style="border: 1px solid;"> {!! ($value->emotion_stability == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->emotion_stability == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->emotion_stability == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->emotion_stability == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->emotion_stability == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Initiative</th>
                                        <td style="border: 1px solid;"> {!! ($value->initiative == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->initiative == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->initiative == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->initiative == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->initiative == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Honesty</th>
                                        <td style="border: 1px solid;"> {!! ($value->honesty == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->honesty == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->honesty == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->honesty == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->honesty == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Leadership</th>
                                        <td style="border: 1px solid;"> {!! ($value->leadership == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->leadership == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->leadership == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->leadership == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->leadership == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Neatness</th>
                                        <td style="border: 1px solid;"> {!! ($value->neatness == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->neatness == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->neatness == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->neatness == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->neatness == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Perseverance</th>
                                        <td style="border: 1px solid;"> {!! ($value->perseverance == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->perseverance == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->perseverance == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->perseverance == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->perseverance == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Politeness</th>
                                        <td style="border: 1px solid;"> {!! ($value->politeness == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->politeness == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->politeness == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->politeness == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->politeness == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Punctuality</th>
                                        <td style="border: 1px solid;"> {!! ($value->punctuality == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->punctuality == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->punctuality == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->punctuality == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->punctuality == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Evidence of discipline</th>
                                        <td style="border: 1px solid;"> {!! ($value->evidence_of_discipline == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->evidence_of_discipline == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->evidence_of_discipline == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->evidence_of_discipline == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->evidence_of_discipline == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                    <tr>
                                        <th style="border: 1px solid;">Cooperation with others</th>
                                        <td style="border: 1px solid;"> {!! ($value->cooperation_with_others == 5) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->cooperation_with_others == 4) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->cooperation_with_others == 3) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->cooperation_with_others == 2) ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td style="border: 1px solid;"> {!! ($value->cooperation_with_others == 1) ? "<input type='checkbox' checked>" : '' !!}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="column" style="margin-right: 50px;">
                                <br/>
                                <table class="margin-bottom" style="width: 100%">
                                    <tr>
                                        <!--<th style="border-bottom: 1px solid;">Class Teacher's Remark:  {{ $value->class_teacher_remark }}</th>-->
                                        <!--<th style="border-bottom: 1px solid; width:40%; margin-left: 50px;">Signature/Date:</th>-->
                                        
                                    </tr>
                                    
                                    <tr>
                                        <th style="border-bottom: 1px solid; width: 100%;">Head Teacher's Remark: {{ $value->head_teacher_remark }}</th>
                                    </tr>
                                </table>
                            </div>
        
                        </div>
                    </div>
                    <br>
                </div>
            @endforeach
            


      
        

        <script type="text/javascript">
            window.print();
        </script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>