@extends('layouts.app')
@section('content')
<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Role Management</h1>
            </div>
         </div>
      </div>
   </section>

   <section class="content">
      <div class="container-fluid">
         <div class="card">

            @include('_message')
            
            <div class="card-header">
               <h3 class="card-title">Search Staff and Role</h3>
            </div>

            <form method="post" action="">
                @csrf
               <div class="card-body">
                  <div class="row">
                     <div class="form-group col-md-5">
                        <label>Staff Name</label>
                        <select class="form-control" name="staff_id" required>
                           <option value="">Select</option>
                           @foreach ($getStaff as $staff)
                            <option value="{{ $staff->id }}">{{ $staff->name }} {{ $staff->last_name }} {{ $staff->other_name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-5">
                        <label>Role Name</label>
                        <select class="form-control" name="role_name" required>
                           <option value="">Select</option>
                           @foreach ($getRole as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Submit</button>
                        {{-- <a href="{{ route('examinations.behavior_chart') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a> --}}
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </section>
   <!-- Main content -->
   
</div>
@endsection







@section('script')

<script type="text/javascript">
  
</script>

@endsection