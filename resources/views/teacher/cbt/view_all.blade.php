@extends('layouts.app')

@section('content')

            <style>
                .custom-delete-btn {
                    background-color: #dc3545;
                    color: white;
                    border: none;
                    transition: background-color 0.3s;
                }

                .custom-delete-btn:hover {
                    background-color: #931a26;
                    color: white;
                }
            </style>



            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-9">
                                <h1 style="">My Class CBT Exams</h1>
                            </div>

                            <div class="col-sm-3" style="text-align: right;">
                                <button type="button" class="btn btn-primary" id="addCBT">Add New CBT</button>
                            </div>

                        </div>
                    </div><!-- /.container-fluid -->
                </section>



                <section class="content">
                    <div class="container-fluid">
                        <div class="card">
                            {{-- <div class="card-header">
                            <h3 class="card-title">Search CBT</h3>
                            </div> --}}
                            <form method="get" action=" ">
                            <div class="card-body">
                                <div class="row">
                                    
                                    <div class="form-group col-md-4">
                                        <label>Class</label>
                                        <select class="form-control" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->class_id) ? 'selected' : '' }} value="{{ $class->class_id }}">{{ $class->class_name }} {{ $class->class_description }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label>Exam</label>
                                        <select class="form-control" name="exam_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getExam as $exam)
                                        <option {{ (Request::get('exam_id') == $exam->exam_id) ? 'selected' : '' }} value="{{ $exam->exam_id }}">{{ $exam->exam_name }} {{ $exam->exam_session }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                        <a href="{{ route('teacher.cbt.view.all') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            </form>
                        </div>
                    </div>
                </section>



                
                <!-- Main content -->
                @if (!empty(Request::get('class_id')) && !empty(Request::get('exam_id')))
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">

                                <!-- /.col -->
                                <div class="col-md-12">

                                    @include('_message')

                                    <!-- /.card -->

                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">CBT List</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body p-0" style="overflow: auto;">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>S/N</th>
                                                        <th>Exam Name</th>
                                                        <th>Class</th>
                                                        <th>Term</th>
                                                        <th>Subject Name</th>
                                                        <th>Max Score</th>
                                                        <th>Duration</th>
                                                        <th>Status</th>
                                                        <th>Created By</th>
                                                        <th>Updated By</th>
                                                        <th>Created Date</th>
                                                        <th style="min-width: 0px;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>

                                                    @php
                                                        $id = 1
                                                    @endphp

                                                    @forelse ($getRecord as $cbt)
                                                        <tr>
                                                            <td>{{ $id++ }}</td>
                                                            <td style="min-width: 250px">{{ $cbt->exam_title }}</td>
                                                            <td style="min-width: 150px">{{ $cbt->class->name }} <br>
                                                                <br><small>{{ $cbt->class->description }}</small>
                                                            </td>
                                                            <td style="min-width: 200px">{{ $cbt->term->name }} {{ $cbt->term->session }}</td>
                                                            <td style="min-width: 200px">{{ $cbt->subject->name }}</td>
                                                            <td>{{ $cbt->overall_score }}</td>
                                                            <td>{{ $cbt->duration }} Min.</td>
                                                            <td>
                                                                @if ($cbt->status == 1)
                                                                    <p class="badge badge-success">Active</p>
                                                                @else
                                                                    <p class="badge badge-warning">Inactive</p>
                                                                @endif
                                                            </td>
                                                            <td style="min-width: 120px">{{ $cbt->user->last_name }} {{ $cbt->user->name }}
                                                                {{ $cbt->user->other_name }}
                                                            </td>
                                                            <td style="min-width: 120px">
                                                                @if ($cbt->updatedBy)
                                                                    {{ $cbt->updatedBy->last_name }} {{ $cbt->updatedBy->name }}
                                                                    {{ $cbt->updatedBy->other_name }}
                                                                @else
                                                                    <em></em>
                                                                @endif
                                                            </td>
                                                            <td style="min-width: 120px">{{ $cbt->created_at->format('d-M-Y') }}</td>

                                                            <td style="min-width: 110px;">
                                                                <a href="{{ route('teacher.cbt.assign', $cbt->id) }}"
                                                                    class="btn btn-sm btn-success">Assign CBT</a> <br><br>
                                                            </td>

                                                            <td>

                                                                <div class="dropdown">
                                                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button"
                                                                        id="dropdownMenuButton{{ $cbt->id }}" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false">More
                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                        aria-labelledby="dropdownMenuButton{{ $cbt->id }}">
                                                                        <a class=" d-inline-block dropdown-item badge badge-success text-white mb-1"
                                                                            href="{{ route('teacher.cbt.edit', [$cbt->id, Request::get('class_id')]) }}">Edit</a>

                                                                        <a class="d-inline-block dropdown-item badge badge-primary text-white mb-1"
                                                                            href="{{ route('teacher.cbt.view_questions', $cbt->id) }}">View Questions</a>

                                                                        <form action="{{ route('teacher.cbt.delete', $cbt->id) }}" method="POST"
                                                                            class="d-inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="dropdown-item badge custom-delete-btn mb-1"
                                                                                type="submit"
                                                                                onclick="return confirm('Are you sure you want to delete this CBT?');">
                                                                                Delete CBT
                                                                            </button>
                                                                        </form>

                                                                    </div>
                                                                </div>


                                                            </td>

                                                        </tr>
                                                    @empty

                                                    @endforelse

                                                </tbody>
                                            </table>

                                            <div style="padding: 10px; float: right;">
                                                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                @endif

            </div>





            <!-- Add CBT Modal -->
            <div class="modal fade" id="addCBTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add New CBT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <form action="" method="POST">
                            {{ csrf_field() }}
                            <div class="modal-body">

                                <div class="form-group">
                                    <label for="message-text" class="col-form-label">Enter CBT Exam Name <span
                                            style="color: red;">*</span> </label>
                                    <textarea placeholder="Exam Name Here" class="form-control" name="exam_title"
                                        required></textarea>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Choose Class <span style="color: red;">*</span></label>
                                    <select class="form-control" name="class_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getClass as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Choose Term <span style="color: red;">*</span></label>
                                    <select class="form-control" name="exam_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getExam as $exam)
                                            <option value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Choose Subject <span style="color: red;">*</span></label>
                                    <select class="form-control" name="subject_id" required>
                                        <option value="">Select</option>
                                        @foreach ($getSubject as $subject)
                                            <option value="{{ $subject->subject_id }}">{{ $subject->subject_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label class="col-form-label">Overall Score <span style="color: red;">*</span></label>
                                    <input type="text" name="overall_score" class="form-control" id="" required placeholder="E.g., 60, 100">
                                </div>


                                <div class="form-group">
                                    <label class="col-form-label" for="duration">Exam Duration (in minutes): <span
                                            style="color: red;">*</span></label>
                                    <input type="number" name="duration" class="form-control"
                                        placeholder="Enter duration in minutes" min="1" max="240" required>
                                    <small class="form-text text-muted">
                                        Specify the duration of the exam (e.g., 30, 60, 90...)
                                    </small>
                                </div>


                                <div class="form-group">
                                    <label class="col-form-label">Status <span style="color: red;">*</span></label>
                                    <select class="form-control" name="status" required>
                                        <option value="1">Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


@endsection




@section('script')

    <!--For SweetAlert2 Library-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>

        //FOR ADDING AND EDITING
        $(document).ready(function () {

            $('#addCBT').click(function () {
                $('#addCBTModal').modal('show');
            });

            // $('.editGoalBtn').click(function () {
            //     var goalId = $(this).data('id');
            //     var goalName = $(this).data('name');
            //     var categoryId = $(this).data('category');
            //     var status = $(this).data('status');

            //     $('#editGoalModal [name="subject_goal"]').val(goalName);
            //     $('#editGoalModal [name="subject_category_id"]').val(categoryId);
            //     $('#editGoalModal [name="status"]').val(status);

            //     // Update the form action with the correct ID
            //     $('#editGoalModal form').attr('action', '/admin/nursery_subjects/view/' + goalId);

            //     $('#editGoalModal').modal('show');
            // });
        });




    </script>





@endsection