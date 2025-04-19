@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Admin List : ({{ $getRecord->total() }}) Total Admins</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('admin.add') }}" class="btn btn-primary">Add New Admin</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Admin</h3>
            </div>
            
            <form method="get" action="">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    {{-- <label>Name</label> --}}
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ Request::get('name') }}">
                  </div>

                  {{-- <div class="form-group col-md-3">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
                  </div> --}}

                  {{-- <div class="form-group col-md-3">
                    <label>Date</label>
                    <input type="date" class="form-control" name="date" placeholder="Enter date" value="{{ Request::get('date') }}">
                  </div> --}}

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="">Search</button>
                    <a href="{{ route('admin.list') }}" class="btn btn-success" style="">Refresh</a>
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
              <h3 class="card-title">Admin List</h3>
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
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Admin Type</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($getRecord as $value)
                    <tr>
                      <td>{{ $id++ }}</td>
                      <td>
                        @if (!empty($value->getProfileDirect()))
                          <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                        @endif
                      </td>
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->user_type }}</td>
                      <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 100px;">
                        <a href="{{ route('admin.edit', [$value->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ url('admin/admin/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>
                        
                        {{-- <a href="{{ url('admin/admin/delete/'.$value->id) }}" class="btn btn-danger">Delete</a> --}}
                        {{-- <a href="{{ url('chat?receiver_id=/'.base64_encode($value->id)) }}" class="btn btn-success">Send Message</a> --}}
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