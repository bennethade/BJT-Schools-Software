<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $getStudent->last_name }} {{ $getStudent->name }} Award</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @media print {
            @page {
                /*size: A4 landscape;*/
                size: 9.775in 6.9525in;
                margin: 0;
            }
            body, html {
                width: 100%;
                height: 100%;
            }
            .certificate {
                page-break-inside: avoid;
                page-break-after: auto;
                width: 100%;
                height: auto;
                margin: 0;
                padding: 0;
                border: none;
                transform: scale(1);
            }
        }
        body {
            font-family: 'Georgia', serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
        }
        .certificate {
            width: 900px;
            height: 630px;
            padding: 40px;
            margin: 20px auto;
            border: 25px solid #8b0000;
            position: relative;
            background-color: #fff;
        }
        .certificate:before, .certificate:after {
            content: '';
            position: absolute;
            width: 0;
            height: 0;
            border-style: solid;
        }
        .certificate:before {
            top: 0;
            left: 0;
            border-width: 60px 60px 0 0;
            border-color: #8b0000 transparent transparent transparent;
        }
        .certificate:after {
            bottom: 0;
            right: 0;
            border-width: 0 0 60px 60px;
            border-color: transparent transparent #8b0000 transparent;
        }
        .header-row {
            display: flex;
            /* justify-content: space-between; */
            align-items: center;
        }
        .logo img {
            height: 100px;
        }
        .title {
            font-size: 40px;
            font-weight: bold;
            color: #8b0000;
            text-align: center;
        }
        .motto {
            font-style: italic;
            text-align: center;
        }
        .sub-title {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
        }
        .presented {
            color: red;
            text-align: center;
        }
        .student-name {
            font-size: 45px;
            font-family: 'Brush Script MT', cursive;
            text-align: center;
        }
        .description {
            text-align: center;
            margin: 10px 0;
        }
        .signature {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }
        .stamp {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="certificate">
        <div class="header-row">
            <div class="logo">
                <img src="{{ $getSetting->getLogo() }}" alt="School Logo" height="100">
                {{-- <img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""> --}}
            </div>
            <div class="title" style="margin-left: 100px;"> <span style="text-transform:uppercase"> {{ $getSetting->school_name }} </span> <br> <p class="motto" style="color: black; font-size:14px;">Motto: {{ $getSetting->motto }} </p></div>
        </div>
        
        <div class="sub-title">BEST BEHAVED PUPIL</div> <br>

        <div class="presented">This award is presented to</div> <br>

        <div class="student-name" style="text-decoration: underline">{{ $getStudent->last_name }} {{ $getStudent->name }} {{ $getStudent->other_name }}</div>

        <div class="description motto">for being the BEST BEHAVED pupil in <span style="text-transform: uppercase"> {{ $getClass->name }}</span>  <br> for <span style="text-transform: uppercase"> {{ $getExam->name }} {{ $getExam->session }} </span></div>

        
        <br>

        <div class="signature">
            <div>
                @if (!empty($getHeadTeacher))
                    <span style="text-decoration: underline">{{ $getHeadTeacher->last_name }} {{ $getHeadTeacher->name }} </span> <br>HEAD OF SCHOOL
                @endif
            </div>

            <div class="stamp">
                <img src="{{ $getSetting->getSeal() }}" alt="Seal" height="130">
            </div>

            <div>
                @if (!empty($getClassTeacher))
                    <span style="text-decoration: underline"> {{ $getClassTeacher->last_name }} {{ $getClassTeacher->name }}</span> <br> CLASS TEACHER    
                @endif
            </div>
        </div>
    </div>

    <script type="text/javascript">
        window.print();
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    

</body>
</html>
