@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Term List : ({{ $getRecord->total() }}) Total Exams</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('examinations.add') }}" class="btn btn-primary">Add New Term</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Term</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Term Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Term Name" value="{{ Request::get('name') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" placeholder="Enter date" value="{{ Request::get('date') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('examinations.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Term List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1
                  @endphp
                  <tr>
                    <th>#</th>
                    <th>Term Name</th>
                    <th>Session</th>
                    <th>No. Of Times School Opened</th>
                    <th>This Term Commenced</th>
                    <th>This Term Ends</th>
                    <th>Next Term Begins</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($getRecord as $value)
                    <tr>
                      <td>{{ $value->id }}</td>
                      <td width="150px">{{ $value->name }}</td>
                      <td width="150px">{{ $value->session }}</td>
                      <td>{{ $value->no_of_times_school_opened }}</td>
                      <td width="180px">{{ $value->this_term_commenced }}</td>
                      <td width="180px">{{ $value->this_term_ends }}</td>
                      <td width="150px">{{ $value->next_term_begins }}</td>
                      <td>{{ $value->created_by }}</td>
                      <td width="150px">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 150px;">
                        <a href="{{ route('examinations.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ url('admin/examinations/exam/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            {{-- <button type="submit" class="btn btn-sm btn-danger delete">Delete</button> --}}
                        </form>
                        
                        {{-- <a href="{{ route('examinations.delete', [$value->id]) }}" class="btn btn-danger btn-sm">Delete</a> --}}
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