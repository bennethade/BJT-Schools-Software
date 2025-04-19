
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exam Result</title>

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
<body>
    <div id="page">
        <table>
            <tr style="width: 100%; text-align: center;">
                <td width="5%"></td>
                <td width="15%"><img style="width: 200px;" src="{{ $getSetting->getLogo() }}" alt=""></td>
                <td align="left">
                    <h1>{!! $getSetting->school_name !!} </h1>
                </td>
            </tr>
        </table>

        <table style="width: 100%;">
            <tr>
                <td width="5%"></td>

                <td width="70%">
                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="27%">Name of Student:</td>
                                <td style="border-bottom: 1px solid; width: 100%;">{{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="23%">Admission No.:</td>
                                <td style="border-bottom: 1px solid; width: 100%;">{{ $getStudent->admission_number }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="23%">Class:</td>
                                <td style="border-bottom: 1px solid; width: 100%;">{{ $getClass->class_name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="28%">Academic Session:</td>
                                <td style="border-bottom: 1px solid; width: 20%;"></td>
                                <td width="28%">Term:</td>
                                <td style="border-bottom: 1px solid; width: 80%;">{{ $getExam->name }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="margin-bottom" style="width: 100%">
                        <tbody>
                            <tr>
                                <td width="19%">Total Score:</td>
                                <td style="border-bottom: 1px solid; width: 50%;"></td>
                                <td width="16%">Average:</td>
                                <td style="border-bottom: 1px solid; width: 50%;"></td>
                            </tr>
                        </tbody>
                    </table>

                </td>

                <td width="5%"></td>
                <td width="20%" valign="top">
                    <img src="{{ $getStudent->getProfileDirect() }}" style="border-radius: 6px; height: 100px; width: 100px;" alt="">
                    <br>Gender: {{ $getStudent->gender }}
                </td>
            </tr>
        </table>
        
        <br>

        <div>
            <table class="table-bg">
                <thead>
                   <tr>
                      <th class="th" style="text-align: left;">Subject</th>
                      <th class="th">Class Work</th>
                      <th class="th">Home Work</th>
                      <th class="th">Test</th>
                      <th class="th">Exam</th>
                      <th class="th">Total Score</th>
                      <th class="th">Pass Mark</th>
                      <th class="th">Full Mark</th>
                      <th class="th">Grade</th>
                      <th class="th">Result</th>
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
                                $totalMark = $exam['class_work']  + $exam['home_work'] + $exam['test'] + $exam['exam'];
                            }

                        @endphp
                        <tr>
                            <td class="td" style="width: 200px; text-align:left;">{{ $exam['subject_name'] }}</td>
                            <td class="td">{{ $exam['class_work'] }}</td>
                            <td class="td">{{ $exam['home_work'] }}</td>
                            <td class="td">{{ $exam['test'] }}</td>
                            <td class="td">{{ $exam['exam'] }}</td>
                            <td class="td">{{ $exam['total_score'] }}</td>
                            <td class="td">{{ $exam['pass_mark'] }}</td>
                            <td class="td">{{ $exam['full_mark'] }}</td>
                            <td class="td">
                                {{-- For Subject Grade --}}
                                @php
                                   $getSubjectGrade = App\Models\MarksGrade::getGrade($totalMark);
                                @endphp
                                @if (!empty($getSubjectGrade))
                                    {{ $getSubjectGrade }} <br>
                                @endif
                            </td>
                            <td class="td">
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
                        <td class="td" colspan="2"><b>Grand Total: {{ $total_score }}/{{ $full_mark }}</b></td>
                        @php
                            $percentage = ($total_score * 100) / $full_mark;
                            $getGrade = App\Models\MarksGrade::getGrade($percentage);
                        @endphp
                        <td class="td" colspan="2"><b>Percentage : {{ number_format($percentage, 2) }}%</b></td>
                        <td class="td" colspan="2"><b>Final Grade : {{ $getGrade }}</b></td>

                        <td class="td" colspan="4">
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

        <div>
            <strong>Class Teacher's Comment</strong>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum 
                has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a 
                type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more 
                recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
        </div>

        <table class="margin-bottom" style="width: 100%">
            <tbody>
                <tr>
                    <td width="15%">Signature:</td>
                    <td style="border-bottom: 1px solid; width: 100%;"></td>
                </tr>
            </tbody>
        </table>

    </div>

    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>