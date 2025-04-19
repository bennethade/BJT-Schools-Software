@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Club List</h1>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="{{ route('club.add') }}" class="btn btn-primary">Add New Club</a>
                </div>
            </div>
        </div>
    </section>



    <section class="content">
        <div class="container-fluid">
    
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Search Club</h3>
                </div>
                
                <form method="get" action="">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                {{-- <label>Club Name</label> --}}
                                <input type="text" class="form-control" name="name" placeholder="Search Club Name Here" value="{{ Request::get('name') }}">
                            </div>

                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary" style="">Search</button>
                                <a href="{{ route('club.list') }}" class="btn btn-success" style="">Refresh</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>



  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <div class="col-md-12">

          @include('_message')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Club List</h3>
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
                    <th>Club Name</th>
                    <th>Description</th>
                    <th>Club Amount</th>
                    <th>Status</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($getRecord as $value)
                    <tr>
                      <td>{{ $id++ }}</td>
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->description }}</td>
                      <td>{{ number_format($value->amount, 0, '.', ',') }}</td>
                        <td>
                            @if ($value->status == 1)
                                <p class="badge badge-success">Active</p>
                            @else
                                <p class="badge badge-warning">Inactive</p>
                            @endif
                        </td>
                      <td>{{ date('d-M-Y', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 150px;">
                        <a href="{{ route('club.edit', [$value->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ url('admin/school_club/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>
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