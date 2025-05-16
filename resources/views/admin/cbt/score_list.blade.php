@extends('layouts.app')

@section('content')

            <div class="content-wrapper">
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2 align-items-center">

                            @if (!empty($getCbtDetails))

                                <div class="col-sm-3">
                                    Test Name <hr>
                                    <h5 style="color: blue">{{ $getCbtDetails->cbtExam->exam_title }}</h5>
                                </div>

                                <div class="col-sm-2">
                                    Class   <hr>
                                    <h5 style="color: brown">{{ $getCbtDetails->class->name }}</h5>
                                </div>

                                <div class="col-sm-2">
                                    Term   <hr>
                                    <h5 style="color: green">
                                        {{ $getCbtDetails->term->name }}
                                        <span style="font-size: small">{{ $getCbtDetails->term->session }}</span>
                                    </h5>
                                </div>

                                <div class="col-sm-3">
                                    Subject   <hr>
                                    <h5 style="color: rgb(229, 134, 33)">{{ $getCbtDetails->cbtExam->subject->name }}</h5>
                                </div>

                                <div class="col-sm-2 text-right">
                                    <form
                                        action="{{ route('single.student.cbt.resetAll', [$getCbtDetails->class->id, $getCbtDetails->term->id, $getCbtDetails->cbtExam->id]) }}"
                                        method="POST" class="d-inline-block delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger deleteAll">Reset All Scores</button>
                                    </form>
                                </div>

                            @else
                                <div class="col-sm-12">
                                    <h5 style="color:red">All Scores for this CBT have been reset.</h5>
                                </div>
                            @endif

                        </div>
                    </div>
                </section>



                <section class="content">
                    <div class="container-fluid">
                        <div class="card" style="overflow: auto;">

                            @include('_message')


                            <table class="table table-striped">
                                <thead>
                                    @php
                                        $id = 1
                                    @endphp
                                    <tr>
                                        <th>S/N</th>
                                        <th>Student Name</th>
                                        <th>Score</th>
                                        <th>Date Taken</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($getCbtDetails))
                                        @forelse ($getSingleCBTScores as $value)
                                            <tr>
                                                <td>{{ $id++ }}</td>
                                                <td style="min-width: 200px">{{ $value->student->last_name }} {{ $value->student->name }}
                                                    {{ $value->student->other_name }}
                                                </td>
                                                <td>
                                                    @if ($value->score >= 50)
                                                        <p class="badge badge-success">{{ $value->score }}</p>
                                                    @else
                                                        <p class="badge badge-danger">{{ $value->score }}</p>
                                                    @endif
                                                </td>
                                                <td style="min-width: 120px">{{ date('d-M-Y', strtotime($value->completed_at)) }}</td>
                                                <td style="min-width: 150px">
                                                    <form
                                                        action="{{ route('single.student.cbt.reset', [$getCbtDetails->class->id, $getCbtDetails->term->id, $getCbtDetails->cbtExam->id, $value->student_id]) }}"
                                                        method="POST" class="d-inline-block delete-form">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-warning delete">Reset Score</button>
                                                    </form>
                                                </td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="100%" style="text-align: left; color:red">No scores found for this CBT</td>
                                            </tr>
                                        @endforelse
                                    @endif

                                </tbody>
                            </table>


                        </div>
                    </div>
                </section>




            </div>
@endsection


@section('script')

    <!--For SweetAlert2 Library-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(function () {
            $('.delete').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Are you sure?",
                    text: "You want to reset this Student's CBT Score?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });



        $(function () {
            $('.deleteAll').on('click', function (e) {
                e.preventDefault();
                var form = $(this).closest('form');
                Swal.fire({
                    title: "Do you mean it?",
                    text: "You are about to reset all the Students' CBT Scores for this Exam?",
                    icon: "error",
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    confirmButtonText: "Yes",
                    cancelButtonText: "No"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>


@endsection