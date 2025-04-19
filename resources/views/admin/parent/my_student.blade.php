@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>{{ $getParent->name }} {{ $getParent->last_name }}'s Student List</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>



  <section class="content">
    <div class="container-fluid">
      
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Search For Students</h3>
        </div>
        
        <form method="get" action=" ">
          <div class="card-body">
            <div class="row">
              {{-- <div class="form-group col-md-2">
                <label>Student ID</label>
                <input type="text" class="form-control" name="id" placeholder="Enter Student ID" value="{{ Request::get('id') }}">
              </div> --}}

              <div class="form-group col-md-6">
                <label>Search Student Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Student Name" value="{{ Request::get('name') }}">
              </div>

              {{-- <div class="form-group col-md-2">
                <label>Other Names</label>
                <input type="text" class="form-control" name="other_name" placeholder="Enter Last Name" value="{{ Request::get('other_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Last Name</label>
                <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
              </div> --}}

              {{-- <div class="form-group col-md-2">
                <label>Email</label>
                <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
              </div>   --}}

              <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                <a href="{{ url('admin/parent/my-student/' . $parent_id) }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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

            @if(!empty($getSearchStudent))

                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Student List</h3>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Parent Name</th>
                            <th>Creaded Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($getSearchStudent as $value)
                                <tr>
                                <td>{{ $value->id }}</td>
                                <td>
                                    @if (!empty($value->getProfile()))
                                    <img src="{{ $value->getProfile() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                    @endif
                                    
                                </td>
                                <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->parent_name }}</td>
                                
                                <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                <td style="min-width: 150px;">
                                    {{-- <a href="{{ route('parent.assign_student_to_parent', [$value->id] . '/' . $parent_id) }}" class="btn btn-primary btn-sm">Add Student To Parent</a> --}}
                                    <a href="{{ url('admin/parent/assign_student_to_parent/' . $value->id . '/' . $parent_id) }}" class="btn btn-primary btn-sm">Assign Student To Parent</a>
                                </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>

                    <div style="padding: 10px; float: right;">

                        
                    </div>

                    </div>
                    <!-- /.card-body -->
                </div>
            @endif


            <div class="card">
                <div class="card-header">
                <h3 class="card-title">{{ $getParent->name }} {{ $getParent->last_name }}'s Student List</h3>
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
                            <th>Name</th>
                            <th>Email</th>
                            <th>Parent Name</th>
                            <th>Creaded Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($getRecord as $value)
                                <tr>
                                <td>{{ $value->id }}</td>
                                <td>
                                    @if (!empty($value->getProfile()))
                                    <img src="{{ $value->getProfile() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                    @endif
                                    
                                </td>
                                <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                                <td>{{ $value->email }}</td>
                                <td>{{ $value->parent_name }}</td>
                                
                                <td style="min-width: 100px;">{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                                <td style="min-width: 150px;">
                                    <a href="{{ url('admin/parent/delete_assign_student_to_parent/' . $value->id) }}" class="btn btn-danger btn-sm">Remove</a>
                                </td>
                                </tr>
                            @endforeach
                        
                        </tbody>
                    </table>


                <div style="padding: 10px; float: right;">

                    
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