@extends('layouts.app')

@section('content')

    <div class="content-wrapper">
        <br>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3><strong>Your CBT Result For: {{ $attempt->cbtExam->exam_title }}</strong> </h3>
                        <hr>
                        <h5>Total Questions: {{ $totalQuestions }}</h5>
                        <h5>Unanswered: {{ $unansweredQuestion }}</h5>
                        <h5>Correct Answers: {{ $correctAnswers }}</h5>
                        <h5>Wrong Answers: {{ $fails }}</h5>
                        <h4>Final Score: {{ $scoreOver100 }} / 100</h4>
                    </div>

                    <a href="{{ route('student.cbt.list') }}" class="btn btn-primary">Take Another Exam</a>
                </div>
            </div>
        </section>
    </div>



@endsection