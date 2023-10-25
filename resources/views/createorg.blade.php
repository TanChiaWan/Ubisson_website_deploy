@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Organization</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        

    </head>

<body>
<body>
<div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Create Organization</h5>
              
            <form action="{{ route('insert.create') }}" method="post">
            @csrf
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                <legend class="form-fieldset-title">Organization Information</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="organization-update-input-name" class="form-label">Name</label>
                        <input name='organization_name' type="text" class="form-control" id="organization_name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="organization-update-input-url" class="form-label">Customized Login URL</label>
                      <div class="input-group mb-3">
                        <span class="input-group-text" id="organiztion-url-addon">http://14.167.2.15/organization/</span>
                        <input name="customized_login_url" type="text" class="form-control" id="organization-update-input-url customized_login_url" aria-describedby="organiztion-url-addon"  required>
                      </div>
                    </div>
                </div>
                <legend class="form-fieldset-title">Contact Information</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-update-input-address" class="form-label">Address</label>
                      <input name="address" type="text" class="form-control" id="organization-update-input-address address"  required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-update-input-phone" class="form-label">Mobile Phone</label>
                    <input  name="organization_mobile_phone" type="text" class="form-control" id="organization-update-input-phone organization_mobile_phone"  required>
                  </div>
                </div>
                <legend class="form-fieldset-title">Administrator</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-update-input-adminname " class="form-label">Admin Name</label>
                      <input name="administrator_name" type="text" class="form-control" id="organization-update-input-adminname administrator_name"  required>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-update-input-adminemail" class="form-label">E-mail Address</label>
                    <input name="administrator_email_address" type="email" class="form-control" id="organization-update-input-adminemail administrator_email_address"  required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-update-input-username" class="form-label">Username</label>
                      <input name="administrator_username" type="text" class="form-control" id="organization-update-input-username administrator_username"  required>
                  </div>
                </div>
                <legend class="form-fieldset-title">Preferences</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-update-input-language" class="form-label">Language</label>
                      <select name="prefer_language" class="form-select" id="organization-update-input-language prefer_language" required>
                        <option value="">Select</option>
                        <option value="English" selected>English</option>
                        <option value="Malay">Malay</option>
                        <option value="Chinese">Simplified Chinese</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-update-input-region" class="form-label">Region</label>
                    <select name="region" class="form-select" id="organization-update-input-region region" required>
                      <option value="">Select</option>
                      <option value="Kuching" selected>Kuching</option>
                      <option value="Sri Aman">Sri Aman</option>
                      <option value="Sibu">Sibu</option>
                      <option value="Miri">Miri</option>
                      <option value="Limbang">Limbang</option>
                      <option value="Sarikei">Sarikei</option>
                      <option value="Kapit">Kapit</option>
                      <option value="Kota Samarahan">Kota Samarahan</option>
                      <option value="Bintulu">Bintulu</option>
                      <option value="Mukah">Mukah</option>
                      <option value="Betong">Betong</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="organization-update-input-bgunit" class="form-label">Blood Glucose Unit</label>
                      <select   name="blood_glucose_unit" class="form-select" id="organization-update-input-bgunit blood_glucose_unit" required>
                        <option value="">Select</option>
                        <option value="mmol/L" selected>mmol/L</option>
                        <option value="mg/dl">mg/dl</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="organization-update-input-otherunits" class="form-label">Other Units</label>
                    <select name="other_unit" class="form-select" id="organization-update-input-otherunits other_unit" required>
                      <option value="">Select</option>
                      <option value="English" selected>English</option>
                      <option value="Metric">Metric</option>
                    </select>
                  </div>
                </div>
               
                <button type="submit" class="btn btn-primary">Submit</button>
             
              </form>
                
          </div>
        </div>
      </div>
</body>

</html>
@endsection 