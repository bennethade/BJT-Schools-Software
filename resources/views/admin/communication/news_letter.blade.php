@extends('layouts.app')

@section('styles')
  {{-- <link rel="stylesheet" href="{{ url('public/plugins/select2/css/select2.min.css') }}"> --}}
  {{-- <link rel="stylesheet" href="{{ url('public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}"> --}}

  <link href="https://cdn.jsdelivr.net/npm/select2@latest/dist/css/select2.min.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />




<style type="text/css">
    .select2-container .select2-selection--single
    {
        height: 40px;
    }
</style>


@endsection


@section('content')

<div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Send Newsletter</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('_message')
            <div class="card card-primary">
             
              
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" class="form-control" name="subject" required placeholder="Enter Subject">
                  </div>


                    <div class="form-group">
                      <label>Send to a Single User (Student / Parent / Teacher)</label>
                      <select name="user_id" class="form-control select2" style="width: 100%;">
                        <option value="">Select</option>
                        
                      </select>
                    </div>
                    

                  <div class="form-group">
                    <label style="display: block;">Send Newsletter To</label>
                    <label style="margin-right: 50px; font-weight: 400;"><input type="checkbox" name="message_to[]" value="2" id="">Teachers</label>
                    <label style="margin-right: 50px; font-weight: 400;"><input type="checkbox" value="3" name="message_to[]" id="">Students</label>
                    <label style="margin-right: 50px; font-weight: 400;"><input type="checkbox" value="4" name="message_to[]" id="">Parents</label>
                  </div>
                  
                  <div class="form-group">
                    <label>Message</label>
                    <textarea id="compose-textarea" name="message" class="form-control" style="height: 300px">
                    
                    </textarea>
                  </div>

                  <label for="">Add a PDF or any other file type</label>
                  <div class="form-group">
                    <input type="file" name="document" id="" title="Choose Document">
                  </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Send Email</button>
                </div>
              </form>
            </div>

          </div>
         
        </div>
      </div>
    </section>
  </div>

@endsection


@section('script')


{{-- For Summernote --}}
<script src="https://cdn.jsdelivr.net/npm/select2@latest/dist/js/select2.min.js"></script>


{{-- For Select2 --}}
{{-- <script src="{{ url('public/plugins/select2/js/select2.full.min.js') }}"></script> --}}




<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.full.min.js"></script>



<script>
    $(function () {


        //Select2 Start
        $('.select2').select2({
            ajax: {
                url: '{{ url('admin/communication/search_user') }}',
                dataType: 'json',
                delay: 250,
                data: function (data) {
                    return {
                        search: data.term,
                    };
                },
                processResults: function (response) {
                    return {
                        result:response
                    };
                },
            }
        });
        //Select2 Ends


      $('#compose-textarea').summernote({ //For Text area
        height: 200,
      });
    });
  </script>

@endsection