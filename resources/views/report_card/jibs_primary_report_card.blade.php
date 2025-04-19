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
    
            /* .margin-bottom {
                margin-bottom: 3px;
            } */

            .table-bg {
                border-collapse: collapse;
                width: 100%;
                font-size: 15.3px;
                /* text-align: center; */
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
            
            /* .text-container {
                text-align: left;
                padding-left: 5px;
            } */
    
            @media print {
                @page {
                    margin: 0px;
                    margin-left: 20px;
                    margin-right: 20px;
                }
            }
            

            body {
                position: relative;
            }

            body::before {
                content: "";
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background-image: url('{{ $getSetting->getLogo() }}');
                background-repeat: no-repeat;
                background-position: center;
                background-size: cover;
                opacity: 0.2; /* Adjust the opacity to make the background image faint */
                z-index: -1; /* Ensures the watermark stays in the background */
            }
        </style> 

    </head>
    <body style="margin: 10px; border: 3px solid black">

        <table class="text-align: center;">
            <thead>
                <tr style="width: 100%; text-align: center;">
                    <th width="15%" valign="top"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                    <th width="70%">
                        <h1 style="font-size:34px; font-weight: 700; text-transform: uppercase">{!! $getSetting->school_name !!}</h1>
                        <h5 style="font-size:25px; font-weight: 500;">{!! $getSetting->school_address !!}</h5>
                        <h5>{{ $getSetting->school_website }}  |  {{ $getSetting->school_phone_1 }}</h5>
                        <h4>End of Term Report</h4>
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
        <hr>



        <div>
            <h4 style="font-weight: 400">Name: {{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }}</h4>
            <h4 style="font-weight: 400;">Class: {{ $getClass->description }} ({{ $getClass->class_name }})</h4>
            
            <h4 style="font-weight: 400;">DoB: {{ $getStudent->date_of_birth }} | {{ $getExam->name }} | {{ $getExam->session }} Session</h4>



                @php
                    $total_score = 0;
                    $full_mark = 0;
                    $totalPassMark = 0;
                @endphp

                @if($full_mark != 0)
                    @php
                        $percentage = ($total_score * 100) / $full_mark;
                        $getGrade = App\Models\MarksGrade::getGrade($percentage);
                    @endphp 
                @endif

                @foreach ($getExamMark as $exam)
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

                    </tr>
                @endforeach

            <div>
                <div class="float-left">
                    <h4 style="font-weight: 400; color:#007bff">Total Scores: Marks Obtainable: {{ $full_mark }}</h4>
                </div>

                <div class="float-right">
                    @if ($getSubjectCount > 0)
                        <h4 style="font-weight: 400; color:#007bff">Marks Obtained: {{ $total_score }} | Student’s Average: {{ number_format($total_score/$getSubjectCount, 1) }}</h4>    
                    @endif
                    
                </div>
            </div>

            <div>
                <div class="float-left">
                    <h4 style="font-weight: 400">Form Tutor: {{ $getClassTeacher->last_name }} {{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->other_name }}</h4>
                </div>
                <div class="float-right">
                    <h4 style="font-weight: 400; color:red;">
                        @php
                            use Carbon\Carbon;
                        @endphp

                        Next Term Resumes: {{ Carbon::parse($getExam->next_term_begins)->format('l jS F Y') }}

                    </h4>
                </div>
            </div>

        </div>


        <table class="table-bg score-table" style="width:100%; border: 1px solid #000;">
           <thead>
                <tr style="text-align: center">
                    <th width="15%" class="score-table">Subject</th>
                    <th width="7%" class="score-table">CA</th>
                    <th width="7%" class="score-table">Exam</th>
                    <th width="7%" class="score-table">Total</th>
                    <th width="7%" class="score-table">Grade</th>
                    <th width="7%" class="score-table">Highest Score</th>
                    <th width="7%" class="score-table">Lowest Score</th>
                    <th width="" class="score-table">Comment</th>
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
                            $totalMark = $exam['ca'] + $exam['home_fun'] + $exam['attendance'] + $exam['class_work'] + $exam['ca2'] + $exam['exam'];

                            $totalCA = $exam['ca'] + $exam['home_fun'] + $exam['attendance'] + $exam['class_work'] + $exam['ca2'];
                        }
                    @endphp



                    <tr>
                        <th class="score-table">{{ $exam['subject_name'] }}</th>
                        <td style="text-align: center" class="score-table">{{ $totalCA }}</td>
                        <td style="text-align: center" class=" td score-table">{{ $exam['exam'] }}</td>
                        <td style="text-align: center" class=" td score-table">{{ $exam['total_score'] }}</td>

                        <td style="text-align: center" class="score-table">
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

                        <td style="text-align: center" class="score-table">
                            @if (isset($subjectHighestScores[$exam['subject_id']]))
                                {{ $subjectHighestScores[$exam['subject_id']] }}
                            @endif
                        </td>
                        
                        <td style="text-align: center" class="score-table">
                            @if (isset($subjectLowestScores[$exam['subject_id']]))
                                {{ $subjectLowestScores[$exam['subject_id']] }}
                            @endif
                        </td>
                        
                        <td class="score-table">{!! $exam['teacher_remark'] !!}</td>
                    </tr>
                @endforeach

           </tbody>
        </table>


        <p style="color: red">Key: A+:90-100  |  A:75-89  |  B:65-74  |  C:50-64  |  D:45-49  |  E:40-44  |  F:0-39</p>
        <hr>
        <p>Behavioral Analysis <span style="color: red">(Lowest: 1, Highest: 5)</span></p>


        <table class="table-bg score-table" style="width:100%; border: 1px solid #000;">
            <thead>
                <tr style="text-align: center">
                    <th class="score-table">Behavior</th>
                    <th class="score-table">Rating</th>
                    <th class="score-table">Behavior</th>
                    <th class="score-table">Rating</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($getBehaviorChart as $value)
                
                    <tr>
                        <td class="score-table">Generosity</td>
                        <td style="text-align: center" class="score-table">{{ $value->generosity }}</td>
                        <td class="score-table">Punctuality</td>
                        <td style="text-align: center" class="score-table">{{ $value->punctuality }}</td>
                    </tr>

                    <tr>
                        <td class="score-table">Class Attendance</td>
                        <td style="text-align: center" class="score-table">{{ $value->class_attendance }}</td>
                        <td class="score-table">Responsibility in Assignments</td>
                        <td style="text-align: center" class="score-table">{{ $value->responsibility_in_assignments }}</td>
                    </tr>

                    <tr>
                        <td class="score-table">Attentiveness</td>
                        <td style="text-align: center" class="score-table">{{ $value->attentiveness }}</td>
                        <td class="score-table">Initiative</td>
                        <td style="text-align: center" class="score-table">{{ $value->initiative }}</td>
                    </tr>

                    <tr>
                        <td class="score-table">Neatness</td>
                        <td style="text-align: center" class="score-table">{{ $value->neatness }}</td>
                        <td class="score-table">Self-Control</td>
                        <td style="text-align: center" class="score-table">{{ $value->self_control }}</td>
                    </tr>

                    <tr>
                        <td class="score-table">Relationship With Staff</td>
                        <td style="text-align: center" class="score-table">{{ $value->relationship_with_staff }}</td>
                        <td class="score-table">Relationship With Students</td>
                        <td style="text-align: center" class="score-table">{{ $value->relationship_with_students }}</td>
                    </tr>
                    
                @endforeach
            </tbody>

        </table>

        <table class="table-bg score-table" style="width:100%; border: 1px solid #000;">
            <thead>
                <tr style="text-align: center">
                    <th colspan="4" class="score-table">Merits/Demerits or Detention</th>
                </tr>
                <tr>
                    <th class="score-table">Event</th>
                    <th class="score-table">Number of occurrences</th>
                    <th class="score-table">Event</th>
                    <th class="score-table">Number of occurrences</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($getBehaviorChart as $value)
                    <tr>
                        <td class="score-table">Merits</td>
                        <td class="score-table">{{ $value->merits }}</td>
                        <td class="score-table">Demerits/Detention</td>
                        <td class="score-table">{{ $value->demerits_detention }}</td>
                    </tr>
                @endforeach 
            </tbody>
        </table>

        @foreach ($getBehaviorChart as $value)
            <h5 style="color: red; padding-top:10px;">CLASS TUTOR'S COMMENT: {!! $value->class_tutor_comment !!}
        @endforeach

        <h5 style="color: red; padding-top:7px;">HEAD TEACHER’S SIGNATURE: <img src="{{ asset('upload/ht_signature.png') }}" alt="" style="width: 150px"></h5>








        <script type="text/javascript">
            window.print();
        </script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>