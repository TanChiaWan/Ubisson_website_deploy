@extends('layouts.patapp') 
@section('content')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Allergy and Diagnosis</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.mintry.css" />

  <!-- Include DataTables CSS -->
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">-->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/simple-datatables@6.0" type="text/javascript"></script>
            <link href="../assets/css/datatables3.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

  <!-- Buttons CSS -->
  <!--<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">-->
 



  
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

        <!-- Content -->
   
            <div class="row">
                <div class="col-md-12 mb-3 text-end">
                <form action="{{ route('addallergy') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 btn-with-icon"><i class="ti ti-plus"></i>Add allergies record</button>
                  </form>
                  <form action="{{ route('adddiagnosis') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 btn-with-icon"><i class="ti ti-plus"></i>Add diagnosis record</button>
                  </form>
                  
                </div>
            </div>
            
            
            <div class="row">
            <h5 class="card-title fw-semibold mb-4">Allergic Information</h5>
            <div class="card">
              <div class="card-body">
                <div class="row">
                @isset($singleallergy->allergy_id)
                <div class="modal fade" id="delete_health_data_modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Allergy</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you sure you want to delete this data?</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                      <form action="{{ route('deleteallergy', ['patientId' => $patient->patient_id, 'allergy_Id' => $singleallergy->allergy_id, 'professionalId' => $user->professional_id]) }}" method="GET" style="display: inline-block;">
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        
                        <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                     
                    
                    </div>
                  </div>
                </div>
            </div>
            @endif
                 
                      
                  <form>
                    <!-- Allergy Information -->
                    <div class="table-responsive table" style="overflow-y: hidden;">
                      <table class="table text-nowrap mb-0 align-middle datatable">
                        <thead class="text-dark fs-4" style="text-decoration-line: underline; text-decoration-color: #7ecbcc; text-decoration-thickness: 2px;">
                          <tr>
                            <th class="txtline text-center">
                              <h6 class="fw-semibold mb-0">Date Added</h6>
                            </th>
                            <th class="txtline text-center">
                              <h6 class="fw-semibold mb-0">Allergy Name</h6>
                            </th>
                            <th class="txtline text-center">
                              <h6 class="fw-semibold mb-0">Allergy Symptoms</h6>
                            </th>
                            <th class="txtline text-center">
                              <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                          </tr>
                        </thead>
                        <tbody id="allergyTableBody">
                        @foreach($allergy as $allergy)
                        <tr>
                          <td class="border-bottom-0"><p class="mb-0 fw-normal">{{$allergy->allergycreated_date}}</p></td>
                          <td class="border-bottom-0"><p class="mb-0 fw-normal">{{$allergy->allergy_name}}</p></td>
                          <td class="border-bottom-0"><p class="mb-0 fw-normal">{{$allergy->allergy_symptoms}}</p></td>
                          <td class="border-bottom-0 align-middle"><a href="#" class="text-center delete-entry" data-bs-toggle="modal" data-bs-target="#delete_health_data_modal"><i class="ti-trash ti"></i></a></td>
                        </tr>
                        @endforeach
                          <!-- Table rows will be dynamically populated -->
                        </tbody>
                      </table>
                    </div>
                  </form>
                  
<script>
const DATATABLES_URL = 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js';
   $(document).ready(function() {
        // Load DataTables library dynamically
        loadScript(DATATABLES_URL, function() {
            $('.datatable').DataTable({
              lengthMenu: [5, 10, 25, 100], // Define the available entries options
          
            });
        });
    });

    // Function to dynamically load a script
    function loadScript(url, callback) {
        var script = document.createElement('script');
        script.src = url;
        script.onload = callback;
        document.head.appendChild(script);
    }
                    
                    function deletes(patientId, allergy_Id,professionalId) {
                        var url = "{{ route('deleteallergy', ['patientId' => ':patientId', 'allergy_Id' => ':allergy_Id','professionalId' => ':professionalId']) }}";
                        url = url.replace(':patientId', patientId);
                        url = url.replace(':allergy_Id', allergy_Id);
                        url = url.replace(':professionalId', professionalId);
                        window.location.href = url;
                    }
                    // Function to format the date in "DD MMM YYYY HH:mm" format
                    function formatDate(date) {
                      var options = { year: 'numeric', month: 'short', day: 'numeric', hour: 'numeric', minute: 'numeric' };
                      return date.toLocaleDateString('en-US', options);
                    }
                  
                    // Function to add the form data to the table
                    function addFormDataToTable(formData) {
                      var allergyTableBody = document.getElementById("allergyTableBody");
                  
                      // Generate table row for the new form data
                      var row = document.createElement("tr");
                      var dateAddedCell = document.createElement("td");
                      var nameCell = document.createElement("td");
                      var symptomsCell = document.createElement("td");
                      var actionsCell = document.createElement("td");
                  
                      dateAddedCell.classList.add("border-bottom-0");
                      nameCell.classList.add("border-bottom-0");
                      symptomsCell.classList.add("border-bottom-0");
                      actionsCell.classList.add("border-bottom-0", "align-middle");
                  
                      var currentDate = new Date(formData.dateAdded); // Use the submitted date
                      dateAddedCell.innerHTML = '<p class="mb-0 fw-normal">' + formatDate(currentDate) + "</p>";
                      nameCell.innerHTML = '<p class="mb-0 fw-normal">' + formData.allergyName + "</p>";
                      symptomsCell.innerHTML = '<p class="mb-0 fw-normal">' + formData.allergySymptoms + "</p>";
                  
                      var deleteLink = document.createElement("a");
                      deleteLink.href = "#";
                      deleteLink.classList.add("text-center", "delete-entry");
                      deleteLink.innerHTML = '<i class="ti-trash ti"></i>';
                  
                      deleteLink.addEventListener("click", function (event) {
                        event.preventDefault();
                        var row = event.target.closest("tr");
                        row.parentNode.removeChild(row);
                  
                        // Retrieve form data from the row
                        var formData = {
                          dateAdded: new Date(row.cells[0].textContent.trim()),
                          allergyName: row.cells[1].textContent.trim(),
                          allergySymptoms: row.cells[2].textContent.trim(),
                        };
                  
                        // Retrieve previous entries from local storage
                        var storedEntries = JSON.parse(localStorage.getItem("allergyEntries")) || [];
                  
                        // Remove the entry from the stored entries
                        var filteredEntries = storedEntries.filter(function (entry) {
                          return (
                            entry.dateAdded.getTime() !== formData.dateAdded.getTime() ||
                            entry.allergyName !== formData.allergyName ||
                            entry.allergySymptoms !== formData.allergySymptoms
                          );
                        });
                  
                        // Store the updated entries in local storage
                        localStorage.setItem("allergyEntries", JSON.stringify(filteredEntries));
                      });
                  
                      actionsCell.appendChild(deleteLink);
                  
                      row.appendChild(dateAddedCell);
                      row.appendChild(nameCell);
                      row.appendChild(symptomsCell);
                      row.appendChild(actionsCell);
                  
                      // Insert the new row at the beginning of the table
                      allergyTableBody.insertBefore(row, allergyTableBody.firstChild);
                    }
                  
                    // Event listener to handle delete entry
                    document.addEventListener("click", function (event) {
                      if (event.target.classList.contains("delete-entry")) {
                        event.preventDefault();
                        var row = event.target.closest("tr");
                        row.parentNode.removeChild(row);
                  
                        // Retrieve form data from the row
                        var formData = {
                          dateAdded: new Date(row.cells[0].textContent.trim()),
                          allergyName: row.cells[1].textContent.trim(),
                          allergySymptoms: row.cells[2].textContent.trim(),
                        };
                  
                        // Retrieve previous entries from local storage
                        var storedEntries = JSON.parse(localStorage.getItem("allergyEntries")) || [];
                  
                        // Remove the entry from the stored entries
                        var filteredEntries = storedEntries.filter(function (entry) {
                          return (
                            entry.dateAdded.getTime() !== formData.dateAdded.getTime() ||
                            entry.allergyName !== formData.allergyName ||
                            entry.allergySymptoms !== formData.allergySymptoms
                          );
                        });
                  
                        // Store the updated entries in local storage
                        localStorage.setItem("allergyEntries", JSON.stringify(filteredEntries));
                      }
                    });
                  
                    // Function to initialize the page
                    function initializePage() {
                      var previousEntries = JSON.parse(localStorage.getItem("allergyEntries")) || [];
                      var filteredEntries = previousEntries.filter(function (entry) {
                        return document.getElementById('allergyTableBody').innerHTML.indexOf(entry.dateAdded) === -1;
                      });
                  
                      filteredEntries.forEach(function (data) {
                        addFormDataToTable(data);
                      });
                    }
                  
                    // Call the initialization function when the page loads
                    window.addEventListener("DOMContentLoaded", initializePage);
</script>
                  
                
                  
              </div>
            </div>
          </div>
</div>
            
            
                
               
            
            

    
      <!-- Diagnosis Record -->
<div class="row">
  <h5 class="card-title fw-semibold mb-4">Diagnosis Record</h5>
  <div class="card">
    <div class="card-body">
      <div class="row">
      <div class="row">
  <div class="col-md-12 mb-4 text-center">
    
    <button class="btn btn-primary m-2" onclick="filterActive()">Active</button>
    <button class="btn btn-primary m-2" onclick="filterInactive()">Inactive</button>
  </div>
</div>
        <!-- Add this div to hold the card diagnoses, will be added here dynamically -->
        <div id="cardDiagnosesContainer" class="diagnosis-container">
        @foreach($diagnosis as $singleDiagnosis)
    
        <div class="card diagnosis-card" data-active="{{ $singleDiagnosis->active }}">
  <div class="card-body">
    
    <h5 class="card-title fw-semibold mb-4">{{$singleDiagnosis->diagnosis_title}}</h5>
   @php
                $matchingProfessional = $professional->firstWhere('professional_id', $singleDiagnosis->professional_id);
            @endphp
            @if ($matchingProfessional)
                <p class="mb-0">Diagnosed by {{ $matchingProfessional->professional_name }}</p>
            @endif
    <!-- ... rest of the card content ... -->
 
        <div class="row">
          <div class="col-md-12 d-flex justify-content-end">
          <form action="{{ route('patient-medicine-create') }}" method="POST" style="display:inline-block;">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
    <input type="hidden" name="diagnosisid" value="{{ $singleDiagnosis->diagnosis_id }}">
    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
    <button type="submit" class="btn btn-primary my-2 btn-with-icon"><i class="ti ti-plus"></i> Add Medication</button>
</form>

<form action="{{ route('edit-diagnosis', $singleDiagnosis->diagnosis_id) }}" method="POST" style="display:inline-block;">
    @csrf
    <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
    <input type="hidden" name="diagnosisid" value="{{ $singleDiagnosis->diagnosis_id }}">
    <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
    <button type="submit" class="btn btn-primary m-2 btn-with-icon"><i class="ti ti-pencil"></i> Edit Diagnosis <i class="fas fa-edit"></i></button>
</form>

          </div>
        </div>

        <div class="table-responsive table " style="overflow-y: hidden;">
          <table class="table text-nowrap mb-0 align-middle datatable">
            <thead class="text-dark fs-4">
              <tr style="background-color: #7ecbcc;">
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Medication</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Dosage</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Taken</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Date Taken</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Date Added</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">In Use</h6>
                </th>
                <th class="border-bottom-0">
                  <h6 class="fw-semibold mb-0">Action</h6>
                </th>
              </tr>
            </thead>
            <tbody>
            @foreach ($medicationindiagnosis as $medicationInDiagnosis)
        @if ($medicationInDiagnosis->diagnosis_id == $singleDiagnosis->diagnosis_id)
            <tr>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">
                        {{ $medication->firstWhere('id', $medicationInDiagnosis->medication_id)->brand_name }}
                    </p>
                </td>
                <td class="border-bottom-0">
                    <p class="mb-0 fw-normal">{{ $medicationInDiagnosis->dosage }}</p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal">{{$medicationInDiagnosis->taken}}</p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal">{{$singleDiagnosis->date_taken}}</p>
                </td>
                <td class="border-bottom-0">
                  <p class="mb-0 fw-normal">{{$singleDiagnosis->diagnosiscreated_date}}</p>
                </td>
              
@csrf
                <td class="border-bottom-0 text-center align-middle" id="inUseCell">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="form-check">
                            <input class="form-check-input flexSwitchCheckInUse" type="checkbox"  id="medicationCheckbox_{{ $singleDiagnosis->diagnosis_id }}" style="border-color: #7ecbcc;"  data-diagnosis-id="{{ $singleDiagnosis->diagnosis_id }}" data-inuse="{{ $singleDiagnosis->inuse }}">
                            <label class="form-check-label" for="medicationCheckbox_{{ $singleDiagnosis->diagnosis_id }}"></label>
                        </div>
                    </div>
                </td>
                
                <td class="border-bottom-0 align-middle">
                  <a href="#" class="text-center"><i class="ti-trash ti"></i></a>
                </td>
              </tr>
              @endif
              @endforeach
            </tbody>
          </table>
        </div>


        <div class="col-md-12 text-end">
    <div class="form-check form-switch" style="float: right;">
        <input class="form-check-input flexSwitchCheckChecked" type="checkbox"
            id="flexSwitchCheckChecked_{{ $singleDiagnosis->diagnosis_id }}"
            data-diagnosis-id="{{ $singleDiagnosis->diagnosis_id }}"
            data-active="{{ $singleDiagnosis->active }}"
            {{ $singleDiagnosis->active === 0 ? 'disabled' : '' }}>
        <label class="form-check-label"
            for="flexSwitchCheckChecked_{{ $singleDiagnosis->diagnosis_id }}">Active</label>
    </div>
</div>

            </div>
      
      </div>
     
      @endforeach

        </div>
      </div>

      <!-- "No records" message, initially hidden -->
      <p id="noRecordsMessage" style="display: none;">No records to show.</p>
    </div>
  </div>
</div>

<!-- Add the Bootstrap and your custom JavaScript code -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



            <!--</div>-->
            </div>
          
                  
                  


            
                    

           
                  
            </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  function filterActive() {
    toggleDiagnosisCards(true);
  }

  function filterInactive() {
    toggleDiagnosisCards(false);
  }

  function toggleDiagnosisCards(active) {
    const diagnosisCards = document.querySelectorAll('.diagnosis-card');

    diagnosisCards.forEach(card => {
      const cardActive = card.getAttribute('data-active') === '1';
      if ((active && cardActive) || (!active && !cardActive)) {
        card.style.display = 'block';
      } else {
        card.style.display = 'none';
      }
    });
  }
  window.onload = function() {
    filterActive();
  };
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxes = document.querySelectorAll('.flexSwitchCheckChecked');

        checkboxes.forEach(checkbox => {
            const isActive = checkbox.dataset.active === '1';
            checkbox.checked = isActive;

            checkbox.addEventListener('change', function() {
                const newActiveState = this.checked;
                const diagnosisId = this.dataset.diagnosisId;
                
                // Send AJAX request to update the active status
                fetch(`/update-diagnosis-active/${diagnosisId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ active: newActiveState })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the label text
                        
                        // Automatically refresh the page
                        location.reload();
                    }
                })
                .catch(error => {
                    console.error('Error updating active status:', error);
                });
            });
        });
    });
</script>



<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const checkboxesInUse = document.querySelectorAll('.flexSwitchCheckInUse');

        checkboxesInUse.forEach(checkbox => {
            const initialInUseState = checkbox.dataset.inuse === '1';
            checkbox.checked = initialInUseState;

            checkbox.addEventListener('change', function() {
                const newInUseState = this.checked;
                const diagnosisId = this.dataset.diagnosisId;

                // Send AJAX request to update the inuse status
                fetch(`/update-diagnosis-inuse/${diagnosisId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ inuse: newInUseState })
                })
                .then(response => response.json())
                .catch(error => {
                    console.error('Error updating inuse status:', error);
                });
            });
        });
    });
</script>






</body>

</html>
@endsection 