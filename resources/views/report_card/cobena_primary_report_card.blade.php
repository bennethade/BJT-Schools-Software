<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $getStudent->last_name }} {{ $getStudent->name }} {{ $getStudent->other_name }} Result</title>
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
                /* margin-bottom: 0px; */
            }

            .table-bg {
                border-collapse: collapse;
                width: 100%;
                font-size: 16px;
                text-align: center;
            }

            .score-table{
                border: 1px solid;
            }

            .th {
                border: 1px solid #000;
                padding: 10px;
                /* padding: 0px; */
            }
            .td {
                border: 1px solid #000;
                padding: 3px;
                /* padding: 0px; */
            }
            
            .text-container {
                text-align: left;
                padding-left: 5px;
            }
    
            @media print {
                @page {
                    /* margin: 0px; */
                    margin-top: 20px;
                    margin-left: 20px;
                    margin-right: 20px;
                }
            }

            body {
                position: relative;
            }

            body::before {
                content: "";
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ $getSetting->getLogo() }}');
                background-repeat: no-repeat;
                background-position: center;
                background-size: contain;
                opacity: 0.2; /* Adjust the opacity to make the background image faint */
                z-index: -1; /* Ensures the watermark stays in the background */
                pointer-events: none; /* Ensures the watermark is not interactable */
            }

            .page-break {
                page-break-before: always; /* Forces a page break before the element */
            }

        </style>

    </head>
    <body style="margin: 10px;">

        <table class="text-align: center;" style="border-top: 2px solid black; border-left: 2px solid black; border-right: 2px solid black">
            <thead>
                <tr style="width: 100%; text-align: center;">
                    <th width="15%"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                    <th width="60%">
                        <h1 style="font-weight: 900; color:red; font-size:50px">{!! $getSetting->school_name !!} </h1>
                        <h5 style="font-weight: 650;">{!! $getSetting->school_address !!}</h5>

                        {{-- <h5 style="font-weight: 650; text-transform: uppercase;">@if (!empty($getClass->section)) {{ $getClass->section }}@endif</h5> --}}
                        
                        <h5 style="font-weight: 650;">Progress Report Sheet For {{ $getExam->name }} {{ $getExam->session }} Academic Session</h5>
                        {{-- <h5 style="font-weight: 650; text-transform: uppercase;">{{ $getExam->name }} {{ $getExam->session }} Academic Session</h5> --}}
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
        

        <div style="padding-top:15px; border-left: 2px solid black; border-right: 2px solid black">
            <table class="margin-bottom" style="width: 100%">
                <tr style="width: 100%; text-align: left;">
                    <th style="border-bottom: 1px solid; width: 40%;">Name: {{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }}</th>
                    <th style="border-bottom: 1px solid; width: 20%;">Class: @if (!empty($getClass->class_name)) {{ $getClass->class_name }}@endif </th>
                    <th style="border-bottom: 1px solid; width: 30%;">Admission Number: {{ $getStudent->admission_number }} </th>
                    <th style="border-bottom: 1px solid; width: 10%;">Age: {{ $integerAge }} </th>
                    {{-- <th width="10%">Age: {{ $getStudent->date_of_birth }}</th> --}}
                </tr>
            </table>

            <table class="margin-bottom" style="width: 100%">
                <tr>
                    <!--<th style="border-bottom: 1px solid; width: 20%;">Weight: {{ $getStudent->weight }} </th>-->
                    <!--<th style="border-bottom: 1px solid; width: 20%;">Height: {{ $getStudent->height }} </th>-->
                    <th style="border-bottom: 1px solid; width: 30%;">This Term Commenced: {{ date('d-m-Y', strtotime($getExam->this_term_commenced)) }}</th>
                    <th style="border-bottom: 1px solid; width: 30%;">This Term Ends: {{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}</th>
                    <th style="border-bottom: 1px solid; width: 30%;">Next Term Begins: {{ date('d-m-Y', strtotime($getExam->next_term_begins)) }}</th>
                </tr>
            </table>

            <table class="margin-bottom" style="width: 100%">
                @foreach ($getBehaviorChart as $value)
                    <tr>
                        <th style="border-bottom: 1px solid; width: 30%;">Number of Times School Opened: {{ $getExam->no_of_times_school_opened }}</th>
                        <th style="border-bottom: 1px solid; width: 30%;">Number of Times Present: {{ $value->number_of_times_present }}</th>
                        <th style="border-bottom: 1px solid; width: 30%;">Number of Times Absent: 
                            @php
                                $number_of_times_absent = ($getExam->no_of_times_school_opened - $value->number_of_times_present);
                            @endphp
                            
                            @if(!empty( $number_of_times_absent ))
                                {{ $number_of_times_absent }}
                            @endif
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>

            {{-- <div class="container">
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
            </div> --}}

            {{-- <br> --}}

            <div style="padding-top:20px; border-left: 2px solid black; border-right: 2px solid black; border-bottom:2px solid black;">

                <div class="container">
                    <div class="row">
                        <div class="column">
                            <b style="text-align: left;">COGNITIVE ABILITY</b>
                        </div>
                    </div>
                </div>

                <table class="table-bg score-table" style="width:100%; border: 1px solid #000; font-weight:bold;">

                    <thead>
                        <tr>
                            <th class="score-table" scope="col">SUBJECT</th>
                            <th class="score-table" scope="col">1<sup>st</sup> TERM <br> C.A</th>
                            <th class="score-table" scope="col">PROJECT</th>
                            <th class="score-table" scope="col">EXAM</th>
                            <th class="score-table" scope="col">1<sup>st</sup> TERM <br>TOTAL </th>
                            <th class="score-table" scope="col">GRADE</th>
                            <th class="score-table" scope="col">HIGHEST <br> SCORE</th>
                            <th class="score-table" scope="col">LOWEST <br> SCORE</th>
                            {{-- <th class="score-table" scope="col">AVERAGE CLASS <br> SCORE</th> --}}
                            <th class="score-table" scope="col">TEACHER'S COMMENT</th>
                        </tr>
                        
                        <tr>
                            <th class="score-table">MAXIMUM SCORE</th>
                            <th class="score-table">30</th>
                            <th class="score-table">10</th>
                            <th class="score-table">60</th>
                            <th class="score-table">100</th>
                            <th class="score-table">A+</th>
                            <th class="score-table"></th>
                            <th class="score-table"></th>
                            {{-- <th class="score-table">100</th> --}}
                            <th class="score-table"></th>
                        </tr>
                    </thead>


                    

                    <tbody>

                        @php
                            $total_score = 0;
                            $full_mark = 0;
                            $totalPassMark = 0;
                            
                            $subjectsPassed = 0; // Counter for passed subjects
                            $subjectsFailed = 0; // Counter for failed subjects
                        
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
                                $totalMark = $exam['ca'] + $exam['project'] + $exam['exam'];
                            }
                            
                            if ($exam['total_score'] >= $exam['pass_mark']) {
                                $subjectsPassed++;
                            } else {
                                $subjectsFailed++;
                            }

                        @endphp
                        <tr>
                            <td class="score-table" style="text-align:left;" scope="row">{{ $exam['subject_name'] }}</td>
                            <td class="td score-table">{{ $exam['ca'] }}</td>
                            <td class="td score-table">{{ $exam['project'] }}</td>
                            <td class="td score-table">{{ $exam['exam'] }}</td>
                            <td class="td score-table">{{ $exam['total_score'] }}</td>

                            <td class="td score-table">
                                {{-- For Subject Grade --}}
                                @php
                                    $getSubjectGrade = App\Models\MarksGrade::getGrade($totalMark);
                                @endphp
                                @if (!empty($getSubjectGrade))
                                    @if( $getSubjectGrade == 'F' )
                                        <span style="color:red">{{ $getSubjectGrade }}</span>
                                    @else
                                        {{ $getSubjectGrade }}
                                    @endif
                                @endif

                            </td>
                            
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

                            {{-- <td class="td score-table">AVG</td> --}}

                            
                            
                            {{-- <td class="td score-table">{{ $exam['full_mark'] }}</td> --}}
                            <!--<td class="td score-table">Position</td>-->
                            
                            
                        {{-- <td class="score-table" style="text-align: left">{!! $exam['teacher_remark'] !!}</td> --}}
                        
                        <td class="score-table" style="text-align: left">
                            @if($exam['total_score'] >= 96)
                                <p>Exceptional Performance</p>
                            @elseif($exam['total_score'] >= 91)
                                <p>Working at expected level</p>
                            @elseif($exam['total_score'] >= 80)
                                <p>Skilled performance working towards Meeting expected level</p>
                            @elseif($exam['total_score'] >= 70)
                                <p>Good Performance</p>
                            @elseif($exam['total_score'] >= 60)
                                <p>Satisfactory performance</p>
                            @elseif($exam['total_score'] >= 50)
                                <p>Working below expected level</p>
                            @else 
                                <p>Unacceptable Performance</p>
                            @endif
                            
                        </td>
                        
                        </tr>
                    @endforeach
                    
                    @if($full_mark != 0)
                        @php
                            $percentage = ($total_score * 100) / $full_mark;
                            $getGrade = App\Models\MarksGrade::getGrade($percentage);
                        @endphp 
                    @endif

                    <tr>
                        <td class="td score-table" colspan="3"><b>GRAND TOTAL: {{ $total_score }}/{{ $full_mark }}</b></td>
                        
                        <td class="td score-table" colspan="3"><b>OVERALL AVERAGE : {{ number_format($percentage, 2) }}%</b></td>
                        <td class="td score-table" colspan="2"><b>OVERALL GRADE : {{ $getGrade }}</b></td>

                        <td class="td score-table" colspan="2">
                            <b> 
                                @if($total_score >= $totalPassMark) 
                                    <span style="color: green; font-weight: bold;">GOOD PERFORMANCE</span>
                                @else 
                                    <span style="color: red; font-weight: bold;">Fail</span>
                                @endif
                            </b>
                        </td>
                    </tr>
                    
                    <tr>
                        <th class="th score-table" colspan="6">NUMBER OF SUBJECTS PASSED: {{ $subjectsPassed }}</th>
                        <th class="th score-table" colspan="6">NUMBER OF SUBJECTS FAILED: {{ $subjectsFailed }}</th>
                    </tr>
                        
                        
                    </tbody>
                </table>
                
            </div>

            

            {{-- PAGE BREAK --}}
            <div class="page-break"></div>
            


            @foreach ($getBehaviorChart as $value)


                <div style="border: 3px solid; padding: 30px 3px 30px 3px; margin-top:5px;">
                    
                    <div class="container">
                        <div class="row">
                            <div class="column col-sm-6" style="margin-right: 5px;">
                                <b>GRADING SCALE</b>
                                <table style="padding: 1px; border: 1px solid #000; font-weight:bold;">
                                    <thead>
                                        <tr>
                                            <th class="score-table" style="border: 1px solid; width: 40%">RANGE OF SCORES</th>
                                            <th class="th score-table" width="40px" style="border: 1px solid;">GRADE</th>
                                            <th class="th score-table" width="40px" style="border: 1px solid;">REMARK</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <td class="td score-table">96-100</td>
                                            <td class="td score-table" style="text-align:center">A+</td>
                                            <td class="td score-table">Exceptional Performance</td>
                                        </tr>

                                        <tr>
                                            <td class="td score-table">91-95</td>
                                            <td class="td score-table" style="text-align:center">A</td>
                                            <td class="td score-table">Working at expected level</td>
                                        </tr>

                                        <tr>
                                            <td class="td score-table">80-90</td>
                                            <td class="td score-table" style="text-align:center">B+</td>
                                            <td class="td score-table" style="width: 90%">Skilled performance working towards Meeting expected level</td>
                                        </tr>

                                        <tr>
                                            <td class="td score-table">70-79</td>
                                            <td class="td score-table" style="text-align:center">B</td>
                                            <td class="td score-table">Good Performance</td>
                                        </tr>

                                        <tr>
                                            <td class="td score-table">60-69</td>
                                            <td class="td score-table" style="text-align:center">C</td>
                                            <td class="td score-table">Satisfactory performance</td>
                                        </tr>

                                        <tr>
                                            <td class="td score-table">50-59</td>
                                            <td class="td score-table" style="text-align:center">D</td>
                                            <td class="td score-table">Working below expected level</td>
                                        </tr>

                                        <tr>
                                            <td class="td score-table">Below 49.5</td>
                                            <td class="td score-table" style="text-align:center">E</td>
                                            <td class="td score-table">Unacceptable Performance</td>
                                        </tr>
                                    </tbody>
                                    
                                </table>

                            </div>

                            
                            <div class="column" style="margin-left: 10px;">
                                <b>PSYCHOMOTOR SKILLS</b>
                                <table style="padding: 1px; border: 1px solid #000; font-weight:bold;">
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;"></th>
                                        <th class="th score-table" width="40px" style="border: 1px solid;">W</th>
                                        <th class="th score-table" width="40px" style="border: 1px solid;">S</th>
                                        <th class="th score-table" width="40px" style="border: 1px solid;">I</th>
                                        <th class="th score-table" width="40px" style="border: 1px solid;">E</th>
                                        <th class="th score-table" width="40px" style="border: 1px solid;">Remark</th>
                                    </tr>
                                    
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">CREATIVE ACTIVITIES</th>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->creative_activities == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->creative_activities == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->creative_activities == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->creative_activities == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->creative_activities }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">HANDLING TOOLS </th>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handling_tools == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handling_tools == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handling_tools == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handling_tools == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->handling_tools }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">HANDWRITING</th>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handwriting == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handwriting == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handwriting == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->handwriting == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->handwriting }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">PHYSICAL ACTIVITIES</th>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->physical_activities == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->physical_activities == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->physical_activities == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;"> {!! ($value->physical_activities == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}</td>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->physical_activities }}</td>
                                    </tr>
                                </table>

                            </div>
                            
                            
                            
                            
                            <div class="column col-sm-12">
                                
                                <br>
                                <b>PERSONAL QUALITIES</b>
                                <table style="padding: 1px; border: 1px solid #000; font-weight:bold; width:100%">                                    
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid; width:30%;">ATTITUDES</th>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->attitudes }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">VALUE SYSTEM</th>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->value_system }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">INTEREST & APPRECIATION</th>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->interest_and_appreciation }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">INTER-PERSONAL RELATIONSHIP</th>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->inter_personal_relationship }}</td>
                                    </tr>
                                    <tr>
                                        <th class="th score-table" style="border: 1px solid;">EMOTIONAL ADJUSTMENT</th>
                                        <td class="td score-table" style="border: 1px solid;">{{ $value->emotional_adjustment }}</td>
                                    </tr>
                                </table>
                            </div>
                            
                            
                            

                            <div class="column" style="margin-right: 10px; margin-top:10px; padding:5px; font-size:20px;">
                                
                                <br>
                                
                                <div style="background-color: #fcd5b4; border: 1px solid; width: 100%; margin-bottom:10px; padding:10px">
                                    <b>
                                        CLASS TEACHER’S REMARKS:  {{ $value->class_tutor_comment }} 
                                        <br>
                                        <br>
                                        CLASS TEACHER'S NAME: @if(!empty($getClassTeacher)){{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }}@endif    <span class="float-right" style="margin-right: 10px;">{{ date('d-M-Y', strtotime($getExam->this_term_ends)) }}</span>
                                    </b>
                                </div>
                                
                                <br>
                            
                                <div style="background-color: rgb(167, 190, 167); border: 1px solid; width: 100%; padding:10px">
                                    <b>
                                        HEADTEACHER’S REMARKS: {{ $value->head_teacher_remark }} 
                                        <br>
                                        <br>
                                        @if (!empty($getHeadTeacher))
                                            Head Teacher's Name: {{ $getHeadTeacher->name }} {{ $getHeadTeacher->last_name }} {{ $getHeadTeacher->other_name }}     <span class="float-right" style="margin-right: 10px;">{{ date('d-M-Y', strtotime($getExam->this_term_ends)) }}</span>
                                        @endif
                                    </b>
                                </div>
                            </div>
        
                        </div>
                    </div>
                    
                </div>
            @endforeach


            @if ($getExam->name == "Term 1")
                @if($getStudent->religion == "Christian")
                    <br><br>
    
                    <center>
                        <h4 style="color: red; font-family:cursive">COBENA <span style="color: green"> IS WISHIHG YOU A MERRY CHRISTMAS </span> <span style="color: red"> & </span> <span style="color: green"> A PROSPEROUS NEW YEAR </span></h4>
                        <img src="{{ asset('upload/christmas_bell_2.png') }}" alt="Christmas Bell" width="500px">
                    </center>
                @endif
            @endif




            
            


      
        




      
        

        <script type="text/javascript">
            window.print();
        </script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>