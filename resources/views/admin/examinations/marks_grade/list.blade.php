@extends('layouts.app')

@section('content')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Marks Grade</h1>
        </div>
        <div class="col-sm-6" style="text-align: right;">
          <a href="{{ route('examinations.marks_grade.add') }}" class="btn btn-primary">Add New Marks Grade</a>
          
        </div>
        
      </div>
    </div><!-- /.container-fluid -->
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
              <h3 class="card-title">Marks Grade List</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  @php
                    $id = 1
                  @endphp
                  <tr>
                    <th>Grade Name</th>
                    <th>Description</th>
                    <th>Percent From</th>
                    <th>Percent To</th>
                    <th>School Section</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($getRecord as $value)
                    <tr>
                      <td>{{ $value->name }}</td>
                      <td>{{ $value->description }}</td>
                      <td>{{ $value->percent_from }}</td>
                      <td>{{ $value->percent_to }}</td>
                      <td>{{ $value->section }}</td>
                      <td>{{ $value->created_name }}</td>
                      <td>{{ date('d-m-Y H:i:A', strtotime($value->created_at)) }}</td>
                      <td style="min-width: 150px;">
                        <a href="{{ route('examinations.marks_grade.edit', [$value->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                        <a href="{{ url('admin/examinations/marks_grade/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
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