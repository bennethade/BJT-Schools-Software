@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Edit CBT Assignment for: <span style="color: brown;">{{ $getCbtExam->exam_title }}</span></h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('_message')

                    <div class="card card-primary">
                        <form method="POST" action="{{ route('teacher.cbt.assigned_list.update', $getRecord->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Assigned Term</label>
                                    <select class="form-control" name="exam_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getExam as $exam)
                                            <option value="{{ $exam->id }}" 
                                                {{ $exam->id == $getRecord->exam_id ? 'selected' : '' }}>
                                                {{ $exam->name }} {{ $exam->session }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Assigned Class</label>
                                    <select class="form-control" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                            <option value="{{ $class->id }}" 
                                                {{ $class->id == $getRecord->class_id ? 'selected' : '' }}>
                                                {{ $class->class_name }} {{ $class->class_description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="1" {{ $getRecord->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $getRecord->status == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
