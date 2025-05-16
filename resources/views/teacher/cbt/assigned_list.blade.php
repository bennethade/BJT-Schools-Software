@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-9">
          <h1>Assigned CBT List: <small style="color: brown;">({{ $getRecord->count() }} CBT(s))</small></h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          {{-- <a href="{{ route('admin.add') }}" class="btn btn-primary">Add New Admin</a> --}}
          
        </div>
        
      </div>
    </div>
  </section>



    {{-- <section class="content">
        <div class="container-fluid">
        
            <div class="card">
                <div class="card-header">
                <h3 class="card-title">Search CBT</h3>
                </div>
                
                <form method="get" action="">
                <div class="card-body">
                    <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Search CBT Here" value="{{ Request::get('name') }}">
                    </div>

                    
                    <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('teacher.cbt.assigned.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                    </div>
                    
                    </div>
                </div>
                </form>
            </div>
            
        </div>
    </section> --}}



     @include('_message')
     
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
                            <a href="{{ route('teacher.cbt.assigned.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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

                {{-- @include('_message') --}}

                <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Assigned CBT List</h3>
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
                                <th style="min-width: 250px">Exam Name</th>
                                <th style="min-width: 220px">Subject</th>
                                <th style="min-width: 150px">Assigned Class</th>
                                <th style="min-width: 150px">Assigned Term</th>
                                <th style="min-width: 130px">Exam Duration</th>
                                <th style="min-width: 100px">Status</th>
                                <th style="min-width: 150px">Assigned By</th>
                                <th style="min-width: 150px">Assigned Date</th>
                                <th style="min-width: 160px">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($getRecord as $value)
                                <tr>
                                    <td>{{ $id++ }}</td>
                                    <td>{{ $value->exam_title }}</td>
                                    <td>{{ $value->subject_name }}</td>
                                    <td>{{ $value->class_name }} <br> <small>{{ $value->class_description }}</small></td>
                                    <td>{{ $value->exam_name }} <br> <small>{{ $value->exam_session }}</small></td>
                                    <td>{{ $value->duration }} Min.</td>
                                    <td>
                                        @if ($value->status == 1 )
                                            <p class="badge badge-success">Active</p>
                                        @else
                                            <p class="badge badge-warning">Inactive</p>
                                        @endif
                                    </td>

                                    <td>{{ $value->created_by_name }} {{ $value->created_by_last_name }}</td>

                                    <td>{{ $value->created_at->format('d-M-Y') }}</td>

                                    <td>
                                        <a href="{{ route('teacher.cbt.assigned_list.edit', [$value->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                                        <form action="{{ url('teacher/cbt/assign/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger delete">Unassign</button>
                                        </form>
                                        
                                    </td>
                                </tr>                                
                            @empty
                                <td colspan="100%">
                                    <p style="color: red">No Assigned CBT found for the chosen class and term</p>
                                </td>                                
                            @endforelse
                            </tbody>
                        </table>

                        <div style="padding: 10px; float: right;">
                            {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}

                            {{-- {{ $getRecord->links() }} --}}


                            {{--
                            GO TO APPSERVICEPROVIDER AND ADD THE CODE BELOW FOR THIS PAGINATION TO WORK PROPERLY


                                public function boot(): void
                                {
                                    paginator::useBootstrap();
                                }
                            --}}
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        
        </div>
    </section>
  @endif
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
                   text: "You want to unassign this CBT?",
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