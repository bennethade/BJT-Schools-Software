@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Term</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Term Name</label>
                    <input type="text" class="form-control" name="name" required placeholder="Enter Term Name Here" value="{{ old('name') }}">
                  </div>

                  <div class="form-group">
                    <label>Session</label>
                    <input type="text" class="form-control" name="exam_session" required placeholder="Enter Academic Session Here" value="{{ old('exam_session') }}">
                  </div>

                  <div class="form-group">
                    <label>Note</label>
                    <textarea name="note" class="form-control" cols="10" rows="3" placeholder="Description"></textarea>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-6">
                      <label>Number Of Times School Opened</label>
                      <input type="number" class="form-control" name="no_of_times_school_opened" placeholder="Enter Times School Opened" value="{{ old('no_of_times_school_opened') }}">
                    </div>

                    <div class="form-group col-md-6">
                      <label>School Stamp </label>
                      <input type="file" class="form-control" name="school_stamp" >
                      <div style="color: red;">{{ $errors->first('school_stamp') }}</div>
                    </div>

                  
                    <div class="form-group col-md-4">
                      <label>This Term Commenced</label>
                      <input type="date" class="form-control" name="this_term_commenced" value="{{ old('this_term_commenced') }}">
                    </div>

                    <div class="form-group col-md-4">
                      <label>This Term Ends</label>
                      <input type="date" class="form-control" name="this_term_ends" value="{{ old('this_term_ends') }}">
                    </div>
  
                    <div class="form-group col-md-4">
                      <label>Next Term Begins</label>
                      <input type="date" class="form-control" name="next_term_begins" value="{{ old('next_term_begins') }}">
                    </div>
                  </div>

                  <hr><hr>
                  <div class="text-center">
                    <label for="">NUMBER IN CLASS</label>
                  </div>

                  <div class="row">
                    <div class="form-group col-md-2">
                      <label>JSS1</label>
                      <input type="number" class="form-control" name="jss1_number" placeholder="JSS1" value="{{ old('jss1_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>JSS2</label>
                      <input type="number" class="form-control" name="jss2_number" placeholder="JSS2" value="{{ old('jss2_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>JSS3</label>
                      <input type="number" class="form-control" name="jss3_number" placeholder="JSS3" value="{{ old('jss3_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>SSS1</label>
                      <input type="number" class="form-control" name="sss1_number" placeholder="SSS1" value="{{ old('sss1_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>SSS2</label>
                      <input type="number" class="form-control" name="sss2_number" placeholder="SSS2" value="{{ old('sss2_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>SSS3</label>
                      <input type="number" class="form-control" name="sss3_number" placeholder="SSS3" value="{{ old('sss3_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Grade 1</label>
                      <input type="number" class="form-control" name="grade1_number" placeholder="Grade1" value="{{ old('grade1_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Grade 2</label>
                      <input type="number" class="form-control" name="grade2_number" placeholder="Grade2" value="{{ old('grade2_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Grade 3</label>
                      <input type="number" class="form-control" name="grade3_number" placeholder="Grade3" value="{{ old('grade3_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Grade 4</label>
                      <input type="number" class="form-control" name="grade4_number" placeholder="Grade4" value="{{ old('grade4_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Grade 5</label>
                      <input type="number" class="form-control" name="grade5_number" placeholder="Grade5" value="{{ old('grade5_number') }}">
                    </div>
                    <div class="form-group col-md-2">
                      <label>Grade 6</label>
                      <input type="number" class="form-control" name="grade6_number" placeholder="Grade6" value="{{ old('grade6_number') }}">
                    </div>

                    <div class="form-group col-md-2">
                      <label>EXPLORER TWO</label>
                      <input type="number" class="form-control" name="explorer2_number" placeholder="Explorer 2" value="{{ old('explorer2_number') }}">
                    </div>

                    <div class="form-group col-md-2">
                      <label>EXPLORER ONE</label>
                      <input type="number" class="form-control" name="explorer1_number" placeholder="Explorer 1" value="{{ old('explorer1_number') }}">
                    </div>

                    <div class="form-group col-md-2">
                      <label>PRE-NURSERY</label>
                      <input type="number" class="form-control" name="pre_nursery_number" placeholder="Pre Nursery" value="{{ old('pre_nursery_number') }}">
                    </div>

                    <div class="form-group col-md-2">
                      <label>PLAY PEN</label>
                      <input type="number" class="form-control" name="play_pen_number" placeholder="Play Pen" value="{{ old('play_pen_number') }}">
                    </div>

                  </div>


                  
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

          </div>
          <!--/.col (left) -->
          <!-- right column -->
          
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection