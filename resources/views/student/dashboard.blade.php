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
            <a href="{{ url('student/fees_collection') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>        
        

        <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $totalSubject }}</h3>

              <p>Total Subjects</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('student/my_subject') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #72db0f; color:white">
            <div class="inner">
              <h3>{{ $totalNoticeBoard }}</h3>

              <p>Total Notice Board</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-pen"></i>
            </div>
            <a href="{{ url('student/my_notice_board') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalHomework }}</h3>

              <p>Undone Homework</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-book-open"></i>
            </div>
            <a href="{{ url('student/my_homework') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalSubmittedHomework }}</h3>

              <p>Submitted Homework</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-book"></i>
            </div>
            <a href="{{ url('student/my_submitted_homework') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
            <a href="{{ url('student/my_attendance') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      
    </div>
  </section>
</div>




@endsection