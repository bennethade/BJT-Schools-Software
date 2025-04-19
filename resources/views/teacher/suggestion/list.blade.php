@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Feedback/Suggestion Box</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('teacher.suggestion.add') }}" class="btn btn-primary">Make a Suggestion/Feedback</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Suggestion</h3>
            </div>
            
            <form method="get" action="">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" name="title" placeholder="Search Here" value="{{ Request::get('title') }}">
                  </div>


                  <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="">Search</button>
                    <a href="{{ route('teacher.suggestion.list') }}" class="btn btn-success" style="">Refresh</a>
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
         
        <!-- /.col -->
        <div class="col-md-12">

          @include('_message')

          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Suggestion/Feedback List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1;
                  @endphp
                  <tr>
                    <th>S/N</th>
                    <th>Title</th>
                    <th style="min-width: 450px;">Description</th>
                    <th>Status</th>
                    <th  style="min-width: 120px;">Sent By</th>
                    <th>Sent Date</th>
                    {{-- <th>Action</th> --}}
                  </tr>
                </thead>
                <tbody>
                  @forelse ($getRecord as $value)
                      <tr>
                      <td>{{ $id++ }}</td>
                      <td>{{ $value->title }}</td>
                      <td>{{ $value->description }}</td>
                      <td>
                        @if ($value->status == 1)
                            <p class="badge badge-success">Active</p>
                        @else
                            <p class="badge badge-warning">Received</p>
                        @endif
                      </td>
                      <td>{{ $value->created_by_name }} {{ $value->created_by_last_name }}</td>
                      <td>{{ date('d-M-Y H:i:A', strtotime($value->created_at)) }}</td>
                      {{-- <td style="min-width: 150px;">
                        <a href="{{ route('suggestion.edit', [$value->id]) }}" class="btn btn-sm btn-primary">Edit</a>

                        <form action="{{ url('admin/suggestion/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>
                      </td> --}}
                    </tr>
                  @empty
                      <tr>
                        <td colspan="100%">
                            <p style="color: red;">No suggestion/feedback record found!</p>
                        </td>
                      </tr>
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