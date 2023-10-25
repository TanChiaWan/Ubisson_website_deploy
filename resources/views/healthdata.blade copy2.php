@extends('layouts.patapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Health Data</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="../assets/css/datatables3.css" rel="stylesheet">

<style>

</style>
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
                        <button type="submit"  class="btn btn-primary m-1 active">Health Data</button>
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
        <div class="card">
          <div class="card-body">
         
            
            <div class="row">
                <div class="col-md-12 text-center">
                <form action="{{ route('addhealthdata') }}" method="POST" style='display:inline-block;'>
                          @csrf
                        <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                        <button type="submit"  class="btn btn-primary m-1 btn-with-icon"><i class="ti ti-plus"></i>Add Health Data</button>
                  </form>
                    
                    <button type="button" class="btn btn-primary m-1 btn-with-icon" id="export_healthdata_button" onclick="exported('{{ $patient->patient_id }}')"><i class="ti ti-file-export"></i>Export</button>
                </div>
            </div>
           
            <!-- delete dialog box start-->
            <div class="modal fade" id="delete_health_data_modal" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Delete Health Data</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">Are you sure you want to delete this data?</div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                      <button type="button" class="btn btn-danger"   onclick="deleted('{{ $patient->patient_id }}', '{{ $singleHealthData->healthdata_id }}')">Delete</button>
                    
                    </div>
                  </div>
                </div>
            </div>
            <!-- delete dialog box end-->

            <!-- checkboxes -->
            <div class="row">
              <div class="col-md-12 text-center mt-3">
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-general" class="checkbox form-check-input" checked>
                  General
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-glucose" class="checkbox form-check-input" checked>
                  Glucose
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-lipids" class="checkbox form-check-input" checked>
                  Lipids
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-pancreas" class="checkbox form-check-input" checked>
                  Pancreas
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-urine" class="checkbox form-check-input" checked>
                  Urine
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-kidneys" class="checkbox form-check-input" checked>
                  Kidneys
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-electrolysis" class="checkbox form-check-input" checked>
                  Electrolysis
                </label>
                <label class="mx-2">
                  <input type="checkbox" id="checkbox-livers" class="checkbox form-check-input" checked>
                  Liver
                </label>
              </div>
            </div>

            <div class="table-responsive table" style="overflow-y: hidden;">
                <table class=" text-nowrap mb-0 align-middle datatable" style="padding:0px;">
                    <thead class="text-dark fs-4">
                        <!--datatable cannot use are caused by this-->
                      <tr style="background-color: #3ab4b6" class="health-data-tr-title">
                         <th colspan="3" class="border-bottom-0"> 
                              <h6 class="fw-semibold mb-0"></h6>
                          </th>
                          <th colspan="5" class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">General</h6>
                          </th>
                          <th colspan="2" class="category_glucose border-bottom-0">
                              <h6 class="fw-semibold mb-0">Glucose</h6>
                          </th>
                          <th colspan="4" class="category_lipids border-bottom-0">
                              <h6 class="fw-semibold mb-0">Lipids</h6>
                          </th>
                          <th colspan="1" class="category_pancreas border-bottom-0">
                              <h6 class="fw-semibold mb-0">Pancreas</h6>
                          </th>
                          <th colspan="4" class="category_kidneys border-bottom-0">
                              <h6 class="fw-semibold mb-0">Kidneys</h6>
                          </th>
                          <th colspan="4" class="category_urine border-bottom-0">
                              <h6 class="fw-semibold mb-0">Urine</h6>
                          </th>
                          <th colspan="4" class="category_electrolysis border-bottom-0">
                              <h6 class="fw-semibold mb-0">Electrolysis</h6>
                          </th>
                          <th colspan="2" class="category_livers border-bottom-0">
                              <h6 class="fw-semibold mb-0">Liver</h6>
                          </th>
                      </tr>


                        <tr style="background-color: #7ecbcc;">
                            <th class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">Action</h6>
                            </th>
                            <th class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">Data Originate</h6>
                            </th>
                            <th class="border-bottom-0">
                              <h6 class="fw-semibold mb-0">Date</h6>
                            </th>
                            <th class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">Weight(kg)</h6>
                            </th>
                            <th class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">Height(cm)</h6>
                            </th>
                            <th class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">SBP/DBP(mmHg)</h6>
                            </th>
                            <th class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">Pulse Rate(bpm)</h6>
                            </th>
                            @if ($user->temperature_unit === 'Celcius (°C)')
                            <th class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">Celsius(°C)</h6>
                            </th>
                            @else
                            <th class="category_general border-bottom-0">
                              <h6 class="fw-semibold mb-0">Fahrenheit(°F)</h6>
                            </th>
                            @endif
                            <th class="category_glucose border-bottom-0">
                              <h6 class="fw-semibold mb-0">a1cPercentage(%)</h6>
                            </th>
                            <th class="category_glucose border-bottom-0">
                              <h6 class="fw-semibold mb-0">GA(%)</h6>
                            </th>
                           
                            <th class="category_lipids border-bottom-0">
                              <h6 class="fw-semibold mb-0">CHO(mmol/L)</h6>
                            </th>
                            <th class="category_lipids border-bottom-0">
                              <h6 class="fw-semibold mb-0">HDL(mmol/L)</h6>
                            </th>
                            <th class="category_lipids border-bottom-0">
                              <h6 class="fw-semibold mb-0">LDL-C(mmol/L)</h6>
                            </th>
                            <th class="category_lipids border-bottom-0">
                              <h6 class="fw-semibold mb-0">TG(mmol/L)</h6>
                            </th>
                            <th class="category_pancreas border-bottom-0">
                              <h6 class="fw-semibold mb-0">C-peptide(pmol/L)</h6>
                            </th>
                            <th class="category_kidneys border-bottom-0">
                              <h6 class="fw-semibold mb-0">CKD Stage</h6>
                            </th>
                            <th class="category_kidneys border-bottom-0">
                              <h6 class="fw-semibold mb-0">CRE(µmol/L)</h6>
                            </th>
                            <th class="category_kidneys border-bottom-0">
                              <h6 class="fw-semibold mb-0">UA(mmol/L)</h6>
                            </th>
                            <th class="category_kidneys border-bottom-0">
                              <h6 class="fw-semibold mb-0">eGFR(mL/min)</h6>
                            </th>
                            <th class="category_urine border-bottom-0">
                              <h6 class="fw-semibold mb-0">ACR(mg/mmol)</h6>
                            </th>
                            <th class="category_urine border-bottom-0">
                              <h6 class="fw-semibold mb-0">MA(mg/L)</h6>
                            </th>
                            <th class="category_urine border-bottom-0">
                              <h6 class="fw-semibold mb-0">PRO(mg/L)</h6>
                            </th>
                            <th class="category_urine border-bottom-0">
                              <h6 class="fw-semibold mb-0">UPCR(mg/mmol)</h6>
                            </th>
                            <th class="category_electrolysis border-bottom-0">
                              <h6 class="fw-semibold mb-0">CA(mg/dL)</h6>
                            </th>
                            <th class="category_electrolysis border-bottom-0">
                              <h6 class="fw-semibold mb-0">K(mmol/L)</h6>
                            </th>
                            <th class="category_electrolysis border-bottom-0">
                              <h6 class="fw-semibold mb-0">NA(mmol/L)</h6>
                            </th>
                            <th class="category_electrolysis border-bottom-0">
                              <h6 class="fw-semibold mb-0">P(mg/dL)</h6>
                            </th>
                            <th class="category_livers border-bottom-0">
                              <h6 class="fw-semibold mb-0">GPT/ALT(U/L)</h6>
                            </th>
                            <th class="category_livers border-bottom-0">
                              <h6 class="fw-semibold mb-0">GOT(U/L)</h6>
                            </th>

                            
                          </tr>
                    </thead>
                    <tbody>
                       
                        
                        @foreach ($healthdata as $data)
                    @if ($data->patient_id_FK === $patient->patient_id)
                    <tr>
                        <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">
                                <a href="#" class="mx-2 fs-5"><i class="ti ti-pencil"></i></a>
                                <a href="#" class="mx-2 fs-5" data-bs-toggle="modal" data-bs-target="#delete_health_data_modal"><i class="ti ti-trash"></i></a>
                            </p>
                        </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">Patient</p>
                          </td>
                          <td class="border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->date }}</p>
                          </td>
                          <td class="category_general border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->weight }}</p>
                          </td>
                          <td class="category_general border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->height }}</p>
                          </td>
                          <td class="category_general border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->sbp }}/{{ $data->dbp }}</p>
                          </td>
                          
                          <td class="category_general border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->pulse }}</p>
                          </td>
                          @if ($user->temperature_unit === 'Celcius (°C)')
                          <td class="category_general border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->celcius }}</p>
                          </td>
                          
                          @else
                          <td class="category_general border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->fahrenheit }}</p>
                          </td>
                          @endif
                          <td class="category_glucose border-bottom-0" data-toggle="tooltip"  data-operator="{{ $data->operator }}" data-lotview="{{ $data->lotview }}" data-instid="{{ $data->instid }}" data-testid="{{ $data->testID }}">
                            <p class="mb-0 fw-normal">{{ $data->a1cpercentage }}</p>
                          </td>
                          <td class="category_glucose border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->ga }}</p>
                          </td>
            
                          <td class="category_lipids border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->cho }}</p>
                          </td>
                          <td class="category_lipids border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->hdl }}</p>
                          </td>
                          <td class="category_lipids border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->ldlc }}</p>
                          </td>
                          <td class="category_lipids border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->tg }}</p>
                          </td>
                          <td class="category_pancreas border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->cpeptide }}</p>
                          </td>  
                          <td class="category_kidneys border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->ckdstage }}</p>
                          </td>  
                          <td class="category_kidneys border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->cre }}</p>
                          </td>  
                          <td class="category_kidneys border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->ua }}</p>
                          </td>  
                          <td class="category_kidneys border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->egfr }}</p>
                          </td>  
                          <td class="category_urine border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->acr }}</p>
                          </td>  
                          <td class="category_urine border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->ma }}</p>
                          </td>  
                          <td class="category_urine border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->pro }}</p>
                          </td>  
                          <td class="category_urine border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->upcr }}</p>
                          </td>
                          <td class="category_electrolysis border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->ca }}</p>
                          </td>  
                          <td class="category_electrolysis border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->k }}</p>
                          </td>  
                          <td class="category_electrolysis border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->na }}</p>
                          </td>  
                          <td class="category_electrolysis border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->p }}</p>
                          </td>
                          <td class="category_livers border-bottom-0">
                          <p class="mb-0 fw-normal">{{ $data->{'gpt/alt'} }}</p>
                          </td>  
                          <td class="category_livers border-bottom-0">
                            <p class="mb-0 fw-normal">{{ $data->got }}</p>
                          </td>
                          </tr>
                            @endif
                            @endforeach

                        
                        
                    </tbody>
                </table>
            </div>
                  
            </div>
        </div>
    </div>

    <script>
    // Define the constant for DataTables library URL
    const DATATABLES_URL = 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js';

    $(document).ready(function() {
        // Load DataTables library dynamically
        loadScript(DATATABLES_URL, function() {
            $('.datatable').DataTable({
              lengthMenu: [5, 10, 25, 100], // Define the available entries options
                scrollX: true
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

<!-- Script for checkboxes -->
<script defer>
  document.addEventListener('DOMContentLoaded', function() {
   
 
    const checkbox_general = document.getElementById('checkbox-general');
    const checkbox_glucose = document.getElementById('checkbox-glucose');
    const checkbox_lipids = document.getElementById('checkbox-lipids');
    const checkbox_urine = document.getElementById('checkbox-urine');
    const checkbox_pancreas = document.getElementById('checkbox-pancreas');
    const checkbox_kidneys = document.getElementById('checkbox-kidneys');
    const checkbox_livers = document.getElementById('checkbox-livers');
    const checkbox_electrolysis = document.getElementById('checkbox-electrolysis');
    
    
    var table_cells_general = document.querySelectorAll('.category_general');
    var table_cells_glucose = document.querySelectorAll('.category_glucose');
    var table_cells_lipids = document.querySelectorAll('.category_lipids');
    var table_cells_urine = document.querySelectorAll('.category_urine');
    var table_cells_pancreas = document.querySelectorAll('.category_pancreas');
    var table_cells_kidneys = document.querySelectorAll('.category_kidneys');
    var table_cells_livers = document.querySelectorAll('.category_livers'); 
    var table_cells_electrolysis = document.querySelectorAll('.category_electrolysis');

    function eventCheckbox() {
  checkbox_lipids.addEventListener('change', function() {
    if (this.checked) {
      table_cells_lipids.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_lipids.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_general.addEventListener('change', function() {
    if (this.checked) {
      table_cells_general.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_general.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_glucose.addEventListener('change', function() {
    if (this.checked) {
      table_cells_glucose.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_glucose.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_urine.addEventListener('change', function() {
    if (this.checked) {
      table_cells_urine.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_urine.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_pancreas.addEventListener('change', function() {
    if (this.checked) {
      table_cells_pancreas.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_pancreas.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_kidneys.addEventListener('change', function() {
    if (this.checked) {
      table_cells_kidneys.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_kidneys.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_livers.addEventListener('change', function() {
    if (this.checked) {
      table_cells_livers.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_livers.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });

  checkbox_electrolysis.addEventListener('change', function() {
    if (this.checked) {
      table_cells_electrolysis.forEach(cell => {
        cell.style.display = "table-cell";
      });
    } else {
      table_cells_electrolysis.forEach(cell => {
        cell.style.display = "none";
      });
    }
  });
}


    function runScript() {
      eventCheckbox(); 
    }

    runScript();

  })
</script>
    <script>
 function exported(patientId) {
    var url = "{{ route('exports', ['patientId' => ':patientId']) }}";
    url = url.replace(':patientId', patientId);
    window.location.href = url;
}

function deleted(patientId, healthdataId) {
    var url = "{{ route('deletes', ['patientId' => ':patientId', 'healthdataId' => ':healthdataId']) }}";
    url = url.replace(':patientId', patientId);
    url = url.replace(':healthdataId', healthdataId);
    window.location.href = url;
}

$(document).ready(function () {
  $('[data-toggle="tooltip"]').tooltip({
    trigger: 'hover',
    placement: 'right',
    html: true,
  // Replace the existing tooltip content generation logic
  title: function () {
  
  const ga = $(this).data('ga');
  const operator = $(this).data('operator');
  const lotView = $(this).data('lotview');
  const instID = $(this).data('instid');
  const testID = $(this).data('testid');

  // Check if any of the data attributes is empty
  if (!lotView && !instID && !testID && !operator && !ga) {
    return 'No information available';
  }

  // Build the tooltip content
  let tooltipContent = '';

  // Append the data attributes if they exist
  if (lotView) {
    tooltipContent += `<strong>Lot View:</strong> ${lotView}<br>`;
  }
  if (instID) {
    tooltipContent += `<strong>Inst ID:</strong> ${instID}<br>`;
  }
  if (testID) {
    tooltipContent += `<strong>Test ID:</strong> ${testID}<br>`;
  }
  if (operator) {
    tooltipContent += `<strong>Operator:</strong> ${operator}<br>`;
  }
  



  return tooltipContent;
},



  });
});

    </script>                       
              


                                        

</body>
</html>
@endsection