<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $getStudent->student_name }} {{ $getStudent->student_last_name }} {{ $getStudent->student_other_name }} PTC</title>
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
                font-size:18px;
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
    <body style="margin: 0px;">

        <table class="text-align: center;" style="border-top: 2px solid black; border-left: 2px solid black; border-right: 2px solid black">
            <thead>
                <tr style="width: 100%; text-align: center;">
                    <th width="15%"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                    <th width="60%">
                        <h1 style="font-weight: 900; color:red; font-size:40px">{!! $getSetting->school_name !!} </h1>
                        <h5 style="font-weight: 650;">{!! $getSetting->school_address !!}</h5>

                        {{-- <h5 style="font-weight: 650; text-transform: uppercase;">@if (!empty($getClass->section)) {{ $getClass->section }}@endif</h5> --}}
                        
                        <h5 style="font-weight: 650;"> {{ $getExam->name }} {{ $getExam->session }} Parent / Teacher Conference</h5>
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
            <table class="margin-bottom" style="width: 100%; font-size:18px;">
                <tr style="width: 100%; text-align: left;">
                    <th style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 40%;">Name of Child: {{ $getStudent->student_name }} {{ $getStudent->student_other_name }} {{ $getStudent->student_last_name }}</th>
                    <th style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 30%;">Class: @if (!empty($getClass->class_name)) {{ $getClass->class_name }}@endif </th>
                    <th style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 30%;">Age of Child: {{ $integerAge }} yr(s)</th>
                    {{-- <th width="10%">Age: {{ $getStudent->date_of_birth }}</th> --}}
                </tr>

                <tr style="width: 100%; text-align: left;">
                    <th colspan="2" style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 40%;">Teacher giving conference: @if($getClassTeacher) {{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }} @endif</th>
                    <th style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 20%;">Parent name: {{ $getParent->parent_title }} {{ $getParent->parent_name }} {{ $getParent->parent_last_name }} {{ $getParent->parent_other_name }}</th>
                    
                </tr>

                <tr style="width: 100%; text-align: left;">
                    
                    <th colspan="2" style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 90%;">Reason for conference: Half Term Observation/Assessment</th>
                    <th style="padding-left:10px; padding-right:10px; border-bottom: 1px solid; width: 10%;">Date: {{ \Carbon\Carbon::parse($getPTCGeneralComment->created_at)->format('d-F-Y') }}</th>
                </tr>
            </table>

        </div>

        <div style="margin-top:-50; border-left: 2px solid; border-right: 2px solid; border-bottom: 2px solid;">
            {{-- <br> --}}
            <h3 style="padding:20px 10px; text-align:center; text-decoration: underline">Items to be reported to parent or caregiver</h3>


            @foreach ($getStudentPTC as $ptc)
                <p style="padding-left:10px; padding-right:10px; font-size:18px; text-align:justify;"><b>{{ $ptc->subject_name }}:</b> {{ $ptc->comment }}</p>
            @endforeach


            <p style="padding-left:10px; padding-right:10px; font-size:18px; text-align:justify;"><b>Teacher's Comment:</b> @if($getPTCGeneralComment) {{ $getPTCGeneralComment->teacher_comment }} @endif</p>

            <p style="padding-left:10px; padding-right:10px; font-size:18px; text-align:justify;"><b>Parent's Comment:</b> @if($getPTCGeneralComment) {{ $getPTCGeneralComment->parent_comment }} @endif</p>
            

        
        </div>
        




      
        

        <script type="text/javascript">
            window.print();
        </script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>