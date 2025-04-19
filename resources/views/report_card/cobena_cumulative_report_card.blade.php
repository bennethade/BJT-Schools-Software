<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $getStudent->last_name }} {{ $getStudent->name }} {{ $getStudent->other_name }} Result</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

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

        .score-table {
            border: 1px solid;
        }

        .th {
            border: 1px solid #000;
            padding: 12px;
            /* padding: 0px; */
        }

        .td {
            border: 1px solid #000;
            padding: 12px;
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
            opacity: 0.2;
            /* Adjust the opacity to make the background image faint */
            z-index: -1;
            /* Ensures the watermark stays in the background */
            pointer-events: none;
            /* Ensures the watermark is not interactable */
        }

        .page-break {
            page-break-before: always;
            /* Forces a page break before the element */
        }
    </style>

</head>

<body style="margin: 10px;">

    <table class="text-align: center;"
        style="border-top: 2px solid black; border-left: 2px solid black; border-right: 2px solid black">
        <thead>
            <tr style="width: 100%; text-align: center;">
                <th width="15%"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                <th width="60%">
                    <h1 style="font-weight: 900; color:red; font-size:50px">{!! $getSetting->school_name !!} </h1>
                    <h5 style="font-weight: 650;">{!! $getSetting->school_address !!}</h5>

                    <h5 style="font-weight: 650;">Cumulative Report Sheet For {{ $getExam->session }} Academic Session</h5>
                </th>
                <th width="15%" valign="top">
                    <img src="{{ $getStudent->getProfileDirect() }}"
                        style="border-radius: 6px; height: 100px; width: 100px;" alt="">
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
                <th style="border-bottom: 1px solid; width: 40%;">Name: {{ $getStudent->name }}
                    {{ $getStudent->other_name }} {{ $getStudent->last_name }}
                </th>
                <th style="border-bottom: 1px solid; width: 20%;">Class: @if (!empty($getClass->class_name))
                {{ $getClass->class_name }}@endif
                </th>
                <th style="border-bottom: 1px solid; width: 30%;">Admission Number: {{ $getStudent->admission_number }}
                </th>
                <th style="border-bottom: 1px solid; width: 10%;">Age: {{ $integerAge }} </th>
                {{-- <th width="10%">Age: {{ $getStudent->date_of_birth }}</th> --}}
            </tr>
        </table>

        <table class="margin-bottom" style="width: 100%">
            <tr>
                <!--<th style="border-bottom: 1px solid; width: 20%;">Weight: {{ $getStudent->weight }} </th>-->
                <!--<th style="border-bottom: 1px solid; width: 20%;">Height: {{ $getStudent->height }} </th>-->
                <th style="border-bottom: 1px solid; width: 30%;">This Term Commenced:
                    {{ date('d-m-Y', strtotime($getExam->this_term_commenced)) }}
                </th>
                <th style="border-bottom: 1px solid; width: 30%;">This Term Ends:
                    {{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}
                </th>
                <th style="border-bottom: 1px solid; width: 30%;">Next Term Begins:
                    {{ date('d-m-Y', strtotime($getExam->next_term_begins)) }}
                </th>
            </tr>
        </table>

        <table class="margin-bottom" style="width: 100%">
            @foreach ($getBehaviorChart as $value)
                        <tr>
                            <th style="border-bottom: 1px solid; width: 30%;">Number of Times School Opened:
                                {{ $getExam->no_of_times_school_opened }}
                            </th>
                            <th style="border-bottom: 1px solid; width: 30%;">Number of Times Present:
                                {{ $value->number_of_times_present }}
                            </th>
                            <th style="border-bottom: 1px solid; width: 30%;">Number of Times Absent:
                                @php
    $number_of_times_absent = ($getExam->no_of_times_school_opened - $value->number_of_times_present);
                                @endphp

                                @if(!empty($number_of_times_absent))
                                    {{ $number_of_times_absent }}
                                @endif
                            </th>
                        </tr>
            @endforeach
        </table>
    </div>

    
    <div
        style="padding-top:20px; border-left: 2px solid black; border-right: 2px solid black; border-bottom:2px solid black;">

        <div class="container">
            <div class="row">
                <div class="column">
                    <b style="text-align: left;">COGNITIVE ABILITY</b>
                </div>
            </div>
        </div>

        <table cellpadding="6" cellspacing="0" class="table-bg score-table"
            style="width:100%; border: 1px solid #000; font-weight:bold;">


            <thead>
                <tr>
                    <th rowspan="2" style="border: 1px solid #444;">SUBJECT</th>
                    <th colspan="4" style="border: 1px solid #444;">TERM 1</th>
                    <th colspan="4" style="border: 1px solid #444;">TERM 2</th>
                    <th colspan="4" style="border: 1px solid #444;">TERM 3</th>
                    <th rowspan="2" style="border: 1px solid #444;">O.T</th>
                    <th rowspan="2" style="border: 1px solid #444;">W.A</th>
                    {{-- <th rowspan="3">Teacher's Comment</th> --}}
                </tr>
                <tr>
                    <th style="border: 1px solid #444;">CA</th>
                    <th style="border: 1px solid #444;">Project</th>
                    <th style="border: 1px solid #444;">Exam</th>
                    <th style="border: 1px solid #444;">Total</th>
                    <th style="border: 1px solid #444;">CA</th>
                    <th style="border: 1px solid #444;">Project</th>
                    <th style="border: 1px solid #444;">Exam</th>
                    <th style="border: 1px solid #444;">Total</th>
                    <th style="border: 1px solid #444;">CA</th>
                    <th style="border: 1px solid #444;">Project</th>
                    <th style="border: 1px solid #444;">Exam</th>
                    <th style="border: 1px solid #444;">Total</th>
                </tr>

                <tr>
                    <th style="border: 1px solid #444;">MAXIMUM SCORE</th>
                    <th style="border: 1px solid #444;">30</th>
                    <th style="border: 1px solid #444;">10</th>
                    <th style="border: 1px solid #444;">60</th>
                    <th style="border: 1px solid #444;">100</th>
                    <th style="border: 1px solid #444;">30</th>
                    <th style="border: 1px solid #444;">10</th>
                    <th style="border: 1px solid #444;">60</th>
                    <th style="border: 1px solid #444;">100</th>
                    <th style="border: 1px solid #444;">30</th>
                    <th style="border: 1px solid #444;">10</th>
                    <th style="border: 1px solid #444;">60</th>
                    <th style="border: 1px solid #444;">100</th>
                    <th style="border: 1px solid #444;">300</th>
                    <th style="border: 1px solid #444;">100.00</th>
                </tr>

            </thead>
            <tbody>
                @foreach($results as $result)
                                    <tr>
                                        <td class="td" style="text-align: left">{{ $result['subject_name'] }}</td>
                                        <td class="td">{{ $result['1st_ca'] }}</td>
                                        <td class="td">{{ $result['1st_project'] }}</td>
                                        <td class="td">{{ $result['1st_exam'] }}</td>
                                        <td class="td">
                                            @php
    $_1st_term_total = $result['1st_ca'] + $result['1st_project'] + $result['1st_exam']
                                            @endphp
                                            {{ $_1st_term_total }}
                                        </td>
                                        <td class="td">{{ $result['2nd_ca'] }}</td>
                                        <td class="td">{{ $result['2nd_project'] }}</td>
                                        <td class="td">{{ $result['2nd_exam'] }}</td>
                                        <td class="td">
                                            @php
    $_2nd_term_total = $result['2nd_ca'] + $result['2nd_project'] + $result['2nd_exam']
                                            @endphp
                                            {{ $_2nd_term_total }}
                                        </td>
                                        <td class="td">{{ $result['3rd_ca'] }}</td>
                                        <td class="td">{{ $result['3rd_project'] }}</td>
                                        <td class="td">{{ $result['3rd_exam'] }}</td>
                                        <td class="td">
                                            @php
    $_3rd_term_total = $result['3rd_ca'] + $result['3rd_project'] + $result['3rd_exam']
                                            @endphp
                                            {{ $_3rd_term_total }}
                                        </td>
                                        <td class="td"><strong>{{ $result['overall_total'] }}</strong></td>
                                        <td class="td"><strong>{{ $result['weighted_average'] }}</strong></td>
                                    </tr>
                @endforeach

                @php
                    $getGrade = App\Models\MarksGrade::getGrade($overallAverage);
                @endphp

                <tr>
                    <td class="td" colspan="3"><strong>GRAND TOTAL: {{ $grandTotal }}</strong></td>
                    <td class="td" colspan="5"><strong>FINAL AVERAGE: {{ $overallAverage }}</strong></td>
                    <td class="td" colspan="3"><strong>FINAL GRADE: {{ $getGrade }}</strong></td>
                    
                    @if ($generalRating > 50)
                        <td class="td" colspan="4" style="text-transform: uppercase; color: green;">{{ $generalRating }}</td>
                    @else
                        <td class="td" colspan="4" style="text-transform: uppercase; color: red;">{{ $generalRating }}</td>
                    @endif

                </tr>
                <tr>
                    <td class="td" colspan="7"><strong>SUBJECTS PASSED: {{ $subjectsPassed }}</strong></td>
                    <td class="td" colspan="8"><strong>SUBJECTS FAILED: {{ $subjectsFailed }}</strong></td>
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
                                    <td class="td score-table" style="width: 90%">Skilled performance working towards
                                        Meeting expected level</td>
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
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->creative_activities == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->creative_activities == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->creative_activities == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->creative_activities == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">{{ $value->creative_activities }}</td>
                            </tr>
                            <tr>
                                <th class="th score-table" style="border: 1px solid;">HANDLING TOOLS </th>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handling_tools == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handling_tools == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handling_tools == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handling_tools == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">{{ $value->handling_tools }}</td>
                            </tr>
                            <tr>
                                <th class="th score-table" style="border: 1px solid;">HANDWRITING</th>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handwriting == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handwriting == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handwriting == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->handwriting == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">{{ $value->handwriting }}</td>
                            </tr>
                            <tr>
                                <th class="th score-table" style="border: 1px solid;">PHYSICAL ACTIVITIES</th>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->physical_activities == 'Well Done') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->physical_activities == 'Satisfactory') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->physical_activities == 'Interesting') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
                                <td class="td score-table" style="border: 1px solid;">
                                    {!! ($value->physical_activities == 'Excellent') ? "<input type='checkbox' checked>" : '' !!}
                                </td>
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
                                <td class="td score-table" style="border: 1px solid;">
                                    {{ $value->interest_and_appreciation }}
                                </td>
                            </tr>
                            <tr>
                                <th class="th score-table" style="border: 1px solid;">INTER-PERSONAL RELATIONSHIP</th>
                                <td class="td score-table" style="border: 1px solid;">
                                    {{ $value->inter_personal_relationship }}
                                </td>
                            </tr>
                            <tr>
                                <th class="th score-table" style="border: 1px solid;">EMOTIONAL ADJUSTMENT</th>
                                <td class="td score-table" style="border: 1px solid;">{{ $value->emotional_adjustment }}
                                </td>
                            </tr>
                        </table>
                    </div>




                    <div class="column" style="margin-right: 10px; margin-top:10px; padding:5px; font-size:20px;">

                        <br>

                        <div style="background-color: #fcd5b4; border: 1px solid; width: 100%; margin-bottom:10px; padding:10px">
                            <b>
                                CLASS TEACHER’S REMARK: {{ $value->class_tutor_comment }}
                                <br>
                                <br>
                                CLASS TEACHER'S NAME: @if(!empty($getClassTeacher)){{ $getClassTeacher->teacher_name }}
                                {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }}@endif <span
                                    class="float-right"
                                    style="margin-right: 10px;">{{ date('d-M-Y', strtotime($getExam->this_term_ends)) }}</span>
                            </b>
                        </div>

                        <br>

                        <div style="background-color: rgb(167, 190, 167); border: 1px solid; width: 100%; padding:10px">
                            <b>
                                HEADTEACHER’S REMARKS: {{ $value->head_teacher_remark }}
                                <br>
                                <br>
                                @if (!empty($getHeadTeacher))
                                    Head Teacher's Name: {{ $getHeadTeacher->name }} {{ $getHeadTeacher->last_name }}
                                    {{ $getHeadTeacher->other_name }} <span class="float-right"
                                        style="margin-right: 10px;">{{ date('d-M-Y', strtotime($getExam->this_term_ends)) }}</span>
                                @endif
                            </b>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    @endforeach







    <script type="text/javascript">
        window.print();
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>