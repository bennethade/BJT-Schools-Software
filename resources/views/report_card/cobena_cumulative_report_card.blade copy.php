<!DOCTYPE html>
<html>

<head>
    <title>Cumulative Result</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        th,
        td {
            border: 1px solid #444;
            padding: 8px;
        }

        th {
            background: #f2f2f2;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h2>Student Cumulative Result</h2>

    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th rowspan="2">Subject</th>
                <th colspan="3">1st Term</th>
                <th colspan="3">2nd Term</th>
                <th colspan="3">3rd Term</th>
                <th rowspan="2">Overall Total</th>
                <th rowspan="2">W.A</th>
                <th rowspan="3">Teacher's Comment</th>
            </tr>
            <tr>
                <th>CA</th>
                <th>Project</th>
                <th>Exam</th>
                <th>CA</th>
                <th>Project</th>
                <th>Exam</th>
                <th>CA</th>
                <th>Project</th>
                <th>Exam</th>
            </tr>

            <tr>
                <th>Maximum Score</th>
                <th>30</th>
                <th>10</th>
                <th>60</th>
                <th>30</th>
                <th>10</th>
                <th>60</th>
                <th>30</th>
                <th>10</th>
                <th>60</th>
                <th>300</th>
                <th>100.00</th>
            </tr>

        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td style="text-align: left">{{ $result['subject_name'] }}</td>
                    <td>{{ $result['1st_ca'] }}</td>
                    <td>{{ $result['1st_project'] }}</td>
                    <td>{{ $result['1st_exam'] }}</td>
                    <td>{{ $result['2nd_ca'] }}</td>
                    <td>{{ $result['2nd_project'] }}</td>
                    <td>{{ $result['2nd_exam'] }}</td>
                    <td>{{ $result['3rd_ca'] }}</td>
                    <td>{{ $result['3rd_project'] }}</td>
                    <td>{{ $result['3rd_exam'] }}</td>
                    <td><strong>{{ $result['overall_total'] }}</strong></td>
                    <td><strong>{{ $result['weighted_average'] }}</strong></td>
                    <td></td>
                </tr>
            @endforeach

            <tr>
                <td colspan="5"><strong>Grand Total: {{ $grandTotal }}</strong></td>
                <td colspan="5"><strong>Overall Average: {{ $overallAverage }}</strong></td>
                <td colspan="3"><strong>Final Grade: {{ $grade }}</strong></td>
            </tr>
            <tr>
                <td colspan="6"><strong>Subjects Passed: {{ $subjectsPassed }}</strong></td>
                <td colspan="7"><strong>Subjects Failed: {{ $subjectsFailed }}</strong></td>
            </tr>

        </tbody>
    </table>


</body>

</html>