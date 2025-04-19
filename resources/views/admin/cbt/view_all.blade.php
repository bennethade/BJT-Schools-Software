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
          <h1 style="">All CBT Exams</h1>
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
            <div class="card-header">
              <h3 class="card-title">Search CBT</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" name="name" placeholder="Search Here" value="{{ Request::get('name') }}">
                    </div>

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="">Search</button>
                    <a href="{{ route('cbt.view.all') }}" class="btn btn-success" style="">Refresh</a>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </form>
          </div>
          
    </div>
  </section>



  <!-- Main content -->
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
                    <th>Class Name</th>
                    <th>Subject Name</th>
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
                            <td style="min-width: 150px">{{ $cbt->class->name }} <br> <small>{{ $cbt->class->description }}</small></td>
                            <td style="min-width: 200px">{{ $cbt->subject->name }}</td>
                            <td>{{ $cbt->duration }} Min.</td>
                            <td>
                                @if ($cbt->status == 1 )
                                    <p class="badge badge-success">Active</p>
                                @else
                                    <p class="badge badge-warning">Inactive</p>
                                @endif
                            </td>
                            <td style="min-width: 120px">{{ $cbt->user->last_name }} {{ $cbt->user->name }} {{ $cbt->user->other_name }}</td>
                            <td style="min-width: 120px">
                                @if ($cbt->updatedBy)
                                    {{ $cbt->updatedBy->last_name }} {{ $cbt->updatedBy->name }} {{ $cbt->updatedBy->other_name }}
                                @else
                                    <em></em>
                                @endif
                            </td>
                            <td style="min-width: 120px">{{ $cbt->created_at->format('d-M-Y') }}</td>
                            
                            <td style="min-width: 110px;">
                                <a href="{{ route('cbt.assign', $cbt->id) }}" class="btn btn-sm btn-success">Assign CBT</a> <br><br>
                            </td>

                            <td>

                                <div class="dropdown">
                                    <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton{{ $cbt->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        More
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $cbt->id }}">
                                        <a class=" d-inline-block dropdown-item badge badge-success text-white mb-1" href="{{ route('cbt.edit', $cbt->id) }}">Edit</a>
                                        
                                        <a class="d-inline-block dropdown-item badge badge-primary text-white mb-1" href="{{ route('cbt.view_questions', $cbt->id) }}">View Questions</a>
                                        

                                        {{-- DELETE BUTTON FROM CHATGPT --}}
                                        {{-- <form action="{{ route('cbt.delete', $cbt->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item badge badge-danger text-white mb-1" type="submit" onclick="return confirm('Are you sure you want to delete this exam?');">Delete CBT</button>
                                        </form> --}}

                                        <form action="{{ route('cbt.delete', $cbt->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="dropdown-item badge custom-delete-btn mb-1" type="submit" 
                                                onclick="return confirm('Are you sure you want to delete this CBT?');"> Delete CBT
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

</div>





<!-- Add CBT Modal -->
<div class="modal fade" id="addCBTModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="message-text" class="col-form-label">Enter CBT Exam Name <span style="color: red;">*</span> </label>
                        <textarea placeholder="Exam Name Here" class="form-control" name="exam_title" required></textarea>
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
                        <label class="col-form-label">Choose Subject <span style="color: red;">*</span></label>
                        <select class="form-control" name="subject_id" required>
                            <option value="">Select</option>
                            @foreach ($getSubject as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label class="col-form-label" for="duration">Exam Duration (in minutes): <span style="color: red;">*</span></label>
                        <input type="number" name="duration" class="form-control" placeholder="Enter duration in minutes" min="1" max="240" required>
                        <small class="form-text text-muted">
                            Please specify the duration of the exam (e.g., 30, 60, 90...)
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



<!-- Edit Modal -->
<div class="modal fade" id="editGoalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Subject Goal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" action="">
                {{ csrf_field() }}
                {{ method_field('PUT') }}

                <div class="modal-body">
                    <div class="form-group">
                        {{-- <label for="recipient-name" class="col-form-label">Class Name: {{ $getClassName->name }} {{ $getClassName->description }}</label>
                        <input type="hidden" name="class_id" value="{{ $getClassName->id }}"> --}}
                    </div>

                    <div class="form-group">
                        {{-- <label for="recipient-name" class="col-form-label">Term Name: {{ $getTermName->name }} {{ $getTermName->session }}</label>
                        <input type="hidden" name="exam_id" value="{{ $getTermName->id }}"> --}}
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Enter Subject Goal <span style="color: red;">*</span> </label>
                        <textarea class="form-control" name="subject_goal" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Choose Subject Category <span style="color: red;">*</span></label>
                        <select class="form-control" name="subject_category_id" required>
                            <option value="">Select</option>
                            {{-- @foreach ($subjectCategory as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach --}}
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Status <span style="color: red;">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
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
        $(document).ready(function() {
            
            $('#addCBT').click(function() {
                $('#addCBTModal').modal('show');
            });

            $('.editGoalBtn').click(function() {
                var goalId = $(this).data('id');
                var goalName = $(this).data('name');
                var categoryId = $(this).data('category');
                var status = $(this).data('status');

                $('#editGoalModal [name="subject_goal"]').val(goalName);
                $('#editGoalModal [name="subject_category_id"]').val(categoryId);
                $('#editGoalModal [name="status"]').val(status);

                // Update the form action with the correct ID
                $('#editGoalModal form').attr('action', '/admin/nursery_subjects/view/' + goalId);

                $('#editGoalModal').modal('show');
            });
        });
       

       

    </script>





@endsection