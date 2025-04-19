@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Notice Board</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('communication.notice_board.add') }}" class="btn btn-primary">Add New Notice Board</a>
          
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
                  <h3 class="card-title">Search Notice Board</h3>
                </div>
                
                <form method="get" action="">
                  <div class="card-body">
                    <div class="row">
                      <div class="form-group col-md-2">
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ Request::get('title') }}">
                      </div>
    
    
                      <div class="form-group col-md-2">
                        <label>Notice Date From</label>
                        <input type="date" class="form-control" name="notice_date_from" value="{{ Request::get('notice_date_from') }}">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Notice Date To</label>
                        <input type="date" class="form-control" name="notice_date_to" value="{{ Request::get('notice_date_to') }}">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Publish Date From</label>
                        <input type="date" class="form-control" name="publish_date_from" value="{{ Request::get('publish_date_from') }}">
                      </div>


                      <div class="form-group col-md-2">
                        <label>Publish Date To</label>
                        <input type="date" class="form-control" name="publish_date_to" value="{{ Request::get('publish_date_to') }}">
                      </div>

                      <div class="form-group col-md-2">
                        <label>Message To</label>
                        <select class="form-control" name="message_to">
                            <option value="">Select</option>
                            <option {{ (Request::get('message_to') == 2) ? 'selected' : '' }} value="2">Teacher</option>
                            <option {{ (Request::get('message_to') == 3) ? 'selected' : '' }} value="3">Student</option>
                            <option {{ (Request::get('message_to') == 4) ? 'selected' : '' }} value="4">Parent</option>
                        </select>
                      </div>
                      
                    </div>

                    <div class="form-group" style="text-align: center;">
                        <button type="submit" class="btn btn-primary" style="margin-top: 10px;">Search</button>
                        <a href="{{ route('communication.notice_board.list') }}" class="btn btn-success" style="margin-top: 10px;">Refresh</a>
                    </div>

                  </div>
                  <!-- /.card-body -->
                </form>
              </div>

          @include('_message')

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Notice Board List</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1
                  @endphp
                  <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Notice Date</th>
                    <th>Published Date</th>
                    <th>Message To</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($getRecord as $value)
                        <tr>
                            <td>{{ $value->id }}</td>
                            <td>{{ $value->title }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->notice_date)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->publish_date)) }}</td>
                            <td>
                                @foreach ($value->getMessage as $message)
                                    @if ($message->message_to == 2)
                                        <div>Teachers</div>
                                    @elseif ($message->message_to == 3)
                                        <div>Students</div>
                                    @elseif ($message->message_to == 4)
                                        <div>Parents</div>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $value->created_by }}</td>
                            <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                            <td style="min-width: 180px;">
                                <a href="{{ route('communication.notice_board.edit', [$value->id]) }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('admin/communication/notice_board/delete/'.$value->id) }}" class="btn btn-danger">Delete</a>
                            </td>
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