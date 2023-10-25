@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>My Profile</title>
    <meta charset="utf-8">
    <meta name="description" content="create">
    <meta name="author" content="Kong">
    <meta name="keywords" content="Organization">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
<div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title fw-semibold mb-4">My Profile</h5>
              </div>

            </div>
              
            <form>
                <legend class="form-fieldset-title">Personal Information</legend>
                <div class="row">
                      <div class="col-sm-12 d-flex justify-content-center">
                      @if (filter_var($user->professional_image, FILTER_VALIDATE_URL))
                                                                                        <div id="profile-picture" style="cursor: unset; background-image: url('{{ $user->professional_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                                                                    @else
                                                                                        <img id="profile-picture" class="rounded float-left img-fluid" src="{{ asset('storage/' . $user->professional_image) }}" alt="Uploaded Image">
                                                                                    @endif
                  

                      
                      
                      </div>
                    </div><br>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Name</label>
                        <p>{{ $user->professional_name }}</p>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Gender</label>
                      <p>{{ $user->professional_gender }}</p>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label">Mobile Phone</label>
                      <p>+{{ $user->professional_mobile_phone }}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label">Organization</label>
                      <p>{{ $user->organization_name }}</p>
                  </div>
                </div>
                <legend class="form-fieldset-title">Account</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label">UserName</label>
                      <p>{{ $user->username }}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">E-mail Address</label>
                    <p>{{ $user->professional_email_address }}</p>
                  </div>
                </div>
                <legend class="form-fieldset-title">Professional Information</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label">Type of Profession</label>
                      <p>{{ $user->professional_type_of_profession }}</p>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label class="form-label">Account Role</label>
                    <p>{{ $user->professional_account_role }}</p>
                  </div>
                </div>
                <legend class="form-fieldset-title">Permissions</legend>

                <a href="{{ route('home') }}" class="btn btn-primary">Back</a>
            </form>
                
          </div>
        </div>
      </div>

     
              

</body>
</html>
@endsection 