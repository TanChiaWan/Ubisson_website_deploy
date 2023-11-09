@extends('layouts.orgpatapp') 
@section('content')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioTectiveDRC</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />


</head>

<body>
  <!--  Body Wrapper -->
 
       <!--  Header End -->
       <div class="container-fluid">
        <!-- Outer Tab -->
        <div class="d-flex justify-content-center">
          <div class="card d-inline-block">
            <div class="card-body py-1 px-4">
              <div class="row text-center">
                <div class="col-md-12 p-0">
                <a href="{{ route('dashboard_generalorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Dashboard</a>
                <a href="{{ route('aboutpatientorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">About Patient</a>
                <a href="{{ route('logbook_bgorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Logbook</a>
                <a href="{{ route('healthdataorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Health Data</a>
                <a href="{{ route('remarkorg') }}" class="btn btn-light m-1 btn-pagenav-notselected">Remarks</a>
                <a href="{{ route('medicationreportorg') }}" class="btn btn-primary m-1 active">Medication</a>
                </div>
            </div>
            </div>
          </div>
        </div>
        
        <!-- Inner Tab -->
                <div class="row">
                  
                <div class="row mb-3">
            <div class="col-md-4 text-center">
                    <p class="fs-4 fw-semibold">Patient: {{ $patient->patient_name }} ({{ $patient->patient_age }} y/o)</p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="fs-4 fw-semibold">Gender: {{ $patient->patient_gender }}</p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="fs-4 fw-semibold">Diabetes Type: {{ $patient->diabetes_type }}</p>
                </div>
            </div>
          </div>

          <div class="container-fluid">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Create Patient Allergy</h5>
          
                <form id="allergyForm" method="POST" action="{{ route('allergy.storeorg') }}">
        @csrf
        <input type="hidden" name="patient_id" value="{{ $patientId }}" >
                        <input type="hidden" name="professional_id" value="{{ $professionalId }}">
                        <input type="hidden" name="organization_id" value="{{ $organizationid }}">
        <legend></legend>
        <div class="row">
            <div class="col-md-12 mb-3">
                <label for="patient-list-medication-allergyform" class="form-label">Allergy Name</label>
                <input type="text" class="form-control" id="patient-list-medication-allergyform" name="allergy_name" placeholder="Enter the name of the allergy" pattern="[A-Za-z0-9\s_-/]+" required>
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="patient-list-medication-allergysymptomsform" class="form-label">Allergy Symptoms</label>
                <input type="text" class="form-control" id="patient-list-medication-allergysymptomsform" name="allergy_symptoms" placeholder="Enter the symptoms of the allergy" pattern="[A-Za-z0-9\s_-/]+" required>
            </div>
            
            <div class="col-md-12 mb-3">
                <label class="form-label">Severity</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="severity" id="patient-list-aboutpatient-allergiesseverity-low" value="Low">
                    <label class="form-check-label" for="patient-list-aboutpatient-allergiesseverity-low">
                        Low
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="severity" id="patient-list-aboutpatient-allergiesseverity-moderate" value="Moderate">
                    <label class="form-check-label" for="patient-list-aboutpatient-allergiesseverity-moderate">
                        Moderate
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="severity" id="patient-list-aboutpatient-allergiesseverity-extreme" value="Extreme">
                    <label class="form-check-label" for="patient-list-aboutpatient-allergiesseverity-extreme">
                        Extreme
                    </label>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 mb-3 text-end">
            <a href="{{ route('medicationreportorg') }}" class="btn btn-secondary me-2">Cancel</a>
            <button type="submit" class="btn btn-primary me-2">Save</button>
        </div>
    </form>
                
                <script>
                  document.getElementById("allergyForm").addEventListener("submit", function(event) {
                    event.preventDefault(); // Prevent the form from submitting
                
                    // Retrieve form data
                    var allergyName = document.getElementById("patient-list-medication-allergyform").value;
                    var allergySymptoms = document.getElementById("patient-list-medication-allergysymptomsform").value;
                    var severityLow = document.getElementById("patient-list-aboutpatient-allergiesseverity-low").checked;
                    var severityModerate = document.getElementById("patient-list-aboutpatient-allergiesseverity-moderate").checked;
                    var severityExtreme = document.getElementById("patient-list-aboutpatient-allergiesseverity-extreme").checked;
                
                    // Package the form data
                    var formData = {
                      allergyName: allergyName,
                      allergySymptoms: allergySymptoms,
                      severity: "",
                      dateAdded: new Date().toISOString() // Add the current date and time
                    };
                
                    // Determine the severity based on the form data
                    if (severityLow) {
                      formData.severity = "Low";
                    } else if (severityModerate) {
                      formData.severity = "Moderate";
                    } else if (severityExtreme) {
                      formData.severity = "Extreme";
                    }
                
                    // Retrieve previous entries from local storage
                    var previousEntries = JSON.parse(localStorage.getItem("allergyEntries")) || [];
                
                    // Add the new entry to the previous entries
                    previousEntries.unshift(formData);
                
                    // Store all entries in local storage
                    localStorage.setItem("allergyEntries", JSON.stringify(previousEntries));
                
                    // Reset the form
                    document.getElementById("allergyForm").reset();
                
                    // Redirect to the medication report page with the dateAdded as a query parameter
                    window.location.href = "patients-medication-report.html?dateAdded=" + encodeURIComponent(formData.dateAdded);
                  });
                </script>
                
          
          
          
          
          
          
            
                  
            </div>
        </div>
      </div>
    
  <script src="../assets/libs/jquery/dist/jquery.min.js"></script>
  <script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/js/sidebarmenu.js"></script>
  <script src="../assets/js/app.min.js"></script>
  <script src="../assets/libs/simplebar/dist/simplebar.js"></script>

  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

</body>

</html>
@endsection 