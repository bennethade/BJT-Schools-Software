@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject List </h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('subject.add') }}" class="btn btn-primary">Add New Subject</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Subject</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  
                    <div class="form-group col-md-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ Request::get('name') }}">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Subject Type</label>
                        <select class="form-control" name="type">
                            <option value="">Select Type</option>
                            <option {{ ( Request::get('type') == 'theory') ? 'selected' : '' }} value="theory">Theory</option>
                            <option {{ ( Request::get('type') == 'practical' ) ? 'selected' : '' }} value="practical">Practical</option>
                        </select>
                    </div>


                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" placeholder="Enter date" value="{{ Request::get('date') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('subject.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Subject List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Subject Name</th>
                    <th>Subject Type</th>
                    {{-- <th>Subject Category</th> --}}
                    <th>School Section</th>
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

                  @foreach ($getRecord as $value)
                      <tr>
                        <td>{{ $id++ }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->type }}</td>
                        {{-- <td>{{ $value->subject_category }}</td> --}}
                        <td>{{ $value->school_section }}</td>
                        <td>
                            @if ($value->status == 0)
                                Active
                            @else
                                Inactive
                                
                            @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 150px;">
                            <a href="{{ route('subject.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ url('admin/subject/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                               @csrf
                               @method('DELETE')
                               {{-- <button type="submit" class="btn btn-sm btn-danger delete">Delete</button> --}}
                            </form>

                            {{-- <a href="{{ url('admin/subject/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                        </td>
                      </tr>
                  @endforeach
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