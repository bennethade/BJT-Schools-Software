@extends('layouts.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    <h1>Student Extra Fees</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                    <h3 class="card-title">Search Fees</h3>
                    </div>

                    <form method="get" action=" ">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Class Name:</label>
                                <select class="form-control" name="class_id" required>
                                    <option value="">Select</option>
                                    @foreach ($getClass as $class)
                                        <option {{ (Request::get('class_id') == $class->id) ? 'selected' : '' }} value="{{ $class->id }}">{{ $class->name }} {{ $class->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-4">
                                <label>Term Name:</label>
                                <select class="form-control" name="exam_id" required>
                                    <option value="">Select</option>
                                    @foreach ($getExam as $exam)
                                        <option {{ (Request::get('exam_id') == $exam->id) ? 'selected' : '' }} value="{{ $exam->id }}">{{ $exam->name }} {{ $exam->session }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group col-md-4">
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
                        @if(!empty(Request::get('class_id')) && !empty(Request::get('exam_id')))
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Student List</h3>
                                </div>
                                <div class="card-body p-0" style="overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Student Name</th>
                                                <th>Outstanding</th>
                                                <th>Resources</th>
                                                <th>After School Care</th>
                                                <th>Uniform</th>
                                                <th>Club</th>
                                                <th>School Lunch</th>
                                                <th>School Bus</th>
                                                <th>End of Session</th>
                                                <th>Miscellaneous</th>
                                                <th>Subtotal</th>
                                                <th>Discount (%)</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                              $id = 1;
                                          @endphp
                                          @if (!empty($getStudent) && !empty($getStudent->count()))
                                                @forelse ($getStudent as $value)
                                                    <form action="" method="POST" class="SubmitForm" id="SubmitForm">
                                                      @csrf
                                                      <input type="hidden" name="student_id" value="{{ $value->id }}">
                                                      <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                                      <input type="hidden" name="exam_id" value="{{ Request::get('exam_id') }}">
                                                      <tr>
                                                          <td>{{ $id++ }}</td>
                                                          <td style="min-width: 200px;">{{ $value->name }} {{ $value->last_name }} {{ $value->other_name }}</td>
      
                                                          <td>
                                                              <input type="number" class="form-control" name="outstanding" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->outstanding ?? '' }}">
                                                          </td>

                                                          <td>
                                                              <input type="number" class="form-control" name="resources" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->resources ?? '' }}">
                                                          </td>

                                                          <td>
                                                              <input type="number" class="form-control" name="after_school_care" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->after_school_care ?? '' }}">
                                                          </td>
                                                          
                                                          <td>
                                                              <input type="number" class="form-control" name="uniform" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->uniform ?? '' }}">
                                                          </td>
                                                          
                                                          <td>
                                                              <input type="number" class="form-control" name="club" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->club ?? '' }}">
                                                          </td>
                                                          
                                                          <td>
                                                              <input type="number" class="form-control" name="school_lunch" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->school_lunch ?? '' }}">
                                                          </td>
                                                          
                                                          <td>
                                                              <input type="number" class="form-control" name="school_bus" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->school_bus ?? '' }}">
                                                          </td>

                                                          <td>
                                                              <input type="number" class="form-control" name="end_of_session" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->end_of_session ?? '' }}">
                                                          </td>

                                                          <td>
                                                              <input type="number" class="form-control" name="miscellaneous" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->miscellaneous ?? '' }}">
                                                          </td>
                                                          
                                                          <td>
                                                              <input readonly type="number" class="form-control" name="subtotal" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->subtotal ?? '' }}">
                                                          </td>
                                                          
                                                          <td>
                                                              <input type="number" class="form-control" name="discount" style="width: 100px;" value="{{ $extraFeeRecords[$value->id]->discount ?? '' }}">
                                                          </td>
      
                                                          <td style="min-width: 230px">
                                                              <button type="submit" class="btn btn-success" style="margin: 5px;">Save</button>
                                                              <a class="btn btn-warning" target="_blank" href="{{ url('admin/fees_collection/fees_breakdown?exam_id=' . Request::get('exam_id') . '&student_id='.$value->id) }}">Print Invoice</a>
                                                          </td>
      
                                                      </tr>

                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th>Outstanding</th>
                                                                <th>Resources</th>
                                                                <th>After School Care</th>
                                                                <th>Uniform</th>
                                                                <th>Club</th>
                                                                <th>School Lunch</th>
                                                                <th>School Bus</th>
                                                                <th>End of Session</th>
                                                                <th>Miscellaneous</th>
                                                                <th>Subtotal</th>
                                                                <th>Discount (%)</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                      
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
      
      
      
      
      
    
    
