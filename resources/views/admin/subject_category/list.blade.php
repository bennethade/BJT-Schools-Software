@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Subject Category List </h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('subject.category.add') }}" class="btn btn-primary">Add New Category</a>
          
        </div>
        
      </div>
    </div>
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Category</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  
                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ Request::get('name') }}">
                    </div>

                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('subject.category.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Subject Category List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>S/N</th>
                    <th>Category Name</th>
                    <th>Category Color</th>
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
                        <td>{{ $value->color }}</td>
                        <td>
                            @if ($value->status == 1)
                                Active
                            @else
                                Inactive
                                
                            @endif
                        </td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                        <td style="min-width: 150px;">
                            <a href="{{ route('subject.category.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                            <form action="{{ url('admin/subject_category/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                               @csrf
                               @method('DELETE')
                               {{-- <button type="submit" class="btn btn-sm btn-danger delete">Delete</button> --}}
                            </form>

                            {{-- <a href="{{ url('admin/subject_category/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>

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