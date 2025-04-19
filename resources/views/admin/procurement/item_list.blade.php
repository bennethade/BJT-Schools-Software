@extends('layouts.app')

@section('content')

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Procurements</h1>
            </div>

            <div class="col-sm-6" style="text-align:right">
               <a href="{{ route('procurement.item.add') }}" class="btn btn-primary">Add New Item</a>
            </div>
         </div>
      </div>
      <!-- /.container-fluid -->
   </section>
   <section class="content">
      <div class="container-fluid">
         <div class="card">
            <div class="card-header">
               <h3 class="card-title">Search Item</h3>
            </div>
            <form method="get" action="">
               <div class="card-body">
                  <div class="row">
                     
                     <div class="form-group col-md-5">
                        <label>Item Name</label>
                        <input type="text" class="form-control" name="item_name" value="{{ Request::get('item_name') }}">
                     </div>

                     <div class="form-group col-md-2">
                        <label>Amount</label>
                        <input type="number" class="form-control" name="amount" value="{{ Request::get('amount') }}">
                     </div>

                     <div class="form-group col-md-2">
                        <label>Purchase Date</label>
                        <input type="date" class="form-control" name="purchase_date" value="{{ Request::get('purchase_date') }}">
                      </div>
                     
                     <div class="form-group col-md-3">
                        <button type="submit" class="btn btn-primary" style="margin-top: 32px;">Search</button>
                        <a href="{{ route('procurement.item.list') }}" class="btn btn-success" style="margin-top: 32px;">Refresh</a>
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
                        <h3 class="card-title">Procurement List</h3>
                    </div>

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Item Name</th>
                                <th>Description</th>
                                <th>Purchase Date</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                
                                @forelse ($getRecord as $value)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        {{-- @if (!empty($value->getProfileDirect()))
                                        <img src="{{ $value->getProfileDirect() }}" alt="" style="height: 50px; width: 50px; border-radius: 50px;">  
                                        @endif --}}

                                        @if (!empty($value->image))
                                            <img src="{{ asset('upload/procurement/' . $value->image) }}" alt="Item Image" style="height: 50px; width: 50px;">
                                        @else
                                            <span>No Image Available</span>
                                        @endif
                                    </td>
                                    <td>{{ $value->item_name }}</td>
                                    <td>{{ $value->description }}</td>
                                    <td style="min-width: 100px;">{{ date('d-m-Y', strtotime($value->purchase_date)) }}</td>
                                    <td style="min-width: 100px;"> &#x20A6;{{ $value->amount }}</td>
                                    <td style="min-width: 170px;">
                                        <a href="{{ route('procurement.item.edit', [$value->id]) }}" class="btn btn-primary">Edit</a>
                                        <a href="{{ route('procurement.item.delete', [$value->id]) }}" class="btn btn-danger">Delete</a>
                                    </td>
                                 </tr>
                                @empty
                                    <td colspan="100%">
                                        <p>No Item(s) found!</p>
                                    </td>
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
   </section>
   <!-- /.content -->
</div>
@endsection