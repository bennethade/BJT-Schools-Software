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
              <h3>N{{ number_format($getTotalFees, 2) }}</h3>
              <p>All Time Received Payments</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('admin/fees_collection/collect_fees_repot') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <h3>N{{ number_format($getTotalMonthFees, 2) }}</h3>
              <p>This Month Payments</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url("admin/fees_collection/collect_fees_repot?created_date_from={$firstDayOfMonth}&created_date_to={$lastDayOfMonth}") }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <h3>N{{ number_format($getTotalTodayFees, 2) }}</h3>
              <p>Received Payments Today</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{ url('admin/fees_collection/collect_fees_repot?created_date_from='.date('Y-m-d').'&created_date_to='.date('Y-m-d').'') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{ $totalStudent }}</h3>

              <p>Total Students</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/student/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: purple; color:white">
            <div class="inner">
              <h3>{{ $totalAdmin }}</h3>

              <p>Total Admin</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #e65054; color:white">
            <div class="inner">
              <h3>{{ $totalTeacher }}</h3>

              <p>Total Teachers</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/teacher/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #996800; color:white">
            <div class="inner">
              <h3>{{ $totalParent }}</h3>

              <p>Total Parent</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{ url('admin/parent/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #72aee6; color:white">
            <div class="inner">
              <h3>{{ $totalExam }}</h3>

              <p>Total Exam</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('admin/examinations/exam/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{ $totalClass }}</h3>

              <p>Total Class</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('admin/class/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box bg-secondary">
            <div class="inner">
              <h3>{{ $totalSubject }}</h3>

              <p>Total Subject</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('admin/subject/list') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #2f6050; color:white">
            <div class="inner">
              <h3>{{ $totalNotification }}</h3>

              <p>Total Notification</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('admin/communication/notice_board') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box" style="background: #d37681; color:white">
            <div class="inner">
              <h3>{{ $totalHomework }}</h3>

              <p>Total Submitted Homework</p>
            </div>
            <div class="icon">
              <i class="nav-icon fas fa-table"></i>
            </div>
            <a href="{{ url('admin/homework/homework_report') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
      </div>
      
    </div>
  </section>
</div>




@endsection