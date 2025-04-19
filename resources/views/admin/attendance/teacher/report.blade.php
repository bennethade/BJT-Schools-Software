@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Download Teacher Attendance Report</h1>
            </div>
            <div class="col-sm-6">
               {{-- <a href="{{ route('attendance.teacher.add') }}" class="btn btn-primary" style="float: right;">Add Attendance</a> --}}
            </div>
         </div>
      </div>

   </section>

   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                <div class="card" style="padding: 20px;">
                    <div class="row" style="text-align: center">
                        <div class="col-sm-4">
                            <a class="btn btn-danger" href="{{ route('attendance.teacher.today_report') }}" target="blank" style="margin: 10px;">Today's Attendance</a>
                        </div>
                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.weekly_report') }}" class="btn btn-primary" target="blank" style="margin: 10px;">This Week's Attendance</a>
                        </div>

                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.monthly_report') }}" class="btn btn-warning" target="blank" style="margin: 10px;">This Month's Attendance</a>
                        </div>
                    </div>
                </div>

                <div class="card" style="padding: 20px;">
                    <div class="row" style="text-align: center">

                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.today_late_comers') }}" target="blank" class="btn" style="margin: 10px; background:purple; color:white;">Today's Late Comers</a>
                        </div>
                        
                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.weekly_late_comers') }}" target="blank" class="btn btn-info" style="margin: 10px;">This Week's Late Comers</a>
                        </div>

                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.monthly_late_comers') }}" target="blank" class="btn btn-secondary" style="margin: 10px;">This Month's Late Comers</a>
                        </div>

                    </div>
                </div>


                <div class="card" style="padding: 20px;">
                    <div class="row" style="text-align: center">

                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.today_early_leavers') }}" target="blank" class="btn btn-warning" style="margin: 10px;">Today's Early Leavers</a>
                        </div>
                        
                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.weekly_early_leavers') }}" target="blank" class="btn btn-success" style="margin: 10px;">This Week's Early Leavers</a>
                        </div>

                        <div class="col-sm-4">
                            <a href="{{ route('attendance.teacher.monthly_early_leavers') }}" target="blank" class="btn btn-primary" style="margin: 10px;">This Month's Early Leavers</a>
                        </div>

                    </div>
                </div>
            </div>
         </div>
      </div>
   </section>


   
</div>
@endsection
