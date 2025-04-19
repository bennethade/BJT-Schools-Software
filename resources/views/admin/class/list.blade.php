@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Class List </h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('class.add') }}" class="btn btn-primary">Add New Class</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Class</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ Request::get('name') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" placeholder="Enter date" value="{{ Request::get('date') }}">
                  </div>

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('class.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Class List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Section</th>
                    <th>Amount</th>
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
                        <td>{{ $value->description }}</td>
                        <td width="200px">{{ $value->section }}</td>
                        <td>N{{ number_format($value->amount ,2) }}</td>
                        <td>
                            @if ($value->status == 0)
                                Active
                            @else
                                Inactive
                                
                            @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td width="150px">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 200px;">
                            <a href="{{ route('assign_student.term_list', [$value->id]) }}" class="btn btn-warning btn-sm">View Class</a>
                            <a href="{{ route('class.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ url('admin/class/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                               @csrf
                               @method('DELETE')
                               {{-- <button type="submit" class="btn btn-sm btn-danger delete">Delete</button> --}}
                            </form>

                            {{-- <a href="{{ url('admin/class/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
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