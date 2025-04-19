@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Teacher List : ({{ $getRecord->total() }}) Total Teachers</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('teacher.add') }}" class="btn btn-primary">Add New Teacher</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Search Teacher</h3>
        </div>
        
        <form method="get" action=" ">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Search Staff Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Staff Name" value="{{ Request::get('name') }}">
              </div>

              {{-- <div class="form-group col-md-2">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
              </div> --}}

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
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" value="{{ Request::get('mobile_number') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Marital Status</label>
                <input type="text" class="form-control" name="marital_status" placeholder="Marital Status" value="{{ Request::get('marital_status') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Address</label>
                <input type="text" class="form-control" name="address" placeholder="Address" value="{{ Request::get('address') }}">
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
                <label>Date of Joining</label>
                <input type="date" class="form-control" name="admission_date"  value="{{ Request::get('admission_date') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Created Date</label>
                <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
              </div> --}}

              <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                <a href="{{ route('teacher.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Teacher List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Teacher Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Date of Joining</th>
                    <th>Mobile Number</th>
                    <th>Marital Status</th>
                    <th>Current Address</th>
                    <th>Permanent Address</th>
                    <th>Qualification</th>
                    <th>Work Experience</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Password</th>
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
                      <td>
                        @if (!empty($value->getProfileDirect()))
                          <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                        @endif
                        
                      </td>
                      <td>{{ $value->name }} {{ $value->last_name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->gender }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->admission_date)) }}</td>
                      <td>{{ $value->mobile_number }}</td>
                      <td>{{ $value->marital_status }}</td>
                      <td>{{ $value->address }}</td>
                      <td>{{ $value->permanent_address }}</td>
                      <td>{{ $value->qualification }}</td>
                      <td>{{ $value->work_experience }}</td>
                      <td>{{ $value->note }}</td>
                      <td>{{ ($value->status == 0) ? 'Active' :'Inactive' }}</td>
                      <td>{{ $value->keep_track }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 200px;">
                        <a href="{{ route('teacher.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ url('admin/teacher/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>

                        {{-- <a href="{{ url('admin/teacher/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
                        {{-- <a href="{{ url('chat?receiver_id=/'.base64_encode($value->id)) }}" class="btn btn-success btn-sm">Send Message</a> --}}
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