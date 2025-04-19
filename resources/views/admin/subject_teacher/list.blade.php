@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject Teachers</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ url('admin/subject_teacher/add') }}" class="btn btn-primary">Assign Subject To Teacher</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <!-- /.col -->
        <div class="col-md-12">


          <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Assigned Subject Teacher</h3>
            </div>
            <form method="get" action=" ">
               <div class="card-body">
                  <div class="row">
                     <div class="form-group col-md-3">
                        <label>Class Name</label>
                        <input type="text" class="form-control" name="class_name" placeholder="Search Class Name" value="{{ Request::get('class_name') }}">
                     </div>
                     <div class="form-group col-md-3">
                        <label>Teacher Name</label>
                        <input type="text" class="form-control" name="teacher_name" placeholder="Search Teacher Name" value="{{ Request::get('teacher_name') }}">
                     </div>
                     <div class="form-group col-md-3">
                        <label>Subject Name</label>
                        <input type="text" class="form-control" name="subject_name" placeholder="Search Subject Name" value="{{ Request::get('subject_name') }}">
                     </div>
                     <div class="form-group col-md-2">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
                     </div>
                     <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('subject_teacher.view') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </form>
         </div>


          @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Assigned Subject Teacher List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1
                  @endphp
                  <tr>
                    <th>S/N</th>
                    <th>Teacher Name</th>
                    <th>Class Name</th>
                    <th>Term</th>
                    <th>Subject Name</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($getRecord as $value)
                    <tr>
                       <td>{{ $id++ }}</td>
                       <td>{{ $value->teacher_name }} {{ $value->teacher_last_name }} {{ $value->teacher_other_name }}</td>
                       <td>{{ $value->class_name }} {{ $value->class_description }}</td>
                       <td>{{ $value->exam_name }} {{ $value->exam_session }}</td>
                       <td>{{ $value->subject_name }} {{ $value->subject_description }}</td>
                       <td>{{ $value->created_by }}</td>
                       <td style="min-width: 200px;">
                          <a href="{{ route('subject_teacher.mass_edit', [$value->id]) }}" class="btn btn-sm btn-primary">Mass Edit</a>

                          <form action="{{ url('admin/subject_teacher/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                          </form>
                          
                          {{-- <a href="{{ url('admin/subject_teacher/delete/'.$value->id) }}" class="btn btn-danger">Delete</a> --}}
                       </td>
                    </tr>
                    @endforeach
                </tbody>
              </table>

                <div style="padding: 10px; float: right;">
                    {{-- {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }} --}}
                </div>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>



@endsection



@section('script')

<!--For SweetAlert2 Library-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
       $(function() {
           $('.delete').on('click', function(e) {
               e.preventDefault();
               var form = $(this).closest('form');
               Swal.fire({
                   title: "Are you sure?",
                   text: "You want to delete this record?",
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
    </script>


@endsection