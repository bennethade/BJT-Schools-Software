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
                /* padding: 10px; */
                padding: 5px;
            }
            .td {
                border: 1px solid #000;
                /* padding: 3px; */
                padding: 1px;
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
                        <h1 style="font-weight: 900; color:red; font-size:50px">{{ $getSetting->school_name }}</h1>
                        <h5 style="font-weight: 650;">{{ $getSetting->school_address }}</h5>

                        {{-- <h5 style="font-weight: 650; text-transform: uppercase;">@if (!empty($getClass->section)) {{ $getClass->section }}@endif</h5> --}}
                        
                        <h5 style="font-weight: 650;">@if(!empty($getClass)) {{ $getClass->class_name }} {{ $getExam->name }} Progress Report – {{ $getExam->session }} Academic Session @endif</h5>
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
                    <th style="border-bottom: 1px solid; width: 20%;">Class: @if(!empty($getClass)) {{ $getClass->class_name }} {{ $getClass->class_description }} @endif</th>
                    <th style="border-bottom: 1px solid; width: 30%;">Admission Number: {{ $getStudent->admission_number }} </th>
                    <th style="border-bottom: 1px solid; width: 10%;">Age: {{ $integerAge }} </th>
                    {{-- <th width="10%">Age: {{ $getStudent->date_of_birth }}</th> --}}
                </tr>
            </table>

            <table class="margin-bottom" style="width: 100%">
                <tr>
                    {{-- <th style="border-bottom: 1px solid; width: 20%;">Weight: {{ $getStudent->weight }} </th> --}}
                    {{-- <th style="border-bottom: 1px solid; width: 20%;">Height: {{ $getStudent->height }} --}}
                    <th style="border-bottom: 1px solid; width: 30%;">This Term Commenced: {{ date('d-m-Y', strtotime($getExam->this_term_commenced)) }} </th>
                    <th style="border-bottom: 1px solid; width: 30%;">This Term Ends: {{ date('d-m-Y', strtotime($getExam->this_term_ends)) }} </th>
                    <th style="border-bottom: 1px solid; width: 30%;">Next Term Begins: {{ date('d-m-Y', strtotime($getExam->next_term_begins)) }}</th>
                </tr>
            </table>

            <table class="margin-bottom" style="width: 100%">
                @foreach ($getBehaviorChart as $behaviour)
                    <tr>
                        <th style="border-bottom: 1px solid; width: 30%;">Number of Times School Opened: {{ $getExam->no_of_times_school_opened }}</th>
                        <th style="border-bottom: 1px solid; width: 30%;">Number of Times Present: {{ $behaviour->number_of_times_present }}</th>
                        <th style="border-bottom: 1px solid; width: 30%;">
                            Number of Times Absent: 
                            @if(!empty($getExam->no_of_times_school_opened))
                                {{ $getExam->no_of_times_school_opened - $behaviour->number_of_times_present }} 
                            @endif
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>


        {{-- <div style=""> --}}

            <div style="margin-top: 20px; border: 2px solid black">
                <h4 style="color: red">SUMMARY OF SKILLS</h4>
                <p style="font-size: 20px; text-align:justify;">
                    The information contained in this report is a summary of your child’s achievement, attitude,
                    behavior and effort. This report is one of the strategies used by Cobena Schools to communicate
                    with you about your child’s progress.
                </p>

                <p style="font-size: 20px; text-align:justify;">
                    <span style="font-weight: 600; font-size:25px;"> LEARNING AREA ASSESSMENT: </span> Categorizes your child’s progress into Not Yet Introduced,
                    Progressing Towards Expectation, Meeting Expectation and Exceeding Expectations. See full explanation of categories below.
                </p>

                <p style="font-size: 20px; text-align:justify;">
                    <span style="font-weight: 600; font-size:22px; color:red"> 1 - Not Yet Introduced: </span> Newly introduced to the concept/skill; child has not grasped concept/skill properly.
                </p>

                <p style="font-size: 20px; text-align:justify;">
                    <span style="font-weight: 600; font-size:22px; color:purple"> 2 - Progressing: </span> Displays consistent progress; needs adult assistance.
                </p>

                <p style="font-size: 20px; text-align:justify;">
                    <span style="font-weight: 600; font-size:22px; color:green"> 3 - Meeting: </span> Displays skill/uses concept most of the time. Stage of conscious competence.
                </p>

                <p style="font-size: 20px; text-align:justify;">
                    <span style="font-weight: 600; font-size:22px; color:darkblue"> 4 - Exceeding: </span> The child is working in the stage of unconscious competence. 
                </p>

            </div>

        {{-- </div> --}}



         @foreach($categories as $category_id => $goals)
            @php
                // Fetch the category model directly from the goals collection
                $category = $goals->first()->category;
                // Use the color code from the category
                $color = $category->color ?? 'rgb(0, 0, 0)'; // Default color if not set
            @endphp

            <h4 style="color: {{ $color }}; padding-top: 20px; text-transform: uppercase;">
                {{ $category->name ?? 'Category' }}
            </h4>
            <table class="margin-bottom" style="padding: 1px; border: 1px solid #000; font-weight:bold; width: 100%">
                <thead>
                    <tr>
                        <th class="th score-table" style="border: 1px solid; width: 80%;">EXPECTATIONS</th>
                        <th class="th score-table" style="border: 1px solid; width: 5%;">N</th>
                        <th class="th score-table" style="border: 1px solid; width: 5%;">P</th>
                        <th class="th score-table" style="border: 1px solid; width: 5%;">M</th>
                        <th class="th score-table" style="border: 1px solid; width: 5%;">E</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($goals as $goal)
                        <tr>
                            <td class="td score-table" style="border: 1px solid;">
                                {{ $goal->subject->name ?? 'Subject' }}
                            </td>
                            <td class="td score-table" style="border: 1px solid;">{!! ($goal->learning_outcome == 'N') ? "<input type='checkbox' checked>" : '' !!}</td>
                            <td class="td score-table" style="border: 1px solid;">{!! ($goal->learning_outcome == 'P') ? "<input type='checkbox' checked>" : '' !!}</td>
                            <td class="td score-table" style="border: 1px solid;">{!! ($goal->learning_outcome == 'M') ? "<input type='checkbox' checked>" : '' !!}</td>
                            <td class="td score-table" style="border: 1px solid;">{!! ($goal->learning_outcome == 'E') ? "<input type='checkbox' checked>" : '' !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach

        


        <br><br>
        <div>
            <center>
                <h4 style="color: red; background-color:gray">NEXT TERM BEGINS: {{ date('d-m-Y', strtotime($getExam->next_term_begins)) }}</h4>
            </center>

            @foreach ($getBehaviorChart as $behaviour)
          
                <div style="background-color: #fbddc5; border: 1px solid; width: 100%; margin-top:20px; margin-bottom:20px; padding:10px; font-size:20px;">
                    <b>
                        Class Teacher's Remark:  {{ $behaviour->class_tutor_comment }} 
                        <br>
                        <br>
                        Class Teacher's Name: @if(!empty($getClassTeacher)){{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }}@endif    <span class="float-right" style="margin-right: 10px;">{{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}</span>
                    </b>
                </div>
            
                <div style="background-color: rgb(209, 218, 209); border: 1px solid; width: 100%; padding:10px; font-size:20px;">
                    <b>
                        Head Teacher's Remark: {{ $behaviour->head_teacher_remark }} 
                        <br>
                        <br>
                        @if (!empty($getHeadTeacher))
                            Head Teacher's Name: {{ $getHeadTeacher->name }} {{ $getHeadTeacher->last_name }} {{ $getHeadTeacher->other_name }}     <span class="float-right" style="margin-right: 10px;">{{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}</span>
                        @endif
                    </b>
                </div>

            @endforeach

        </div>


            

            @if ($getExam->name == "Term 1")
                @if ($getStudent->religion == 'Christian')
                    <br><br><br>

                    <center>
                        <h4 style="color: red; font-family:cursive">COBENA <span style="color: green"> IS WISHIHG YOU A MERRY CHRISTMAS </span> <span style="color: red"> & </span> <span style="color: green"> A PROSPEROUS NEW YEAR </span></h4>
                        <img src="{{ asset('upload/christmas_bell_2.PNG') }}" alt="Christmas Bell" width="500px">
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