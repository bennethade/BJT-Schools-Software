<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }} CA</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            padding: 2px;
        }

        .report-card {
            width: 100%;
            max-width: 1000px;
            margin: 0 auto;
            background-color: #f5efcc;
            border: 2px solid;
            padding: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h1, h3 {
            text-align: center;
            margin-bottom: 15px;
            color: #353535;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            text-transform: uppercase;
        }

        h3 {
            font-size: 18px;
            font-weight: 500;
        }

        /* .info-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        } */

        .grades-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .grades-table th,
        .grades-table td {
            border: 1px solid #c4c4a8;
            padding: 20px;
            text-align: center;
        }

        .grades-table th {
            background-color: #383838;
            color: #fff;
        }

        .grades-table td {
            background-color: #f9f9f9;
        }

        .score-table th {
            padding: 10px;
            text-align: left;
        }

        .score-table td {
            padding: 10px;
        }

        @media print {
            body {
                margin: 0px;
            }

            .report-card {
                width: 100%;
                page-break-inside: avoid;
            }

            h1, h3 {
                margin-bottom: 10px;
            }

            .grades-table th,
            .grades-table td {
                padding: 15px;
                font-size: 12px;
            }
        }

    </style> 
</head>
<body>

    <div class="report-card">
        <table style="width: 100%; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th width="15%" valign="top">
                        <img style="width: 100px;" src="{{ $getSetting->getLogo() }}" alt="School Logo">
                    </th>
                    <th width="70%">
                        <h1>{!! $getSetting->school_name !!}</h1>
                        <h3>Mid-Term Assessment Report</h3>
                    </th>
                    <th width="15%" valign="top">
                        <img src="{{ $getStudent->getProfileDirect() }}" style="border-radius: 6px; height: 100px; width: 100px;" alt="Profile Picture">
                        <br>{{ $getStudent->gender }}
                    </th>
                </tr>
            </thead>
        </table>

        <table class="score-table" style="width: 100%; border: 1px solid #000; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th>Name: {{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }}</th>
                    <td>Age: {{ $integerAge }}</td>
                </tr>
                <tr>
                    <th>Class: {{ $getClass->class_name }}</th>
                    <td>Term: {{ $getExam->name }}</td>
                </tr>
                <tr>
                    <th>Academic Session: {{ $getExam->session }}</th>
                    <td>Tutor: {{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->other_name }} {{ $getClassTeacher->last_name }}</td>
                </tr>
            </thead>
        </table>

        <br>

        <table class="grades-table">
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>C.A</th>
                    <th>Home Fun</th>
                    <th>Attendance</th>
                    <th>Class Work</th>
                    <th>Total</th>
                    <th>Highest Score</th>
                    <th>Lowest Score</th>
                    <th>Comment</th>
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
                        $totalMark = $exam['ca'] + $exam['home_fun'] + $exam['attendance'] + $exam['class_work'];
                        $total_score += $totalMark;
                    @endphp

                    <tr>
                        <th>{{ $exam['subject_name'] }}</th>
                        <td>{{ $exam['ca'] }}</td>
                        <td>{{ $exam['home_fun'] }}</td>
                        <td>{{ $exam['attendance'] }}</td>
                        <td>{{ $exam['class_work'] }}</td>
                        <td>{{ $totalMark }}</td>
                        <td>
                            @if (isset($subjectHighestScores[$exam['subject_id']]))
                                {{ $subjectHighestScores[$exam['subject_id']] }}
                            @endif
                        </td>
                        <td>
                            @if (isset($subjectLowestScores[$exam['subject_id']]))
                                {{ $subjectLowestScores[$exam['subject_id']] }}
                            @endif
                        </td>
                        <td>{!! $exam['ca_comment'] !!}</td>
                    </tr>
                @endforeach

                <tr>
                    <th colspan="9" style="text-align: center; font-weight: bold; font-size:16px;">
                        Grand Total: {{ $total_score }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>

    <script type="text/javascript">
        window.print();
    </script>

</body>
</html>
