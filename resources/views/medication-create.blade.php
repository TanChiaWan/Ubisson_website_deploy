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
       <div class="container-fluid">
        <!-- Outer Tab -->
        <div class="d-flex justify-content-center">
          <div class="card d-inline-block">
            <div class="card-body py-1 px-4">
              <div class="row text-center">
                <div class="col-md-12 p-0">
                    <a href="patients-dashboard-general.html" class="btn btn-light m-1 btn-pagenav-notselected">Dashboard</a>
                    <a href="patients-aboutpatient.html" class="btn btn-light m-1 btn-pagenav-notselected">About Patient</a>
                    <a href="patients-logbook-BG.html" class="btn btn-light m-1 btn-pagenav-notselected">Logbook</a>
                    <a href="patients-healthdata.html" class="btn btn-light m-1 btn-pagenav-notselected">Health Data</a>
                    <a href="patients-remarks.html" class="btn btn-light m-1 btn-pagenav-notselected">Remarks</a>
                    <a href="#" class="btn btn-primary m-1 active">Medication</a>
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


                <form>
                    <legend></legend>
                    <div class="row">
                      <div class="col-md-12 mb-3">
                        <label for="patient-list-medication-medication" class="form-label">Medication</label>
                        <select class="form-select" id="patient-list-aboutpatient-medication" required>
                            <option value="" selected disabled>Select a medication</option>
                            @foreach ($medications as $medication)
                                <option value="{{ $medication->brand_name }}">{{ $medication->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                      <label for="patient-list-medication-dosage" class="form-label">Dosage</label>
                      <input type="text" class="form-control" id="patient-list-medication-dosage" placeholder="Enter the Dosage" pattern="[0-9.]+" required>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                      <label for="patient-list-medication-taken" class="form-label">Taken</label>
                      <select class="form-select" id="patient-list-medication-taken" required>
                        <option value="" selected disabled>Select time takan</option>
                        <option value=" beforeBreakfast">Before Breakfast</option>
                        <option value="afterBreakfast">After Breakfast</option>
                        <option value=" beforeLunch">Before Lunch</option>
                        <option value="afterLunch">After Lunch</option>
                        <option value="beforeDinner">Before Dinner</option>
                        <option value="afterDinner">After Dinner</option>
                    </select>
                </div>
                <div class="col-md-12 mb-3 text-end">
                  <a href="./patients-medication.html" class="btn btn-secondary">Cancel</a>
                  <button type="submit" class="btn btn-primary">Save<a href="./patients-medication-report.html"></a></button>
                </div>
                </form>
            
                  
            </div>
        </div>
      </div>


</body>

</html>