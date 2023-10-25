@extends('layouts.app2') 
@section('content')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>BioTectiveDRC</title>
  <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../../assets/css/styles.mintry.css" />
  <link rel="shortcut icon" type="image/png" href="../../assets/images/logos/BioTective Logo.png" />
</head>

<body>
  <!--  Body Wrapper -->

      <!--  Header Start -->
    
       <!--  Header End -->
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
                        <button type="submit"  class="btn btn-light m-1 btn-pagenav-notselected">About Patient</button>
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
                        <button type="submit"  class="btn btn-primary m-1 active">Medication</button>
                  </form>
                </div>
            </div>
            </div>
          </div>
        </div>
        
        <!-- Inner Tab -->
                <div class="row">
                  
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

          <div class="container-fluid">
            <div class="card">
                <div class="card-body">
     
              
              <h5 class="card-title fw-semibold mb-4">Create Patient Medication</h5>


              <form method="POST" action="{{ route('saveMedication') }}">
                
                @csrf
                @error('medication_id')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
                    <legend></legend>
                    <div class="row">
  <div class="col-md-12 mb-3">
    <label for="patient-list-medication-medication" class="form-label">Medication</label>

    <select class="form-select" id="patient-list-aboutpatient-medication" name='medication_id' required onchange="updateDosage()">
      <option value="" selected disabled>Select a medication</option>
      @foreach ($medication as $medication)
        <option value="{{ $medication-> id }}">{{ $medication->brand_name }}</option>
    @endforeach
    </select>

  </div>
  <input type="hidden" name="diagnosis_id" value="{{ $singleDiagnosis  }}" >
  <div class="col-md-12 mb-3">
    <label for="patient-list-medication-dosage" class="form-label">Dosage</label>
    
    <select class="form-select" id="patient-list-medication-dosage" name='dosage'required>
      <option value="" selected disabled>Select a Dosage</option>
     
                                <option value=""></option>
                           
    </select>
  </div>
</div>

                    
                    <div class="col-md-12 mb-3">
                      <label for="patient-list-medication-taken" class="form-label">Taken</label>
                      <select class="form-select" id="patient-list-medication-taken" name='taken' required>
                        <option value="" selected disabled>Select time taken</option>
                        <option value=" Before Breakfast">Before Breakfast</option>
                        <option value="After Breakfast">After Breakfast</option>
                        <option value=" Before Lunch">Before Lunch</option>
                        <option value="After Lunch">After Lunch</option>
                        <option value="Before Dinner">Before Dinner</option>
                        <option value="After Dinner">After Dinner</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3 text-end">
                  <a href="./patients-medication.html" class="btn btn-secondary me-2">Cancel</a>
                  <button type="submit" class="btn btn-primary me-2">Save<a href="./patients-medication-report.html"></a></button>
                </div>
                </form>
                <script>
            
function updateDosage() {
  var medicationSelect = document.getElementById('patient-list-aboutpatient-medication');
var selectedOption = medicationSelect.options[medicationSelect.selectedIndex];
var selectedText = selectedOption.textContent;
    var dosageSelect = document.getElementById('patient-list-medication-dosage');

    
    var medicationInfo = selectedText.trim(); // Trim any leading/trailing spaces

    // Clear existing options except the first one
    var optionsToRemove = dosageSelect.querySelectorAll('option:not(:first-child)');
    optionsToRemove.forEach(function(option) {
        dosageSelect.removeChild(option);
    });

    // Define regular expressions to match different dosage formats
    var dosagePattern1 = /(\d+\.?\d*)\s?mg/g; // Matches dosage in the format Xmg
    var dosagePattern2 = /(\d+\.?\d*)\/(\d+\.?\d*)\s?mg/g; // Matches dosage in the format Xmg/Ymg

    // Attempt to match dosage in different formats
    var dosageMatches1 = medicationInfo.match(dosagePattern1);
    var dosageMatches2 = medicationInfo.match(dosagePattern2);

    if (dosageMatches1) {
        // Handle dosage in the format Xmg
        dosageMatches1.forEach(function(match) {
            var dosageOption = document.createElement('option');
            dosageOption.value = match.trim();
            dosageOption.text = match.trim();
            dosageSelect.appendChild(dosageOption);
        });
    } else if (dosageMatches2) {
        // Handle dosage in the format Xmg/Ymg
        dosageMatches2.forEach(function(match) {
            var dosageOption = document.createElement('option');
            dosageOption.value = match.trim();
            dosageOption.text = match.trim();
            dosageSelect.appendChild(dosageOption);
        });
    } else {
        // No dosage detected, add a default option
        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.text = 'No dosage information available';
        dosageSelect.appendChild(defaultOption);
    }

    // Select the first dosage option as the default
    if (dosageSelect.options.length > 1) {
        dosageSelect.value = dosageSelect.options[1].value;
    }
}


</script>
               
            
                  
            </div>
        </div>
      </div>
    </div>
  </div>
 

</body>

</html>
@endsection 