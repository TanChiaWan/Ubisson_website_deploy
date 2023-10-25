@extends('layouts.patapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Patient Information</title>
    <meta charset="utf-8">
    <meta name="description" content="create">
    <meta name="author" content="Kong">
    <meta name="keywords" content="Organization">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
<div class="container-fluid">
        <!-- Outer Tab -->
        <div class="d-flex justify-content-center">
          <div class="card d-inline-block">
            <div class="card-body py-1 px-4">
              <div class="row text-center">
                <div class="col-md-12 p-0">
                   <form action="{{ route('dashboard_general') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Dashboard</button>
                  </form>
                <form action="{{ route('aboutpatient') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 active">About Patient</button>
                  </form>
                  <form action="{{ route('logbook_bg') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Logbook</button>
                  </form>
                  <form action="{{ route('healthdata') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Health Data</button>
                  </form>
                  <form action="{{ route('remark') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Remarks</button>
                  </form>
                  <form action="{{ route('medicationreport') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">Medication</button>
                  </form>
                </div>
            </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <h5 class="card-title fw-semibold mb-4">Patient Profile</h5>
              </div>
              <div class="col-md-6 text-end">
              <form action="{{ route('editpage') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary btn-with-icon align-items-center"><i class="ti ti-pencil"></i>Edit</button>
                  </form>

              </div>
            </div>
                
                <form>
                    <legend class="form-fieldset-title">Personal Information</legend>
                    <div class="row">
                      <div class="col-sm-12 d-flex justify-content-center">
                      @if (filter_var($patient->patient_image, FILTER_VALIDATE_URL))
                                                                                        <div id="profile-picture" style="cursor: unset; background-image: url('{{ $patient->patient_image }}');" class="rounded float-left img-fluid" alt="Responsive Image"></div>
                                                                                    @else
                                                                                        <img id="profile-picture" class="rounded float-left img-fluid" src="{{ asset('storage/' . $patient->patient_image) }}" alt="Uploaded Image">
                                                                                    @endif
              
                      </div>
                    </div><br>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="patient-list-aboutpatient-name" class="form-label">Full Name (As Per IC/Passport)</label>
                            <p>{{ $patient->patient_name }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="patient-list-aboutpatient-gender" class="form-label">Gender</label>
                            <p>{{ $patient->patient_gender }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="patient-list-aboutpatient-diabetestype" class="form-label">Diabetes Type</label>
                            <p>{{ $patient->diabetes_type }}</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-dateofbirth" class="form-label">Date of Birth</label>
                          <p>{{ $patient->date_of_birth }}</p>
                        </div>
                    </div>
                    <legend class="form-fieldset-title">Advanced Information</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-organisation" class="form-label">Organisation</label>
                          <p>{{ $patient->organization_name }}</p> 
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-dateofdiagnosis" class="form-label">Date of Diagnosis</label>
                        <p>{{ $patient->date_of_diagnosis }}</p>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-phone" class="form-label">Mobile Phone</label>
                        <p>+{{ $patient->patient_phonenum }}</p>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-patientnumber" class="form-label">Patient Number</label>
                        <p>{{ $patient->patient_number }}</p>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-QRPatientProfile" class="form-label">QR Code to Patient Profile</label>
                        <p><img src="../assets/images/qr_code.png" class="imgsize"></p>
                      </div>
                    </div>
                    <legend class="form-fieldset-title">Emergency Information</legend>
                    <div class="row">
                      <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-emergencycontactname" class="form-label">Emergency Contact Name</label>
                          <p>{{ $patient->emergencypersonname }}</p>
                      </div>
                      <div class="col-md-6 mb-3">
                        <label for="patient-list-aboutpatient-emergencymobilephone" class="form-label">Emergency Mobile Phone</label>
                        <p>+{{ $patient->emergencypersonphonenum }}</p>
                      </div>
                    </div>
                </form>
            
                  
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <h5 class="card-title fw-semibold mb-4">Glucose Target</h5>
                        </div>
                        <div class="col-md-6 text-end mb-4">
                          <a href="{{ route('edit_patient_glucose_target', ['patientId' => $patient->patient_id]) }}" class="btn btn-primary btn-with-icon align-items-center"><i class="ti ti-pencil"></i>Edit</a>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-glucosetarget-beforecomsumption" class="form-label">Before Comsumption:</label>
                          <p>{{ $patient->targetBG_low_BC }} - {{ $patient->targetBG_high_BC }} mmol/L</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-glucosetarget-aftercomsumption" class="form-label">After Comsumption:</label>
                          <p>{{ $patient->targetBG_low_AC }} - {{ $patient->targetBG_high_AC }} mmol/L</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-glucosetarget-bedtime" class="form-label">Bedtime:</label>
                          <p>{{ $patient->targetBG_low_BT }} - {{ $patient->targetBG_high_BT }} mmol/L</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-glucosetarget-hba1c" class="form-label">HbA1c:</label>
                          <p>{{ $patient->targethba1c }} %</p>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-6">
                          <h5 class="card-title fw-semibold mb-4">Target Range</h5>
                        </div>
                        <div class="col-md-6 text-end mb-4">
                          <a href="{{ route('edit_patient_target_range', ['patientId' => $patient->patient_id]) }}" class="btn btn-primary btn-with-icon align-items-center"><i class="ti ti-pencil"></i>Edit</a>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-targetrange-carbs" class="form-label">Carbs:</label>
                          <p>{{ $patient->mincarb }} - {{ $patient->maxcarb }} g</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-targetrange-weight" class="form-label">Weight:</label>
                          <p>{{ $patient->minweight }} - {{ $patient->maxweight }} kg</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-targetrange-bmi" class="form-label">BMI:</label>
                          <p>{{ $patient->minbmi }} - {{ $patient->maxbmi }} kg/m2</p>
                        </div>
                        <div class="col-md-6 mb-3">
                          <label for="patient-list-aboutpatient-targetrange-activity" class="form-label">Activity:</label>
                          <p>{{ $patient->totalactivity }} min</p>
                        </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
  
</body>




</html>@endsection 