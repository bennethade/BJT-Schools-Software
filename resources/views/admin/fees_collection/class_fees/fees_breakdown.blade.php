<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ $getStudent->name }} {{ $getStudent->other_name }} {{ $getStudent->last_name }} Invoice</title>
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
                font-family: Arial, sans-serif;
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

            .fee-table {
                width: 90%;
                border-collapse: collapse;
                margin: 20px auto;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            caption {
                font-size: 1.5em;
                margin-bottom: 10px;
            }

            .thead-th {
                background-color: #f2f2f2;
                font-weight: bold;
                text-align: left;
                padding: 10px;
            }


            .tbody-td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .last-child {
                font-weight: 900;
            }
            /* tbody tr:last-child {
                font-weight: bold;
            } */

        </style> 

    </head>
    <body style="margin: 10px; border: 3px solid black">

        <table class="text-align: center;">
            <thead>
                <tr style="width: 100%; text-align: center;">
                    <th width="15%" valign="top"><img style="width: 150px;" src="{{ $getSetting->getLogo() }}" alt=""></th>
                    <th width="70%">
                        <h1 style="font-size:32px; font-weight: 700; text-transform: uppercase">{!! $getSetting->school_name !!}</h1>
                        <h5 style="font-size:25px; font-weight: 500;">{!! $getSetting->school_address !!}</h5>
                        <h5>{{ $getSetting->school_email_1 }}  |  {{ $getSetting->school_phone_1 }}  </h5>
                        <!--<h5>{{ $getSetting->school_website }}  |  {{ $getSetting->school_phone_1 }} , {{ $getSetting->school_phone_2 }}</h5>-->
                        <h4>OFFICIAL INVOICE</h4>
                    </th>
                    <th width="15%" valign="top">
                        {{-- <img src="{{ asset('upload/profile/user.jpg') }}" style="border-radius: 6px; height: 100px; width: 100px;" alt=""> --}}
                        <img src="{{ $getStudent->getProfileDirect() }}" style="border-radius: 6px; height: 100px; width: 100px;" alt="">
                        <br>Gender: {{ $getStudent->gender }}
                    </th>
                </tr>

            </thead>

        </table>
        <hr>

        <br>

        @php
            use Carbon\Carbon;
        @endphp

        <div style="padding-left: 50px;">
            
            @if (!empty($getParent))
                <h5>Bill To: {{ $getParent->parent_title }} {{ $getParent->parent_last_name }} {{ $getParent->parent_name }} </h5>
            @endif
            
            <h5>Name of Child: {{ $getStudent->last_name }} {{ $getStudent->name }} {{ $getStudent->other_name }} </h5>
            
            @if (!empty($getFees))
                <h5>Date: {{ Carbon::parse($getFees->created_at)->format('jS F, Y') }}</h5>
            @endif
        </div>

        <hr>

        <!--<br>-->


        <table class="fee-table">
            
            @if (!empty($getClass))
                <h5 style="text-align: center">Class: {{ $getClass->class_name }} {{ $getClass->description }} </h5>
            @endif

            <thead>
                <tr>
                    <th class="thead-th">DESCRIPTION</th>
                    <th class="thead-th">AMOUNT</th>
                </tr>
            </thead>

            @if (!empty($getFees))
                <tbody>
                    <tr>
                        <td class="tbody-td">Outstanding</td>
                        <td class="tbody-td">{{ $getFees->outstanding }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">{{ $getExamName->exam_name }} {{ $getExamName->exam_session }} Tuition Fee</td>
                        <td class="tbody-td">{{ $getFees->tuition_fee }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">Resources</td>
                        <td class="tbody-td">{{ $getFees->resources }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">After school care</td>
                        <td class="tbody-td">{{ $getFees->after_school_care }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">Uniform</td>
                        <td class="tbody-td">{{ $getFees->uniform }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">Club</td>
                        <td class="tbody-td">{{ $getFees->club }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">School Lunch</td>
                        <td class="tbody-td">{{ $getFees->school_lunch }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">School Bus</td>
                        <td class="tbody-td">{{ $getFees->school_bus }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">End of Session</td>
                        <td class="tbody-td">{{ $getFees->end_of_session }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">Others</td>
                        <td class="tbody-td">{{ $getFees->miscellaneous }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">Subtotal</td>
                        <td class="tbody-td">{{ $getFees->subtotal }}</td>
                    </tr>
                    <tr>
                        <td class="tbody-td">DISCOUNT</td>
                        <td class="tbody-td"> @if(!empty($getFees->discount)) {{ $getFees->discount }}% off tuition @endif </td>
                    </tr>

                    <tr style="font-size: 20px;">
                        <td class="last-child">GRAND TOTAL</td>
                        <td class="last-child">{{ number_format($getFees->grand_total, 0, '.', ',') }}</td>
                    </tr>
                    
                </tbody>
            @endif
        </table>

        <!--<br>-->

        <div style="padding-left: 50px;">
            <h5>Thank you for trusting us with your child!</h5>
            
            <br>

            <h5>Account Officer: <img src="{{ $getSetting->getAccountantSignature() }}" alt="" style="width: 50px"></h5> 
            
            <br>
        </div>

        <div style="padding-left: 50px;">
            <h5 class="float-left">Head of School:  <img src="{{ $getSetting->getHeadOfSchoolSignature() }}" alt="" style="width: 70px"></h5>

            <h5 class="float-right" style="padding-right: 50px;">Date: @if (!empty($getFees)){{ Carbon::parse($getFees->created_at)->format('jS F, Y') }}@endif</h5>
        </div>

        <div style="text-align: center; margin-top:20px;">
            <br/>
            <hr>

        </div>

        <div style="text-align: center;">
            <h3 style="font-weight:700;">KINDLY MAKE ALL PAYMENTS TO THE ACCOUNT BELOW</h3> 
            <br>
            <h3 style="font-weight:400;">ACCOUNT NAME: {{ $getSetting->school_account_name }}</h3>
            <br>
            <h3 style="font-weight:400;">ACCOUNT NUMBER: {{ $getSetting->school_account_number }}</h3>
            <br>
            <h3 style="font-weight:400;">BANK NAME: {{ $getSetting->bank_name }}</h3>
        </div>


        <script type="text/javascript">
            window.print()
        </script>

    </body>
</html>
