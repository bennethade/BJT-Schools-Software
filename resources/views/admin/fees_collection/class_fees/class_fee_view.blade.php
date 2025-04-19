@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>Class Tuition Fees</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Search By Term</h3>
                    </div>

                    <form method="get" action=" ">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Term Name:</label>
                                <select class="form-control" name="exam_id" required>
                                    <option value="">Select</option>
                                    @foreach ($getExam as $exam)
                                        <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-3">
                                <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                                <a href="{{ route('fees_collection.class_fee.view') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <!-- /.col -->
                  <div class="col-md-12">
                     @include('_message')
                    
      
                    <div class="col-md-12">
                        @if(!empty(Request::get('exam_id')))
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Class List</h3>
                                </div>
                                <div class="card-body p-0" style="overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Class Name</th>
                                                <th>Tuition Fee</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                              $id = 1;
                                          @endphp
                                          @if (!empty($getClass) && !empty($getClass->count()))
                                                @forelse ($getClass as $value)
                                                    <form action="" method="POST" class="SubmitForm" id="SubmitForm">
                                                      @csrf
                                                      <input type="hidden" name="class_id" value="{{ $value->id }}">
                                                      <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                                      <tr>
                                                          <td>{{ $id++ }}</td>
                                                          <td style="min-width: 200px;">{{ $value->class_name }} {{ $value->class_description }}</td>
      
                                                          <td>
                                                              <input type="number" class="form-control" name="tuition_fee" style="width: 150px;" value="{{ $classFeeRecord[$value->id]->tuition_fee ?? '' }}">
                                                          </td>
      
                                                          <td>
                                                              <button type="submit" class="btn btn-success" style="">Save</button>
                                                          </td>
      
                                                      </tr>
                                                      
                                                    </form>

                                                @empty

                                                    <td>
                                                        <p>No Record Found For The Chosen Term!</p>
                                                    </td>

                                                @endforelse

                                            @endif
                                        </tbody>                                
                                      
                                </table>
      
                              </div>
                          </div>
                      @endif
                  </div>
                </div>
                  
            </div>
               
        </section>
    </div>
@endsection
      
      
      
      
      
    
    
