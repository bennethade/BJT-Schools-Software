@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Suggestion/Feedback</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              
              <form method="POST" action="{{ route('suggestion.update', [$getRecord->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">

                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" required placeholder="Title of Suggestion/Feedback" value="{{ old('title', $getRecord->title) }}">
                    <div style="color: red;">{{ $errors->first('title') }}</div>
                  </div>

                  <div class="form-group">
                    <label>Your suggestion</label>
                    <textarea class="form-control" name="description" required placeholder="What do you wish to suggest or give feedback on?" id="" cols="30" rows="10">{{ old('description', $getRecord->description) }}</textarea>
                    <div style="color: red;">{{ $errors->first('description') }}</div>
                  </div>

                  <div class="form-group">
                    <label for="">Status</label>
                    <select name="" id="" class="form-control">
                      <option {{ ($getRecord->status == 1) ? 'selected' : '' }} value="1">Active</option>
                      <option {{ ($getRecord->status == 0) ? 'selected' : '' }} value="0">Received</option>
                    </select>
                  </div>

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