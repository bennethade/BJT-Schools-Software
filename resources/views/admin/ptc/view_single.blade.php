@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @if(!empty($getStudent))
                    <div class="col-sm-6">
                        <h1>View <span style="color: blue"> {{ $getStudent->student_name }} {{ $getStudent->student_last_name }} {{ $getStudent->student_other_name }}</span>'s PTC</h1>
                    </div>

                    <div class="col-sm-6">
                        <a href="{{ url('admin/ptc/print_single?class_id=' . $getSingleClassName->id . '&exam_id=' . $getSingleExamName->id . '&student_id=' . $getStudent->student_id) }}" class="btn btn-sm btn-warning" style="float: right;" target="_blank">Print PTC</a>
                    </div>
                @endif
            </div>
        </div>
    </section>
   

   <section class="content">
      <div class="container-fluid">
            <div class="card">

                @include('_message')

            
                <table class="table table-striped">
                    <thead>
                    @php
                        $id = 1
                    @endphp
                    <tr>
                        <th>S/N</th>
                        <th>Subject Name</th>
                        <th>PTC Feedback Comment</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse ($getStudentPTC as $value)
                            <tr>
                                <td>{{ $id++ }}</td>
                                <td>{{ $value->subject_name }}</td>
                                <td>{{ $value->comment }}</td>
                                {{-- <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align: center; color:red">Please go back and enter PTC subject comments/feedbacks</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            
            </div>
      </div>
   </section>



   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <!-- /.col -->
            <div class="col-md-12">
              
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">PTC General Comment</h3>
                    </div>
                    
                    @if (!empty($getStudentPTC) && $getStudentPTC->count() > 0)

                        <form method="POST" action="">
                            @csrf
                            <div class="card-body" style="overflow: auto">
                                {{-- <div class="row"> --}}

                                    <input type="hidden" name="class_id" value="{{ $getSingleClassName->id }}">
                                    <input type="hidden" name="exam_id" value="{{ $getSingleExamName->id }}">
                                    @if (!empty($getStudent))
                                        <input type="hidden" name="student_id" value="{{ $getStudent->student_id }}">
                                    @endif



                                    <div class="form-group col-md-4 float-left">
                                        <label>Teacher's Comment</label><br>
                                        <textarea required name="teacher_comment" id="" cols="" rows="8" placeholder="Teacher's Comment" class="form-control" style="width: 300px;">@if(!empty($getPTCGeneralComment)) {{ $getPTCGeneralComment->teacher_comment }} @endif</textarea>

                                    </div>

                                    <div class="form-group col-md-4 float-right">
                                        <label>Parent's Comment</label><br>
                                        <textarea readonly name="parent_comment" id="" cols="" rows="8" placeholder="Parent's Comment" class="form-control" style="width: 300px;">@if(!empty($getPTCGeneralComment)) {{ $getPTCGeneralComment->parent_comment }} @endif</textarea>
                                        {{-- <textarea name="parent_comment" id="" cols="" rows="6" placeholder="Parent Comment" class="form-control" style="width: 250px;">{{ !empty($getPTC->comment) ? $getPTC->comment : '' }}</textarea> --}}
                                    </div>
                                    
                                {{-- </div> --}}
                                
                            </div>
                            
                            
                            <div style="text-align: center; margin:20px;">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>    
                        </form>
                    @endif
                </div>
                
            </div>
         </div>
         
      </div>
   </section>
</div>
@endsection



@section('script')

<script type="text/javascript">

</script>

@endsection