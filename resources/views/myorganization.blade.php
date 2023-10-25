@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Organization</title>
        <meta charset="utf-8">
        <meta name="description" content="my">
        <meta name="author" content="Kong">
        <meta name="keywords" content="My Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

   
    </head>

    <body>
    <body>
<div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title fw-semibold mb-4">My Organization</h5>
              </div>
              <div class="col-md-6 text-end">
                <a href="{{ route('editorg', ['organizationid' => $organization->organizationid]) }}" class="btn btn-primary btn-with-icon align-items-center"><i class="ti ti-pencil"></i>Edit</a>
              </div>
            </div>
              
            <form>
                <legend class="form-fieldset-title">Organization Information</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="organization-create-input-name" class="form-label">Name</label>
                        <p>{{ $professional->organization_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="organization-create-input-url" class="form-label">Customized Login URL</label>
                      <p>http:/{{ $organization->customized_login_url }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="organization-create-input-url" class="form-label">Organization QR</label>
                        <p><img src="../assets/images/qr_code.png" id="QRCode" alt="QR_code"></p>
                    </div>
                </div>
                <legend class="form-fieldset-title">Contact Information</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-create-input-address" class="form-label">Address</label>
                      <p>{{ $organization->address }}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="organization-create-input-phone" class="form-label">Mobile Phone</label>
                      <p>+{{ $organization->organization_mobile_phone }}</p>
                  </div>
                </div>
                <legend class="form-fieldset-title">Administrator</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-create-input-adminname" class="form-label">Admin Name</label>
                      <p>{{ $organization->administrator_name }}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-create-input-adminemail" class="form-label">E-mail Address</label>
                    <p>{{ $organization->administrator_email_address }}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-create-input-username" class="form-label">Username</label>
                      <p>{{$organization->administrator_username}}</p>
                  </div>
                </div>
                <legend class="form-fieldset-title">Preferences</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-create-input-language" class="form-label">Language</label>
                      <p>{{$organization->prefer_language}}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-create-input-region" class="form-label">Region</label>
                    <p>{{$organization->region}}</p>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-create-input-bgunit" class="form-label">Blood Glucose Unit</label>
                      <p>{{$organization->blood_glucose_unit}}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-create-input-otherunits" class="form-label">Other Units</label>
                    <p>{{ $organization->other_unit }}</p>
                  </div>
                </div>
            </form>
                
          </div>
        </div>
      </div>
</body>
      
</html>
@endsection 