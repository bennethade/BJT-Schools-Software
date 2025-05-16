@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 style="color: brown">{{ $getClassName->name }} {{ $getClassName->description }} {{ $getTermName->name }} <span style="color: black">Mid Term Subject Goals</span> </h1>
        </div>
        <div class="col-sm-3" style="text-align: right;">
          <button type="button" class="btn btn-warning" id="autoGenerateGoals">Import Learning Objectives</button>
        </div>

        <div class="col-sm-3" style="text-align: right;">
          <button type="button" class="btn btn-primary" id="addGoal">Add Midterm Subject</button>
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Subject Goal</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  
                    <div class="form-group col-md-6">
                        <label>Search Goal Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name Here" value="{{ Request::get('name') }}">
                    </div>

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('teacher.midterm.nursery.subject.view',[$getClassName->id, $getTermName->id]) }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Subject Goal List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Subject Goal</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>

                  @php
                    $id = 1
                  @endphp

                  @forelse ($getRecord as $value)
                    <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->subject_category }}</td>
                        <td>
                            @if ($value->status == 1)
                                Active
                            @else
                                Inactive
                            @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 100px;">
                            <button type="button" class="btn btn-primary btn-sm editGoalBtn"
                                data-id="{{ $value->id }}"
                                data-name="{{ $value->name }}"
                                data-category="{{ $value->subject_category_id }}"
                                data-status="{{ $value->status }}">Edit</button>
                        </td>
                      </tr>
                  @empty
                    
                    <td colspan="100%">
                      <p style="color: red">
                        No Subjects added to this class for this term. Kindly click on the <span style="color: blue">"Add New Subject Goal"</span> button at the top to start adding subjects one after the oher. 
                          Or better still, click on the <span style="color: blue">"Auto Generate Subjects"</span> button to automatically add all subjects to this class.
                      </p>
                    </td>
                  @endforelse
                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                {{-- {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }} --}}
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

</div>



<!-- Auto Generate Modal -->
<div class="modal fade" id="autoGenerateGoalsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Auto Generate All Subject Goals For This Term</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Class Name: {{ $getClassName->name }} {{ $getClassName->description }}</label>
                        <input type="hidden" name="class_id" value="{{ $getClassName->id }}">
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Choose The Term To Import From <span style="color: red;">*</span></label>
                        <select class="form-control" name="previous_term_id" required>
                            <option value="">Select</option>
                            @foreach ($getExam as $exam)
                                <option value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">The Term To Import To: {{ $getTermName->name }} {{ $getTermName->session }}</label>
                        <input type="hidden" name="exam_id" value="{{ $getTermName->id }}">
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




<!-- Add Modal -->
<div class="modal fade" id="addGoalModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Subject</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form action="" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Class Name: {{ $getClassName->name }} {{ $getClassName->description }}</label>
                        <input type="hidden" name="class_id" value="{{ $getClassName->id }}">
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Term Name: {{ $getTermName->name }} {{ $getTermName->session }}</label>
                        <input type="hidden" name="exam_id" value="{{ $getTermName->id }}">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Enter Subject Goal <span style="color: red;">*</span> </label>
                        <textarea class="form-control" name="subject_goal" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Choose Subject Category <span style="color: red;">*</span></label>
                        <select class="form-control" name="subject_category_id" required>
                            <option value="">Select</option>
                            @foreach ($subjectCategory as $category)
                                <option value="{{ $category->subject_id }}">{{ $category->subject_name }}</option>
                            @endforeach
                        </select>
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
                        <label for="recipient-name" class="col-form-label">Class Name: {{ $getClassName->name }} {{ $getClassName->description }}</label>
                        <input type="hidden" name="class_id" value="{{ $getClassName->id }}">
                    </div>

                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Term Name: {{ $getTermName->name }} {{ $getTermName->session }}</label>
                        <input type="hidden" name="exam_id" value="{{ $getTermName->id }}">
                    </div>

                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Enter Subject Goal <span style="color: red;">*</span> </label>
                        <textarea class="form-control" name="subject_goal" required></textarea>
                    </div>

                    <div class="form-group">
                        <label class="col-form-label">Choose Subject Category <span style="color: red;">*</span></label>
                        <select class="form-control" name="subject_category_id" required>
                            <option value="">Select</option>
                            @foreach ($subjectCategory as $category)
                                <option value="{{ $category->subject_id }}">{{ $category->subject_name }}</option>
                            @endforeach
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

<script type="text/javascript">
    $(document).ready(function() {

      $('#autoGenerateGoals').click(function() {
          $('#autoGenerateGoalsModal').modal('show');
      });
      
      $('#addGoal').click(function() {
          $('#addGoalModal').modal('show');
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
          $('#editGoalModal form').attr('action', '/teacher/midterm/nursery_subjects/view/' + goalId);

          $('#editGoalModal').modal('show');
      });
  });


</script>



@endsection
