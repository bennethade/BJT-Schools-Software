@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  
  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>N{{ number_format($totalPaidAmount, 2) }}</h3>
              <p>Total Paid Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalStudent }}</h3>

              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #d51260; color:white">
            <div class="inner">
              <h3>{{ $totalNoticeBoard }}</h3>

              <p>Total Notice Board</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('parent/my_notice_board') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #dc2daa; color:white">
            <div class="inner">
              <h3>{{ $totalAttendance }}</h3>

              <p>Total Attendance</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-school"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{ $totalSubmittedHomework }}</h3>

              <p>Total Submitted Homework</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-book"></i>
            </div>
            <a href="{{ url('parent/my_student') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      
    </div>
  </section>
</div>




@endsection