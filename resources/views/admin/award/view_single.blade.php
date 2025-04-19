@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                @if(!empty($getStudent))
                    <div class="col-sm-6">
                        <h1>View <span style="color: blue"> {{ $getStudent->name }} {{ $getStudent->last_name }} {{ $getStudent->other_name }}</span>'s Awards</h1>
                    </div>

                    <div class="col-sm-6">
                        <h1 style="color: blue"></h1>
                        
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
                        <th>Award Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        @if (!empty($getAwards->early_bird))
                            <tr>
                                <td>Early Bird Award</td>
                                <td><a href="{{ url('admin/award/print_single/early_bird?class_id=' . $getSingleClassName->id . '&exam_id=' . $getSingleExamName->id . '&student_id=' . $getStudent->id) }}" class="btn btn-sm btn-warning" target="_blank">Print Award</a></td>
                            </tr>
                        @endif
                        
                        @if (!empty($getAwards->neatest_pupil))
                            <tr>
                                <td>Neatest Pupil Award</td>
                                <td><a href="{{ url('admin/award/print_single/neatest_pupil?class_id=' . $getSingleClassName->id . '&exam_id=' . $getSingleExamName->id . '&student_id=' . $getStudent->id) }}" class="btn btn-sm btn-warning" target="_blank">Print Award</a></td>
                            </tr>
                        @endif
                        
                        @if (!empty($getAwards->best_behaved_pupil))
                            <tr>
                                <td>Best Behaved Pupil Award</td>
                                <td><a href="{{ url('admin/award/print_single/best_behaved_pupil?class_id=' . $getSingleClassName->id . '&exam_id=' . $getSingleExamName->id . '&student_id=' . $getStudent->id) }}" class="btn btn-sm btn-warning" target="_blank">Print Award</a></td>
                            </tr>
                        @endif
                        
                    </tbody>
                </table>
            
            </div>
      </div>
   </section>

   
</div>
@endsection



@section('script')

<script type="text/javascript">

</script>

@endsection