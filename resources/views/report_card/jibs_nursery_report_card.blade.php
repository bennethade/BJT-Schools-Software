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
                        <h3 style="color:blue">End of Term Progress Report</h3>
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
                            <h3 style="font-size:28px; text-transform:uppercase; color: blue; background-color:lightgrey; border: 6px solid greenyellow; border-radius:20px; padding: 10px;">{{ $getExam->session }} SESSION ({{ $getExam->name }})</h3>
                        </div>

                    </div>

                    {{-- Right Column --}}
                    <div style="flex: 1; padding: 5px;">

                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:26px; color: blue; background-color:lightgrey; border: 6px solid greenyellow; border-radius:20px; padding: 10px;"><span style="color: purple">EARLY</span> <span style="color: green">YEARS</span> <span style="color: red">FOUNDATION</span> <span style="color: #988c54">STAGE</span></h3>
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
                            <h3 style="font-size:24px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Name: {{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }}</h3>
                            <h3 style="font-size:24px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">D.O.B: {{ $getStudent->date_of_birth }}</h3>
                            <h3 style="font-size:24px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">This Term Ends: </h3>
                        </div>

                    </div>

                    {{-- Right Column --}}
                    <div style="flex: 1; padding: 15px;">

                        <div style="margin-bottom: 5px;">
                            <h3 style="font-size:24px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Age: {{ $integerAge }}</h3>
                            <h3 style="font-size:24px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Next Term Begins: </h3>
                            <h3 style="font-size:24px; font-weight:700; background-color:#89b95a; border: 2px solid #004400; padding: 10px;">Class: @if(!empty($getClass)) {{ $getClass->class_name }} {{ $getClass->class_description }}@endif</h3>
                        </div>

                    </div>

                </div>
            </table>

            <br>
        </div>


        {{-- <br> --}}

            <div style="margin-top: 10px; border: 1px solid black; padding: 5px; font-size: 18px;">
                <h4 style="text-align: center; font-size: 20px;">BRIEF SUMMARY OF THE 7 EARLY LEARNING GOALS</h4>

                <div style="display: flex; justify-content: space-between; gap: 10px;">
                    {{-- Left Column --}}
                    <div style="flex: 1; padding: 5px;">
                        <h4 style="font-size: 17px;">THE 3 PRIME AREAS</h4>

                        <div style="border: 1px solid; margin-bottom: 5px;">
                            <h5 style="color: green; text-decoration: underline; font-size: 18px;">Communication and Language Development</h5>
                            <p style="font-size: 16px; text-align: justify;">Involves giving children opportunities to speak and listen in a range of situations and develop their confidence and skills in expressing themselves. This term the children learnt environmental instrumental sounds e.g. the sounds made by cats, dogs, a knock at the door, etc. They also watched and listened to the story “Handa’s Surprise”.</p>
                        </div>

                        <div style="border: 1px solid; margin-bottom: 5px;">
                            <h5 style="color: red; text-decoration: underline; font-size: 18px;">Physical Development</h5>
                            <p style="font-size: 16px; text-align: justify;">Physical development includes an increase in coordination of gross motor movements and more specialized fine motor abilities. The children learnt how to sing and dance, mold with play dough, target throw, and paper ripping, etc.</p>
                        </div>

                        <div style="border: 1px solid; margin-bottom: 5px;">
                            <h5 style="color: blue; text-decoration: underline; font-size: 18px;">Personal, Social, and Emotional Development</h5>
                            <p style="font-size: 16px; text-align: justify;">Personal, Social, and Emotional development covers self-regulation, self-concept, and better appreciation of emotions and how to express them. The children learnt how to identify feelings (sad, happy, angry, surprise), self-identification, and taking turns.</p>
                        </div>

                        <div style="margin-top: 11px;">
                            <h6 style="font-size: 16px; text-align:center;">BRIEF SUMMARY OF END OF TERM’S ASSESSMENT AND REPORTING ARRANGEMENT (ARA)</h6>
                            <table style="width: 100%; border: 1px solid;">
                                <thead>
                                    <tr>
                                        <th style="color:red; border: 1px solid; font-size: 16px;">Emerging</th>
                                        <th style="color:green; border: 1px solid; font-size: 16px;">Expected</th>
                                        <th style="color:blue; border: 1px solid; font-size: 16px;">Exceeding</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="border: 1px solid; font-size: 15px;">A tick in this box indicates that your child is <span style="color: red">working towards achieving</span> stated learning objective/outcome.</td>
                                        <td style="border: 1px solid; font-size: 15px;">A tick in this box indicates that your child is <span style="color: green">working comfortably within</span> stated learning objective/outcome.</td>
                                        <td style="border: 1px solid; font-size: 15px;">A tick in this box indicates that your child is <span style="color: blue">working above</span> stated learning objective/outcome.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Right Column --}}
                    <div style="flex: 1; padding: 5px;">
                        <h4 style="font-size: 17px;">THE 4 SPECIFIC AREAS</h4>

                        <div style="border: 1px solid; margin-bottom: 5px;">
                            <h5 style="color: purple; text-decoration: underline; font-size: 18px;">Literacy</h5>
                            <p style="font-size: 16px; text-align: justify;">Involves giving children opportunities to speak and listen in a range of situations and develop their confidence and skills in expressing themselves. The children learnt environmental sounds like the sounds made by animals and objects.</p>
                        </div>

                        <div style="border: 1px solid; margin-bottom: 5px;">
                            <h5 style="color: rgb(133, 133, 19); text-decoration: underline; font-size: 18px;">Numeracy</h5>
                            <p style="font-size: 16px; text-align: justify;">Involves providing children with opportunities to practise skills in counting, addition, and identifying shapes. The children learnt to count orally 1-20, identify shapes like circles, squares, and primary colors.</p>
                        </div>

                        <div style="border: 1px solid; margin-bottom: 5px;">
                            <h5 style="color: brown; text-decoration: underline; font-size: 18px;">Understanding the World</h5>
                            <p style="font-size: 16px; text-align: justify;">Involves guiding children to explore the world around them. The children learnt about their body, sense organs, family, school, etc.</p>
                        </div>

                        <div style="border: 1px solid;">
                            <h5 style="color: green; text-decoration: underline; font-size: 18px;">Expressive Arts and Design</h5>
                            <p style="font-size: 16px; text-align: justify;">Involves supporting children to explore and play with a wide range of media and materials, as well as providing opportunities and encouragement for sharing their thoughts, ideas, and feelings through art, music, movement, dance, and role-play. The children learnt to mold with play dough, block construction, number collage tissue fruits painting.</p>
                        </div>
                    </div>
                </div>
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

                    <table class="margin-bottom" style="padding: 1px; border: 1px solid #000; font-weight: bold; width: 100%;">
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
                                    <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == 'N') ? "<input type='checkbox' checked>" : '' !!}</td>
                                    <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == 'P') ? "<input type='checkbox' checked>" : '' !!}</td>
                                    <td class="td score-table" style="text-align:center; border: 1px solid;">{!! ($goal->learning_outcome == 'M') ? "<input type='checkbox' checked>" : '' !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div> --}}


        


        <br>


        {{-- SUBJECT COMMENT SECTION --}}
        @if (!empty($getSubjectComment) && $getSubjectComment->isNotEmpty())
            <div style="margin-top: 10px; padding: 5px; font-size: 20px;">
                <h4 style="text-align: center; font-size: 20px;">SUBJECT COMMENTS</h4>

                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;">
                    @foreach ($getSubjectComment as $comment)
                        <div style="border: 1px solid; padding: 10px;">
                            <h5 style="color: green; text-decoration: underline; font-size: 22px;">{{ $comment->subject_name }}</h5>
                            <p style="font-size: 18px; text-align: justify;">{!! $comment->comment !!}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif






        <div>
            {{-- <center>
                <h4 style="color: red; background-color:gray">NEXT TERM BEGINS: {{ date('d-m-Y', strtotime($getExam->next_term_begins)) }}</h4>
            </center> --}}

            @foreach ($getBehaviorChart as $behaviour)
          
                <div style="background-color: #fbddc5; border: 1px solid; width: 100%; margin-top:20px; margin-bottom:20px; padding:10px; font-size:20px;">
                    <table>
                        <thead>
                            <h4 style="text-align: center; color:blue; text-decoration:underline;">Class Teacher’s General Comment</h4>
                        </thead>
                        
                        <p>{{ $behaviour->class_tutor_comment }} </p>  
                        <br>
                        <br>
                        <p style="color: blue">Class Teacher's Name: @if(!empty($getClassTeacher)){{ $getClassTeacher->teacher_name }} {{ $getClassTeacher->last_name }} {{ $getClassTeacher->other_name }}@endif    <span class="float-right" style="margin-right: 10px;">Date: {{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}</span></p>
                    </table>
                </div>
            
                {{-- <div style="background-color: rgb(209, 218, 209); border: 1px solid; width: 100%; padding:10px; font-size:20px;">
                    <table>
                        <thead>
                            <h4 style="text-align: center; color:purple; text-decoration:underline;">Head Teacher's Remark</h4>
                        </thead>
                        
                        <p>{{ $behaviour->head_teacher_remark }} </p>  
                        <br>
                        <br>
                        <p style="color: purple">
                            Head Teacher's Name: 
                            @if (!empty($getHeadTeacher))
                                {{ $getHeadTeacher->name }} {{ $getHeadTeacher->last_name }} {{ $getHeadTeacher->other_name }}     <span class="float-right" style="margin-right: 10px;">Date: {{ date('d-m-Y', strtotime($getExam->this_term_ends)) }}</span>
                            @endif
                        </p>
                    </table>
                </div> --}}

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