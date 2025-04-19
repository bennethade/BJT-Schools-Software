@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Instruction</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> Hello <b>{{ $getStudent->last_name }} {{ $getStudent->name }}</b>, please read the instructions carefully before starting.</h3>
                </div>

                {{-- <form method="get" action=" "> --}}
                    <div class="card-body">
                        <div class="row">
                            
                            <div class="card-body">
                                <p>
                                    Welcome to the Computer-Based Test (CBT). 
                                    <br><br>
                                    - Ensure you have a stable internet connection. <br> 
                                    - Answer all questions within the given time limit.  <br>
                                    - Do not refresh or leave the page during the test.  <br>
                                    - Click the "<b>BEGIN TEST</b>" button when you are ready.  
                                </p>
                            </div>

                            
                        </div>
                    </div>
                {{-- </form> --}}
            </div>
        </div>
    </section>

    
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')

                    {{-- <div class="card text-center"> <!-- Added text-center class -->
                        <div class="card-header"> <!-- Center alignment using Bootstrap -->
                            <button class="btn btn-primary">BEGIN TEST</button>
                        </div>
                    </div> --}}

                    <div class="card text-center">
                        <a href="{{ route('student.cbt.take_cbt.begin', [$class_id, $exam_id, $subject_id, $cbt_exam_id]) }}" class="btn btn-primary" style="font-size: 25px;">BEGIN TEST</a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>
@endsection