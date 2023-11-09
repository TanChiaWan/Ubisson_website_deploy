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
          <form id="diagnosisForm" method="POST" action="{{ route('update.diagnosis.medicationorg') }}">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="card-title fw-semibold mb-4">Edit Patient Diagnosis</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check form-switch" style="float: right;">
                            <input class="form-check-input flexSwitchCheckChecked" type="checkbox" name="active" id="flexSwitchCheckChecked" {{ $diagnosis->active == 0 ? 'disabled' : '' }} {{ old('active', $diagnosis->active) == 1 ? 'checked' : null }}>
                            <label class="form-check-label" for="flexSwitchCheckChecked">Active</label>
                        </div>
                    </div>
                </div>
                @csrf
                <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="diagnosisTitle" class="form-label">Diagnosis Title</label>
                        <input type="text" class="form-control" id="diagnosisTitle" name="diagnosisTitle" placeholder="Enter the title of the diagnosis" pattern="[A-Za-z0-9\s_-/]+" required value="{{ old('diagnosisTitle', $diagnosis->diagnosis_title) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="startDate" class="form-label">Starting date of Diagnosis</label>
                        <input class="form-control" type="date" id="startDate" name="startDate" min="2000-01-01" max="2050-12-31" value="{{ old('startDate', $diagnosis->diagnosis_startdate) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="endDate" class="form-label">Ending date of Diagnosis</label>
                        <input class="form-control" type="date" id="endDate" name="endDate" min="2000-01-01" max="2050-12-31" value="{{ old('endDate', $diagnosis->diagnosis_enddate) }}">
                    </div>
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Severity</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="severity" id="lowSeverity" value="Low" {{ $diagnosis->severity == 'Low' ? 'checked' : '' }}>
                            <label class="form-check-label" for="lowSeverity">Low</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="severity" id="moderateSeverity" value="Moderate" {{ $diagnosis->severity == 'Moderate' ? 'checked' : '' }}>
                            <label class="form-check-label" for="moderateSeverity">Moderate</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="severity" id="extremeSeverity" value="Extreme" {{ $diagnosis->severity == 'Extreme' ? 'checked' : '' }}>
                            <label class="form-check-label" for="extremeSeverity">Extreme</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3 text-end">
                        <a href="{{ route('medicationreportorg') }}" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary me-2" id="saveButton">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>


              </div>
            </div>
          </div>
          
          <!-- Add the Bootstrap and your custom JavaScript code -->
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
          <script>
            document.getElementById("saveButton").addEventListener("click", function() {
              const diagnosisTitle = document.getElementById("diagnosisTitle").value;
              const startDate = document.getElementById("startDate").value;
              const endDate = document.getElementById("endDate").value;
              const severity = document.querySelector('input[name="severity"]:checked').value;
              const medication = document.getElementById("medication").value;
              const dosage = document.getElementById("dosage").value;
              const taken = document.getElementById("taken").value;
          
              const diagnosisData = {
                title: diagnosisTitle,
                startDate: startDate,
                endDate: endDate,
                severity: severity,
                medication: medication,
                dosage: dosage,
                taken: taken,
                added: new Date().toLocaleString(),
              };
          
              // Save data to local storage
              let savedDiagnosisData = JSON.parse(localStorage.getItem("diagnosisData")) || [];
              savedDiagnosisData.push(diagnosisData);
              localStorage.setItem("diagnosisData", JSON.stringify(savedDiagnosisData));
          
              // Display alert
              alert("Diagnosis and medication data saved successfully!");
          
              // Redirect after alert dismissal
              setTimeout(function() {
                window.location.href = "./patients-medication-report.html";
              }, 1000); // Redirect after 1 second (adjust if needed)
            });
          </script>
          






<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebarmenu.js"></script>
<script src="../assets/js/app.min.js"></script>
<script src="../assets/libs/simplebar/dist/simplebar.js"></script>





<!--Script for Toggle switch Active <-> Inactive--
<script>
  const checkboxes = document.querySelectorAll('.flexSwitchCheckChecked');
  
    checkboxes.forEach((checkbox) => {
      checkbox.addEventListener('change', function() {
        const label = this.nextElementSibling;
        if (this.checked) {
          label.textContent = "Active";
        } else {
          label.textContent = "Inactive";
        }
      });
    });
</script>
-->

    <!--

<-- Script to handle form submission ->
<script>
  // Function to handle form submission and save data to localStorage
  function handleFormSubmission(event) {
    event.preventDefault();

    // Get form data
    const formData = {
      diagnosisTitle: document.getElementById("patient-list-medication-diagnosisform").value,
      startDate: document.getElementById("patient-list-aboutpatient-dateofdiagnosis").value,
      endDate: document.getElementById("patient-list-aboutpatient-dateofdiagnosis").value,
      severity: document.querySelector('input[name="severity"]:checked').value,
      medication: document.getElementById("patient-list-aboutpatient-medication").value,
      dosage: document.getElementById("patient-list-medication-dosage").value,
      taken: document.getElementById("patient-list-medication-taken").value,
    };

    // Save data to localStorage
    localStorage.setItem("diagnosisData", JSON.stringify(formData));

    // Redirect to patients-medication-report.html
    window.location.href = "./patients-medication-report.html";
  }

  // Add event listener to the diagnosis form
  const diagnosisForm = document.getElementById("diagnosisForm");
  diagnosisForm.addEventListener("submit", handleFormSubmission);
</script>

      
-->      
              
                
<!--
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script>var status = document.getElementById("status").value;
    console.log("Selected Status:", status);
    </script>

-->

<!--

  <--Script for Creating Cards with Submitted Data--
  <script>
    // Function to format the date in "DD MMM YYYY HH:mm" format
    function formatDate(date) {
      var options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric' };
      return date.toLocaleDateString('en-US', options);
    }

    // Function to add the diagnosis form data to the medication report table
    function addDiagnosisToMedicationTable(formData) {
      var medicationTable = window.opener.document.getElementById("medicationTable");

      // Generate table row for the new diagnosis data
      var row = document.createElement("tr");
      var medicationCell = document.createElement("td");
      var dosageCell = document.createElement("td");
      var takenCell = document.createElement("td");
      var dateAddedCell = document.createElement("td");
      var inUseCell = document.createElement("td");
      var actionCell = document.createElement("td");

      medicationCell.classList.add("border-bottom-0");
      dosageCell.classList.add("border-bottom-0");
      takenCell.classList.add("border-bottom-0");
      dateAddedCell.classList.add("border-bottom-0");
      inUseCell.classList.add("border-bottom-0", "text-center", "align-middle");
      actionCell.classList.add("border-bottom-0", "align-middle");

      medicationCell.innerHTML = '<p class="mb-0 fw-normal">' + formData.medication + "</p>";
      dosageCell.innerHTML = '<p class="mb-0 fw-normal">' + formData.dosage + "</p>";
      takenCell.innerHTML = '<p class="mb-0 fw-normal">' + formData.taken + "</p>";
      dateAddedCell.innerHTML = '<p class="mb-0 fw-normal">' + formatDate(new Date()) + "</p>";
      inUseCell.innerHTML =
        '<div class="d-flex justify-content-center align-items-center"><div class="form-check"><input class="form-check-input flexSwitchCheckChecked" type="checkbox" value="" id="medicationCheckbox" style="border-color: #7ecbcc;"><label class="form-check-label" for="medicationCheckbox"></label></div></div>';
      actionCell.innerHTML = '<a href="#" class="text-center delete-entry"><i class="ti-trash ti"></i></a>';

      row.appendChild(medicationCell);
      row.appendChild(dosageCell);
      row.appendChild(takenCell);
      row.appendChild(dateAddedCell);
      row.appendChild(inUseCell);
      row.appendChild(actionCell);

      // Insert the new row into the medication table
      medicationTable.appendChild(row);
    }

    // Event listener to handle form submission
    document.getElementById("diagnosisForm").addEventListener("submit", function (event) {
      event.preventDefault();
      var formData = {
        medication: document.getElementById("patient-list-aboutpatient-medication").value,
        dosage: document.getElementById("patient-list-medication-dosage").value,
        taken: document.getElementById("patient-list-medication-taken").value,
      };

      // Pass the form data to the medication report page using the query string
      var queryString = "?medication=" + encodeURIComponent(formData.medication) +
                        "&dosage=" + encodeURIComponent(formData.dosage) +
                        "&taken=" + encodeURIComponent(formData.taken);

      // Open the medication report page with the query string
      window.open("./patients-medication-report.html" + queryString, "_blank");

      // Add the diagnosis data to the medication table in the medication report page
      addDiagnosisToMedicationTable(formData);

      // Reset the form
      document.getElementById("diagnosisForm").reset();
    });
  </script>
-->

<!--
<script>
                  document.getElementById("diagnosisForm").addEventListener("submit", function(event) {
                    event.preventDefault(); // Prevent the form from submitting
                
                    // Retrieve form data
                    var medication = document.getElementById("patient-list-aboutpatient-medication").value;
                    var dosage = document.getElementById("patient-list-medication-dosage").value;
                    var taken = document.getElementById("patient-list-medication-taken").value;
                    
                    // Package the form data
                    var formData = {
                      medication: medication,
                      dosage: dosage,
                      taken: taken,
                      dateAdded: new Date().toISOString() // Add the current date and time
                    };
          
                
                    // Retrieve previous entries from local storage
                    var previousEntries = JSON.parse(localStorage.getItem("diagnosisEntries")) || [];
                
                    // Add the new entry to the previous entries
                    previousEntries.unshift(formData);
                
                    // Store all entries in local storage
                    localStorage.setItem("diagnosisEntries", JSON.stringify(previousEntries));
                
                    // Reset the form
                    document.getElementById("diagnosisForm").reset();
                
                    // Redirect to the medication report page with the dateAdded as a query parameter
                    window.location.href = "patients-medication-report.html?dateAdded=" + encodeURIComponent(formData.dateAdded);
                  });
                </script>
              -->           

             
              
</body>
</html>
@endsection 