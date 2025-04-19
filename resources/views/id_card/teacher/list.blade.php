@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Teacher ID Card</h1>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
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
                <div class="form-group col-md-5">
                  <label>Search Staff Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter Staff Name" value="{{ Request::get('name') }}">
                </div>
  
                {{-- <div class="form-group col-md-3">
                  <label>Last Name</label>
                  <input type="text" class="form-control" name="last_name" placeholder="Enter Last Name" value="{{ Request::get('last_name') }}">
                </div> --}}
  
                {{-- <div class="form-group col-md-3">
                  <label>Email</label>
                  <input type="text" class="form-control" name="email" placeholder="Enter email" value="{{ Request::get('email') }}">
                </div> --}}
  
                <div class="form-group col-md-4">
                  <label>Gender</label>
                  <select name="gender" id="" class="form-control">
                    <option value="">Select Gender</option> 
                    <option {{ (Request::get('gender') == 'Male') ? 'selected' : '' }} value="Male">Male</option> 
                    <option {{ (Request::get('gender') == 'Female') ? 'selected' : '' }} value="Female">Female</option> 
                </select>
                </div>
  
                <div class="form-group col-md-3">
                  <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                  <a href="{{ route('teacher.id_list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                </div>
                
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>    
  
      </div>
    </section>



   
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               @include('_message')
                                 
                  <div class="card" style="overflow: auto">
                     <div class="card-header">
                        <h3 class="card-title">Teacher List</h3>
                     </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Photo</th>
                                  <th>Teacher Name</th>
                                  <th>Email</th>
                                  <th>Gender</th>
                                  <th>Action</th>
                                </tr>
                              </thead>

                              <tbody>
                                @php
                                    $id = 1;
                                @endphp
                                @forelse ($getTeacher as $value)
                                <tr>
                                    <td>{{ $id++ }}</td>
                                    <td>
                                      @if (!empty($value->getProfileDirect()))
                                        <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                      @endif
                                    </td>
                                    <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                                    <td>{{ $value->email }}</td>
                                    <td>{{ $value->gender }}</td>
                                    <td style="min-width: 150px;">
                                      <a href="{{ route('teacher.id_print', [$value->id]) }}" class="btn btn-primary" target="blank">Print ID Card</a>
                                    </td>
                                  </tr>
                                @empty
                                    <td colspan="100%">
                                        <p>No Teacher Found</p>
                                    </td>
                                @endforelse
                              </tbody>
                        </table>
                     
                  </div>
                  
            </div>
         </div>
         
      </div>
   </section>
   <!-- /.content -->
</div>
@endsection