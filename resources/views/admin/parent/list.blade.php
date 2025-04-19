@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Parent List : ({{ $getRecord->total() }}) Total Parent</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('parent.add') }}" class="btn btn-primary">Add New Parent</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Search Parent</h3>
        </div>
        
        <form method="get" action=" ">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Search Parent Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Parent Name" value="{{ Request::get('name') }}">
              </div>

              {{-- <div class="form-group col-md-2">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
              </div>   --}}

              {{-- <div class="form-group col-md-2">
                <label>Gender</label>
                <select name="gender" id="" class="form-control">
                  <option value="">Select Gender</option> 
                  <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                  <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                  <option {{ (Request::get('gender') == 'Other') ? 'selected' : '' }} value="Other">Other</option> 
                </select>
              </div> --}}
              
              
              {{-- <div class="form-group col-md-2">
                <label>Occupation</label>
                <input type="text" class="form-control" name="occupation" placeholder="Occupation" value="{{ Request::get('occupation') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ Request::get('address') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" value="{{ Request::get('mobile_number') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Status</label>
                <select name="status" id="" class="form-control">
                  <option value="">Select Status</option> 
                  <option {{ (Request::get('status') == 100) ? 'selected' : '' }} value="100">Active</option> 
                  <option {{ (Request::get('status') == 1) ? 'selected' : '' }} value="1">Inactive</option> 
                </select>
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Created Date</label>
                <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
              </div> --}}

              <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                <a href="{{ route('parent.list') }}" class="btn btn-success" style="margin-top: 32px;">Reset</a>
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
              <h3 class="card-title">Parent List</h3>
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
                    <th>Photo</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Gender</th>
                    <th>Mobile Number</th>
                    <th>Ocupation</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th>Creaded Date</th>
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
                      <td style="min-width: 100px;">{{ $value->title }}</td>
                      <td style="min-width: 150px;">{{ $value->name }} {{ $value->other_name }} {{ $value->last_name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->keep_track }}</td>
                      <td>{{ $value->gender }}</td>
                      <td>{{ $value->mobile_number }}</td>
                      <td>{{ $value->occupation }}</td>
                      <td>{{ $value->address }}</td>
                      <td>{{ ($value->status == 0) ? 'Active' : 'Inactive' }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>

                      <td  style="min-width: 250px;">
                        <a href="{{ route('parent.edit', [$value->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ url('admin/parent/my-student/'.$value->id) }}" class="btn btn-primary btn-sm">My Student</a>

                        <form action="{{ url('admin/parent/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>

                        {{-- <a href="{{ url('admin/parent/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                        {{-- <a href="{{ url('chat?receiver_id=/'.base64_encode($value->id)) }}" class="btn btn-success btn-sm">Send Message</a> --}}
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>

              <div style="padding: 10px; float: right;">
                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}

                
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