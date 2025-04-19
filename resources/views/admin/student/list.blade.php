@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Student List : ({{ $getRecord->total() }}) Total Students</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('student.add') }}" class="btn btn-primary">Add New Student</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Search Student</h3>
        </div>
        
        <form method="get" action=" ">
          <div class="card-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label>Search Student Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Student Name" value="{{ Request::get('name') }}">
              </div>

              {{-- <div class="form-group col-md-2">
                <label>Surname</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Admission Number</label>
                <input type="text" class="form-control" name="admission_number" placeholder="Admission Number" value="{{ Request::get('admission_number') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Roll Number</label>
                <input type="text" class="form-control" name="roll_number" placeholder="Roll Number" value="{{ Request::get('roll_number') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Class</label>
                <input type="text" class="form-control" name="class" placeholder="Class" value="{{ Request::get('class') }}">
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
                <label>Caste</label>
                <input type="text" class="form-control" name="caste" placeholder="Caste" value="{{ Request::get('caste') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Religion</label>
                <input type="text" class="form-control" name="religion" placeholder="religion" value="{{ Request::get('religion') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Mobile Number</label>
                <input type="text" class="form-control" name="mobile_number" placeholder="Mobile Number" value="{{ Request::get('mobile_number') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Blood Group</label>
                <input type="text" class="form-control" name="blood_group" placeholder="Blood Group" value="{{ Request::get('blood_group') }}">
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
                <label>Admission Date</label>
                <input type="date" class="form-control" name="admission_date"  value="{{ Request::get('admission_date') }}">
              </div> --}}


              {{-- <div class="form-group col-md-2">
                <label>Created Date</label>
                <input type="date" class="form-control" name="date" value="{{ Request::get('date') }}">
              </div> --}}

              <div class="form-group col-md-3">
                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                <a href="{{ route('student.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
              <h3 class="card-title">Student List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Student Name</th>
                    <th>Parent Name</th>
                    <th>Email</th>
                    <th>Admission Number</th>
                    <th>Roll Number</th>
                    <th>Class</th>
                    <th>Gender</th>
                    <th>Date Of Birth</th>
                    <th>Caste</th>
                    <th>Religion</th>
                    <th>Mobile Number</th>
                    <th>Admission Date</th>
                    <th>Blood Group</th>
                    <th>Height</th>
                    <th>Weight</th>
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
                      <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                      <td>{{ $value->parent_name }} {{ $value->parent_last_name }}</td>
                      <td>{{ $value->email }}</td>
                      <td>{{ $value->admission_number }}</td>
                      <td>{{ $value->roll_number }}</td>
                      <td>{{ $value->class_name }}</td>
                      <td>{{ $value->gender }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->date_of_birth)) }}</td>
                      <td>{{ $value->caste }}</td>
                      <td>{{ $value->religion }}</td>
                      <td>{{ $value->mobile_number }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->admission_date)) }}</td>
                      <td>{{ $value->blood_group }}</td>
                      <td>{{ $value->height }}</td>
                      <td>{{ $value->weight }}</td>
                      <td>{{ ($value->status == 0) ? 'Active' :'Inactive' }}</td>
                      <td>{{ $value->keep_track }}</td>
                      <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 150px;">
                        <a href="{{ route('student.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>

                        <form action="{{ url('admin/student/delete/'.$value->id) }}" method="POST" class="d-inline-block delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger delete">Delete</button>
                        </form>


                        {{-- <a href="{{ url('admin/student/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a> --}}
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