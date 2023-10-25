@extends('layouts.app') 
@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Update About Patient</title>
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
              <h5 class="card-title fw-semibold mb-4">Update Patient</h5>

              <form action="{{ route('update-patient', ['patient_id' => $patient->patient_id]) }}" method="POST" enctype="multipart/form-data">
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
                    <legend class="form-fieldset-title">Personal Information</legend>
                    <div class="row">
                    <div class="col-sm-12 d-flex justify-content-center photo">
                    @if (filter_var($patient->patient_image, FILTER_VALIDATE_URL))
                    <div id="profile-picture" onclick="handleImageUpload()" style="background-image: url('{{ $patient->patient_image }}');"></div>
                @else
                <img id="profile-picture" onclick="handleImageUpload()"  src="{{ asset('storage/' . $patient->patient_image) }}" alt="Uploaded Image">
                                    @endif
                                        
                                            <input id="profile-input" name="patient_image" type="file" accept="image/*" onchange="previewImage(event)">
                                        </div>
                                        <p class="col-sm-12 d-flex justify-content-center">Click to upload new photo</p>
                    
                      
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="patient-list-aboutpatient-name" class="form-label">Full Name (As Per IC/Passport)</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" value='{{$patient->patient_name}}' required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="patient-list-aboutpatient-gender" class="form-label">Gender</label>
                            <select class="form-select" name="patient_gender" id="patient_gender" value='{{$patient->patient_gender}}'required>
                                <option value="">Select</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="patient-list-aboutpatient-diabetestype" class="form-label">Diabetes Type</label>
                            <select class="form-select" name="diabetes_type" id="diabetes_type" value='{{$patient->diabetes_type}}' required>
                                <option value="">Select</option>
                                <option value="type 1">Type 1</option>
                                <option value="type 2">Type 2</option>
                                <option value="GestationalDiabetes">Gestational Diabetes</option>
                                <option value="Prediabetes">Pre-diabetes</option>
                                <option value="Nondiabetes">Non-diabetes</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-dateofbirth" class="form-label">Date of Birth</label>
                          <input class="form-control" type="date" id="date_of_birth" name="date_of_birth"
                          value="{{$patient->date_of_birth}}"
                          min="1930-01-01" max="{{ date('Y-m-d') }}">
                        </div>
                    </div>
                    <legend class="form-fieldset-title">Advanced Information</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-organisation" class="form-label">Organisation</label>
                        
                                                  
                                            
                          <select class="form-select" name="organization_name" id="organization_name" required>
                            @foreach($organizations as $organization)
                                <option value="{{ $organization->organizationid }}" 
                                    @if($patient->organizationid_FK == $organization->organizationid)
                                        selected
                                    @endif
                                >
                                    {{ $organization->organization_name }}
                                </option>
                            @endforeach
                        </select>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-dateofdiagnosis" class="form-label">Date of Diagnosis</label>
                        <input class="form-control" type="date" id="date_of_diagnosis" name="date_of_diagnosis"
                        value='{{$patient->date_of_diagnosis}}'
                               min="2000-01-01" max="{{ date('Y-m-d') }}">
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-phone" class="form-label">Mobile Phone</label>
                        <input type="text" class="form-control" id="patient_phonenum" name="patient_phonenum"  value='{{$patient->patient_phonenum}}'required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-patientnumber" class="form-label">Patient Number</label>
                        <input type="number" class="form-control" id="patient_number"  name="patient_number"value='{{$patient->patient_number}}' required>
                      </div>
                    </div>
                    <legend class="form-fieldset-title">Emergency Information</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-emergencycontactname" class="form-label">Emergency Contact Name</label>
                          <input type="text" class="form-control" id="emergencypersonname"  name="emergencypersonname" value='{{$patient->emergencypersonname}}'required>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-emergencymobilephone" class="form-label">Emergency Mobile Phone</label>
                        <input type="text" class="form-control" id="emergencypersonphonenum"  name="emergencypersonphonenum" value='{{$patient->emergencypersonphonenum}}'required>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            
                  
            </div>
        </div>
      </div>


    <script src="../js/imageUpload.js"></script>
    </body>
</html>
@endsection