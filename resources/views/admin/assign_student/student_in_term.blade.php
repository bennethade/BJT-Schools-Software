@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Count The Number of Students Per Term</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Search By Term</h3>
                    </div>

                    <form method="get" action=" ">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Term Name:</label>
                                <select class="form-control" name="exam_id" required>
                                    <option value="">Select</option>
                                    @foreach ($getExam as $exam)
                                        <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                <a href="{{ route('students_in_term') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="row">
                        <div class="col-md-12">
                            @include('_message')

                            <div class="col-md-12">
                                @if(!empty(Request::get('exam_id')))
                                    <div class="card-header">
                                        {{-- <h3 class="card-title">Total Students: {{ $getStudentCount }}</h3> --}}
                                        <button class="btn btn-secondary"><p style="margin: 12px;" style="font-size:25px;">Total Number of Students is:  <span style="color: brown; font-size:28px;">{{ $getStudentCount }}</span></p></button>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
