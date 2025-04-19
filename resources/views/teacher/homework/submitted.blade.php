@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Submitted Homework</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          
          
        </div>
        
      </div>
    </div>
  </section>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
         
        <div class="col-md-12">


          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Submitted Homework</h3>
            </div>
            
            <form method="get" action=" ">
              <div class="card-body">
                <div class="row">
                  
                  <div class="form-group col-md-3">
                    <label>Student First Name</label>
                    <input type="text" class="form-control" name="name" value="{{ Request::get('name') }}" placeholder="First Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Student Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{ Request::get('last_name') }}" placeholder="Last Name">
                  </div>


                  {{-- <div class="form-group col-md-3">
                    <label>Created Date From</label>
                    <input type="date" class="form-control" name="created_date_from" value="{{ Request::get('created_date_from') }}">
                  </div> --}}

                  {{-- <div class="form-group col-md-3">
                    <label>Created Date To</label>
                    <input type="date" class="form-control" name="created_date_to" value="{{ Request::get('created_date_to') }}">
                  </div> --}}

                  <div class="form-group col-md-2">
                    <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                    <a href="{{ route('teacher.homework.submitted',[$homework_id]) }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                  </div>
                  
                </div>
              </div>
              <!-- /.card-body -->
            </form>
          </div>


          @include('_message')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Submitted Homework List</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1
                  @endphp
                  <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Document</th>
                    <th>Description</th>
                    <th>Created Date</th>
                    
                  </tr>
                </thead>
                <tbody>
                    @forelse ($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
                        <td>
                            @if (!empty($value->getDocument()))
                              <a href="{{ $value->getDocument() }}" class="btn btn-primary btn-sm" download="">Download</a>
                            @endif
                          </td>
                          <td>{!! $value->description !!}</td>
                          <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>  
                      </tr>
                    @empty
                      <tr>
                        <td colspan="100%">Record Not Found</td>
                      </tr>
                    @endforelse
                </tbody>
              </table>
              <div style="padding: 10px; float: right;">
                {{ $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() }}
             </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>
  </section>
</div>



@endsection