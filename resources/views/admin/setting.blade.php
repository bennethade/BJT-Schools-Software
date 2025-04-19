@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Settings</h1>
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

            @include('_message')

            <div class="card card-primary">
              
              <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="card-body row">

                  <div class="form-group col-md-3">
                    <label>Favicon Icon</label>
                    <input type="file" class="form-control" name="favicon_icon" >
                    @if(!empty($getRecord->getFavicon()))
                        <img src="{{ $getRecord->getFavicon() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>

                  <div class="form-group col-md-3">
                    <label>School Logo</label>
                    <input type="file" class="form-control" name="logo" >
                    @if(!empty($getRecord->getLogo()))
                        <img src="{{ $getRecord->getLogo() }}" class="" alt="" style="width: 80px; height:auto">
                    @endif
                  </div>


                  <div class="form-group col-md-3">
                    <label>Award Seal</label>
                    <input type="file" class="form-control" name="seal" >
                    @if(!empty($getRecord->getSeal()))
                        <img src="{{ $getRecord->getSeal() }}" class="" alt="" style="width: 80px; height:auto">
                    @endif
                  </div>

                  <div class="form-group col-md-3">
                    <label>Trophy</label>
                    <input type="file" class="form-control" name="trophy" >
                    @if(!empty($getRecord->getTrophy()))
                        <img src="{{ $getRecord->getTrophy() }}" class="" alt="" style="width: 80px; height:auto">
                    @endif
                  </div>


                  <div class="form-group col-md-6">
                    <label>School Name</label>
                    <input type="text" class="form-control" name="school_name" value="{{ $getRecord->school_name }}" placeholder="Enter Your School Name">
                  </div>

                  <div class="form-group col-md-3">
                    <label>School Abbreviation</label>
                    <input type="text" class="form-control" name="abbreviation" value="{{ $getRecord->abbreviation }}" placeholder="Enter Abbreviation">
                  </div>

                  <div class="form-group col-md-3">
                    <label>Shool Motto</label>
                    <input type="text" class="form-control" name="motto" value="{{ $getRecord->motto }}" placeholder="Enter Motto">
                  </div>


                  <div class="form-group col-md-12">
                    <label>School Address</label>
                    <textarea class="form-control" name="school_address">{{ $getRecord->school_address }}</textarea>
                  </div>


                  <div class="form-group col-md-6">
                    <label>School Email Address 1</label>
                    <input type="email" class="form-control" name="school_email_1" value="{{ $getRecord->school_email_1 }}" placeholder="School Email Address">
                  </div>


                  <div class="form-group col-md-6">
                    <label>School Email Address 2</label>
                    <input type="email" class="form-control" name="school_email_2" value="{{ $getRecord->school_email_2 }}" placeholder="School Email Address Two">
                  </div>


                  <div class="form-group col-md-4">
                    <label>School Phone Number 1</label>
                    <input type="tel" class="form-control" name="school_phone_1" value="{{ $getRecord->school_phone_1 }}" placeholder="School Phone Number">
                  </div>


                  <div class="form-group col-md-4">
                    <label>School Phone Number 2</label>
                    <input type="tel" class="form-control" name="school_phone_2" value="{{ $getRecord->school_phone_2 }}" placeholder="School Phone Number Two">
                  </div>


                  <div class="form-group col-md-4">
                    <label>School Website Address</label>
                    <input type="text" class="form-control" name="school_website" value="{{ $getRecord->school_website }}" placeholder="Enter School Website Address">
                  </div>


                  <div class="form-group col-md-4">
                    <label>School Account Name</label>
                    <input type="text" class="form-control" name="school_account_name" value="{{ $getRecord->school_account_name }}" placeholder="School Account Name">
                  </div>


                  <div class="form-group col-md-4">
                    <label>School Account Number</label>
                    <input type="number" class="form-control" name="school_account_number" value="{{ $getRecord->school_account_number }}" placeholder="School Account Number">
                  </div>

                  
                  <div class="form-group col-md-4">
                    <label>Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" value="{{ $getRecord->bank_name }}" placeholder="Bank Name">
                  </div>


                  <div class="form-group col-md-3">
                    <label>Accountant's Signature</label>
                    <input type="file" class="form-control" name="accountant_signature" >
                    @if(!empty($getRecord->getAccountantSignature()))
                        <img src="{{ $getRecord->getAccountantSignature() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>


                  <div class="form-group col-md-3">
                    <label>Head of School's Signature</label>
                    <input type="file" class="form-control" name="head_of_school_signature" >
                    @if(!empty($getRecord->getHeadOfSchoolSignature()))
                        <img src="{{ $getRecord->getHeadOfSchoolSignature() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>


                  <div class="form-group col-md-3">
                    <label>Website QR Code</label>
                    <input type="file" class="form-control" name="qr_code" >
                    @if(!empty($getRecord->getQrCode()))
                        <img src="{{ $getRecord->getQrCode() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>


                  <div class="form-group col-md-3">
                    <label>Barcode</label>
                    <input type="file" class="form-control" name="barcode" >
                    @if(!empty($getRecord->getBarcode()))
                        <img src="{{ $getRecord->getBarcode() }}" class="" alt="" style="width: 50px">
                    @endif
                  </div>


                  {{-- <div class="form-group">
                    <label>Exam Description</label>
                    <textarea class="form-control" name="exam_description">{{ $getRecord->exam_description }}</textarea>
                  </div> --}}

                  {{-- <div class="form-group col-md-4">
                    <label>Paypal Business Email</label>
                    <input type="email" class="form-control" name="paypal_email" value="{{ $getRecord->paypal_email }}" placeholder="Enter Paypal Business Email">
                  </div> --}}


                </div>


                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Save</button>
                </div>
              </form>
            </div>

          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

@endsection