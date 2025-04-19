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
                /* size: 390mm 279mm; Custom size, larger than A4 */

                /* size: A4 landscape; */
                size: A4;
                margin: 20px; /* Adjusted the margins */
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
                    <th width="15%" valign="top"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                    <th width="70%">
                        <h1 style="font-weight: 900; color:blue; font-size:35px">{{ $getSetting->school_name }}</h1>
                        <h5 style="font-size:25px; font-weight: 500;">{!! $getSetting->school_address !!}</h5>
                        <h5>{{ $getSetting->school_website }}  |  {{ $getSetting->school_phone_1 }}</h5>
                        {{-- <h3 style="color:blue">Half Term Report</h3> --}}
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
        

        {{-- <div style="padding-top:15px; border-left: 2px solid black; border-right: 2px solid black">
            <br>
        </div> --}}
        
        <div style="padding-top:5px; border-left: 2px solid black; border-right: 2px solid black; border-bottom: 2px solid black;">

            <table class="" style="width: 100%">
                <div style="display: flex; justify-content: space-between; gap: 10px;">
                    {{-- Left Column --}}
                    <div style="flex: 1; padding: 5px;">

                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:25px; text-transform:uppercase; color: blue; background-color:lightgrey; border: 6px solid greenyellow; border-radius:20px; padding: 10px; text-align:center;">{{ $getExam->name }} {{ $getExam->session }} SESSION </h3>
                        </div>

                    </div>

                    {{-- Right Column --}}
                    <div style="flex: 1; padding: 5px;">

                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:25px; color: blue; background-color:lightgrey; border: 6px solid greenyellow; border-radius:20px; padding: 10px; text-align:center;">HALF TERM REPORT</h3>
                        </div>

                    </div>


                </div>
            </table>

            {{-- <br> --}}

            <hr style="border: 1px solid rgb(10, 10, 110);">

            {{-- <br> --}}

            <table class="margin-bottom" style="width: 100%">
                <div style="display: flex; justify-content: space-between; gap: 10px;">
                    {{-- Left Column --}}
                    <div style="flex: 1; padding: 15px;">
                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:20px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Name: {{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }}</h3>
                        </div>
                    </div>

                    <div style="flex: 1; padding: 15px;">
                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:20px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Age: {{ $integerAge }}</h3>
                        </div>
                    </div>

                    <div style="flex: 1; padding: 15px;">
                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:20px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Class: @if(!empty($getClass)) {{ $getClass->class_name }} {{ $getClass->class_description }}@endif</h3>
                        </div>
                    </div>

                </div>
            </table>

            <br>
        </div>


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
                        <th class="th score-table" style="color:red; border: 1px solid; width: 5%;">Emerging</th>
                        <th class="th score-table" style="color:green; border: 1px solid; width: 5%;">Expected</th>
                        <th class="th score-table" style="color:blue; border: 1px solid; width: 5%;">Exceeding</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($goals as $goal)
                        <tr>
                            <td class="td score-table" style="border: 1px solid;">
                                {{ $goal->subject->name ?? 'Subject' }}
                            </td>
                            <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == '1') ? "<input type='checkbox' checked>" : '' !!}</td>
                            <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == '2') ? "<input type='checkbox' checked>" : '' !!}</td>
                            <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == '3') ? "<input type='checkbox' checked>" : '' !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach





        {{-- FOR GRID FORMAT OF PRINTING THE SUBJECTS AND GOALS --}}

        {{-- <div style="display: flex; flex-wrap: wrap; gap: 15px; margin-top: 20px;">
            @foreach($categories as $category_id => $goals)
                @php
                    $category = $goals->first()->category;

                    $color = $category->color ?? 'rgb(0, 0, 0)'; 
                @endphp

                <div style="flex: 1 1 calc(50% - 10px); border: 1px solid black; padding: 10px; box-sizing: border-box;">
                    <h6 style="color: {{ $color }}; text-transform: uppercase;">
                        {{ $category->name ?? 'Category' }}
                    </h6>

                    <table class="margin-bottom" style="padding: 1px;  font-weight: bold; width: 100%;">
                        <thead>
                            <tr>
                                <th class="th score-table" style="border: 1px solid; width: 80%;"></th>
                                <th class="th score-table" style="border: 1px solid; width: 5%;">Emerging</th>
                                <th class="th score-table" style="border: 1px solid; width: 5%;">Expected</th>
                                <th class="th score-table" style="border: 1px solid; width: 5%;">Exceeding</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($goals as $goal)
                                <tr>
                                    <td class="td score-table" style="border: 1px solid;">
                                        {{ $goal->subject->name ?? 'Subject' }}
                                    </td>
                                    <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == '1') ? "<input type='checkbox' checked>" : '' !!}</td>
                                    <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == '2') ? "<input type='checkbox' checked>" : '' !!}</td>
                                    <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == '3') ? "<input type='checkbox' checked>" : '' !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div> --}}


        


        <br>



        <div>
            

            @foreach ($getBehaviorChart as $behaviour)
          
                <div style="background-color: #fbddc5; border: 1px solid; border-radius:50px; width: 100%; margin-top:20px; margin-bottom:20px; padding:10px; font-size:20px;">
                    <table>
                        <thead>
                            <h4 style="text-align: center; color:blue; text-decoration:underline;">Class Teacher’s Comment</h4>
                        </thead>
                        
                        <p>{{ $behaviour->class_tutor_midterm_comment }} </p>  
                        <br>
                        <br>
                        <p style="color: blue">Class Teacher's Name: @if(!empty($getClassTeacher)){{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }}@endif    <span class="float-right" style="margin-right: 10px;">Date: {{ date('d-m-Y', strtotime($behaviour->updated_at)) }}</span></p>
                    </table>
                </div>

            @endforeach

        </div>


            

              
        

        <script type="text/javascript">
            window.print();
        </script>


        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    </body>

</html>