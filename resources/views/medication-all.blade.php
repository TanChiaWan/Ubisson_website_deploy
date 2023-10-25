@extends('layouts.app') 
@section('content')
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Medication List</title>
  <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
  <link rel="stylesheet" href="../assets/css/styles.min1.css" />

  <!-- Include DataTables CSS -->
  <!--<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">-->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="../assets/css/datatables2.css" rel="stylesheet">
</head>

<body>
  <!--  Body Wrapper -->
@csrf
      <!--  Header Start -->
    
      <!--  Header End -->
      <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <h5 class="card-title fw-semibold mb-2">Medication</h5>
                        @if (session('error'))
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        @foreach (explode('<br>', session('error')) as $error)
            {{ $error }}<br>
        @endforeach
    </div>
@endif
                        @if ($medicationCount>2)
                        <p class="mb-3">{{$medicationCount}} medications</p>    
                        @else
                        <p class="mb-3">{{$medicationCount}} medication</p> 
                        @endif
                    </div>
                    <div class="col-md-9 d-flex justify-content-end align-items-center">
                    <form id="importForm" action="{{ route('import_medication') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="btn btn-primary m-1 btn-with-icon" for="file">
        <i class="ti ti-plus"></i> Import Medication
        <input type="file" name="file" id="file" style="display: none;" onchange="submitForm()">
    </label>
    <!-- No need for a separate submit button -->
</form>

<script>
    // Function to submit the form
    function submitForm() {
        document.getElementById('importForm').submit();
    }
</script>



<a href="{{ route('download_template') }}" class="btn btn-primary m-1 btn-with-icon"><i class="ti ti-file-export"></i>Download Template</a>
<button type="button" class="btn btn-primary m-1 btn-with-icon" data-bs-toggle="modal" data-bs-target="#create-medication-modal">
  <i class="ti ti-plus"></i> Add Medication
</button>
                     
                    </div>
                </div>

                <!-- delete dialog box start-->
                  <div class="modal fade" id="delete_medication_data_modal" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered modal-sm">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Delete Medication Data</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">Are you sure you want to delete this medication?</div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                          @csrf
                          <button type="button" class="btn btn-danger" onclick="deleteMedication()">Delete</button>
                <!-- Hidden input field to store the medication id -->
                <input type="hidden" id="medication_id_to_delete" value="">
                        </div>
                      </div>
                    </div>
                </div>
                <script>

function deleteMedication() {
    var medicationId = document.getElementById('medication_id_to_delete').value;
    var url = "{{ route('deletemedication', ['medicationId' => ':medicationId']) }}";
    url = url.replace(':medicationId', medicationId);
    window.location.href = url;
}



function prepareDeleteModal(button) {
    var medicationId = button.getAttribute('data-id');
    document.getElementById('medication_id_to_delete').value = medicationId;
}


</script>

                <!-- delete dialog box end-->

                <!-- Modal for Add Medication (start)-->
                <form action="{{ route('medications.store') }}" method="POST">
    @csrf
    <div class="modal fade" id="create-medication-modal" tabindex="-1" role="dialog" aria-labelledby="create-medication-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="create-medication-modal-title">Create Medication</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="medication-create-input-brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" id="medication-create-input-brand_name" name="brand_name" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="medication-create-input-generic_name" class="form-label">Generic Name</label>
                            <input type="text" class="form-control" id="medication-create-input-generic_name" name="generic_name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="medication-create-input-atc_classification" class="form-label">ATC Classification</label>
                            <input type="text" class="form-control" id="medication-create-input-atc_classification" name="atc_classification" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="medication-create-input-formulation" class="form-label">Formulation</label>
                            <input type="text" class="form-control" id="medication-create-input-formulation" name="formulation" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </div>
</form>


                <!-- Modal for Add Medication (end)-->

               
                <div class="modal-body">

        <input type="hidden" name="medication_id" id="medication_id" value="">
                <div class="modal fade" id="edit_medication_data_modal" tabindex="-1" role="dialog" aria-labelledby="edit-medication-modal-title" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="edit-medication-modal-title">Edit Medication</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                   
                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <label for="medication-edit-input-brand_name" class="form-label">Brand Name</label>
                              <input type="text" class="form-control" id="medication-edit-input-brand_name"  required>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label for="medication-edit-input-generic_name" class="form-label">Generic Name</label>
                              <input type="text" class="form-control" id="medication-edit-input-generic_name"  required>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-12 mb-3">
                              <label for="medication-edit-input-atc_classification" class="form-label">ATC Classification</label>
                              <input type="text" class="form-control" id="medication-edit-input-atc_classification"  required>
                            </div>
                            <div class="col-md-12 mb-3">
                              <label for="medication-edit-input-formulation" class="form-label">Formulation</label>
                              <input type="text" class="form-control" id="medication-edit-input-formulation" required>
                            </div>
                          </div>
                      
                      </div>
                      <div class="modal-footer">
                      @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="editMedication()">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
         
                <!-- Modal for Edit Medication (end)-->

                <!-- table -->
                <div class="table-responsive table" style="overflow-y: hidden;">
                <table class="table text-nowrap mb-0 align-middle datatable">
        <thead class="text-dark fs-4">
            <tr style="background-color: #7ecbcc;">
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Brand Name</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Generic Name</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">ATC Classification</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Formulation</h6>
                </th>
                <th class="border-bottom-0">
                    <h6 class="fw-semibold mb-0">Action</h6>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($medication as $med)
            <tr data-id="{{ $med->id }}">
                <td class="border-bottom-0 brand-name">
                    <p class="mb-0 fw-normal ">{{ $med->brand_name }}</p>
                </td>
                <td class="border-bottom-0 generic-name">
                    <p class="mb-0 fw-normal">{{ $med->generic_name }}</p>
                </td>
                <td class="border-bottom-0 atc-classification">
                    <p class="mb-0 fw-normal">{{ $med->atc_classification }}</p>
                </td>
                <td class="border-bottom-0 formulation">
                    <p class="mb-0 fw-normal">{{ $med->formulation }}</p>
                </td>
                <td class="border-bottom-0">
                    <a href="#" class="text-center mx-2 fs-5" data-bs-toggle="modal" data-bs-target="#edit_medication_data_modal" data-id="{{ $med->id }}" onclick="prepareEditModal(this)"><i class="ti ti-pencil"></i></a>
                    <a href="#" class="text-center mx-2 fs-5" data-bs-toggle="modal" data-bs-target="#delete_medication_data_modal" data-id="{{ $med->id }}" onclick="prepareDeleteModal(this)"><i class="ti ti-trash"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
                  </div>
                
            </div>
        </div>
      </div>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <script>
function editMedication() {
  console.log("Editing medication...");

  var medicationId = document.getElementById('medication_id').value;
  var brandName = document.getElementById('medication-edit-input-brand_name').value;
  var genericName = document.getElementById('medication-edit-input-generic_name').value;
  var atcClassification = document.getElementById('medication-edit-input-atc_classification').value;
  var formulation = document.getElementById('medication-edit-input-formulation').value;

  var url = "{{ route('medications.update', ['medicationId' => ':medicationId']) }}";
  url = url.replace(':medicationId', medicationId);

  var data = {
    brand_name: brandName,
    generic_name: genericName,
    atc_classification: atcClassification,
    formulation: formulation,
    _token: "{{ csrf_token() }}",
    _method: "PUT"
  };

  fetch(url, {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
  .then(response => response.json())
  .then(data => {
    console.log("Server response:", data);

    var row = document.querySelector(`tr[data-id="${medicationId}"]`);
    if (row) {
      console.log("Updating table row:", row);
      row.querySelector(".brand-name").textContent = brandName;
      row.querySelector(".generic-name").textContent = genericName;
      row.querySelector(".atc-classification").textContent = atcClassification;
      row.querySelector(".formulation").textContent = formulation;
    } else {
      console.log("Table row not found:", medicationId);
    }

    // Close the modal
    $('#edit_medication_data_modal').modal('hide');
  })
  .catch(error => {
    console.error("AJAX error:", error);
  });
}
    function prepareEditModal(button) {
        var medicationId = button.getAttribute("data-id");
        var brandName = button.parentElement.parentElement.querySelector(".brand-name").textContent;
        var genericName = button.parentElement.parentElement.querySelector(".generic-name").textContent;
        var atcClassification = button.parentElement.parentElement.querySelector(".atc-classification").textContent;
        var formulation = button.parentElement.parentElement.querySelector(".formulation").textContent;

        document.getElementById("medication_id").value = medicationId;
        document.getElementById("medication-edit-input-brand_name").value = brandName;
        document.getElementById("medication-edit-input-generic_name").value = genericName;
        document.getElementById("medication-edit-input-atc_classification").value = atcClassification;
        document.getElementById("medication-edit-input-formulation").value = formulation;
    }
</script>
      <script>
    // Define the constant for DataTables library URL
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
</script>
  
</body>

</html>
@endsection 