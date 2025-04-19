@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Clock In/Out</h1>
            </div>
         </div>
      </div>
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
               <div class="card card-primary">
                  <form method="POST" action="">
                     @csrf
                     <div class="card-body">
                        
                        <div class="form-group">
                           <label>Select Teacher</label>
                           <select name="teacher_id" class="form-control" required>
                              <option value="">Choose</option>
                              @foreach ($getTeacher as $teacher)
                                <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>    
                              @endforeach
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="">Today's Date:</label>
                            <span>{{ $attendanceDate }}</span>
                        </div>

                        <div class="form-group">
                            <label for="">Current Time:</label>
                            <span>{{ $currentTime }}</span>
                        </div>


                        @if ($location)

                           <div class="form-group">
                              <p><b>IP Address:</b> {{ $location->ip }}</p>
                              <p><b>Latitude:</b> {{ $location->latitude }}</p>
                              <p><b>Longitude:</b> {{ $location->longitude }}</p>
                              <p><b>Area Code:</b> {{ $location->areaCode }}</p>
                              
                           </div>

                           
                        @else

                        @endif
                        

                     </div>
                     <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
@endsection