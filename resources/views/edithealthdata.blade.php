@extends('layouts.patapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Edit Health Data</title>
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
            <h5 class="card-title fw-semibold mb-4">Edit Health Data</h5>
              
            <form method="POST" action="{{ route('update-healthdata', ['patient_id' => $patient->patient_id, 'healthdata_id' => $singleHealthData->healthdata_id]) }}" method="POST">
            @csrf
            
            <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}" >
                        <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
                <legend class="form-fieldset-title">Date and Time</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="healthdata-add-datetime" class="form-label">Recorded at</label>
                        <input type="date" class="form-control" id="healthdata-add-datetime" name='healthdata-add-datetime' value="{{ $singleHealthData->date }}" required>
                    </div>
                </div>
                <legend class="form-fieldset-title">General</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                      <label for="healthdata-add-weight" class="form-label">Weight</label>
                      <div class="input-group mb-3">
                        <input type="number" class="form-control" id="healthdata-add-weight" name='healthdata-add-weight' aria-describedby="healthdata-weight-addon" step="0.01" value="{{ $singleHealthData->weight }}" required>
                        <span class="input-group-text" id="healthdata-weight-addon">kg</span>
                      </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-height" class="form-label">Height</label>
                    <div class="input-group mb-3">
                    <input type="number" class="form-control" id="healthdata-add-height" name="healthdata-add-height" aria-describedby="healthdata-height-addon" step="0.01" value="{{ $singleHealthData->height }}" required>

                      <span class="input-group-text" id="healthdata-height-addon">cm</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-sbp" class="form-label">SBP</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-sbp" name="healthdata-add-sbp" aria-describedby="healthdata-sbp-addon" value="{{ $singleHealthData->sbp }}" required>
                      <span class="input-group-text" id="healthdata-sbp-addon">mmHg</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-dbp" class="form-label">DBP</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-dbp" name="healthdata-add-dbp" aria-describedby="healthdata-dbp-addon" value="{{ $singleHealthData->dbp }}"required>
                      <span class="input-group-text" id="healthdata-dbp-addon">mmHg</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-pulse" class="form-label">Pulse Rate</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-pulse" name="healthdata-add-pulse" aria-describedby="healthdata-pulse-addon" value="{{ $singleHealthData->pulse }}"required>
                      <span class="input-group-text" id="healthdata-pulse-addon">bpm</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-celsius" class="form-label">celsius</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-celsius"  name="healthdata-add-celsius" aria-describedby="healthdata-celsius-addon" step="0.1" value="{{ $singleHealthData->celcius }}" required>
                      <span class="input-group-text" id="healthdata-celsius-addon">°C</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-fahrenheit" class="form-label">fahrenheit</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-fahrenheit" name="healthdata-add-fahrenheit" aria-describedby="healthdata-fahrenheit-addon" step="0.1" value="{{ $singleHealthData->fahrenheit }}"required>
                      <span class="input-group-text" id="healthdata-fahrenheit-addon">°F</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Glucose</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-a1cpercentage" class="form-label">a1cPercentage</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-a1cpercentage" name="healthdata-add-a1cpercentage" aria-describedby="healthdata-a1cpercentage-addon" step="0.1" value="{{ $singleHealthData->a1cpercentage }}"required>
                      <span class="input-group-text" id="healthdata-a1cpercentage-addon">%</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-lotview" class="form-label">lotView</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-lotview" name="healthdata-add-lotview" aria-describedby="healthdata-lotview-addon" placeholder="optional" step="0.1"value="{{ $singleHealthData->lotview }}">
                      <span class="input-group-text" id="healthdata-lotview-addon"> </span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-instid" class="form-label">instID</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-instid" name="healthdata-add-instid" aria-describedby="healthdata-instid-addon" placeholder="optional" step="0.1"value="{{ $singleHealthData->instid }}">
                      <span class="input-group-text" id="healthdata-instid-addon"> </span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-testid" class="form-label">testID</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-testid" name="healthdata-add-testid" aria-describedby="healthdata-testid-addon" placeholder="optional" step="0.1"value="{{ $singleHealthData->testID }}">
                      <span class="input-group-text" id="healthdata-testid-addon"> </span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-operator" class="form-label">operator</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-operator" name="healthdata-add-operator"  aria-describedby="healthdata-operator-addon" step="0.001" placeholder="optional" value="{{ $singleHealthData->operator }}">
                      <span class="input-group-text" id="healthdata-operator-addon"> </span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-ga" class="form-label">GA</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-ga" name="healthdata-add-ga" aria-describedby="healthdata-ga-addon" step="0.001" value="{{ $singleHealthData->ga }}">
                      <span class="input-group-text" id="healthdata-ga-addon">%</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Lipids</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-cho" class="form-label">CHO</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-cho" name="healthdata-add-cho"  aria-describedby="healthdata-cho-addon" step="0.001" value="{{ $singleHealthData->cho }}" required>
                      <span class="input-group-text" id="healthdata-cho-addon">mmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-hdl" class="form-label">HDL</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-hdl" name='healthdata-add-hdl' aria-describedby="healthdata-hdl-addon" step="0.001" value="{{ $singleHealthData->hdl }}"required>
                      <span class="input-group-text" id="healthdata-hdl-addon">mmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-ldlc" class="form-label">LDL-C</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-ldlc" value="{{ $singleHealthData->ldlc }}" name="healthdata-add-ldlc" aria-describedby="healthdata-ldlc-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-ldlc-addon">mmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-tg" class="form-label">TG</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-tg" name="healthdata-add-tg" value="{{ $singleHealthData->tg }}"aria-describedby="healthdata-tg-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-tg-addon">mmol/L</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Pancreas</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-cpeptide" class="form-label">C-peptide</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-cpeptide" name="healthdata-add-cpeptide" value="{{ $singleHealthData->cpeptide }}"aria-describedby="healthdata-cpeptide-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-cpeptide-addon">pmol/L</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Kidney</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-ckdstage" class="form-label">CKD Stage</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-ckdstage" name="healthdata-add-ckdstage" value="{{ $singleHealthData->ckdstage }}"aria-describedby="healthdata-ckdstage-addon" required>
                      <span class="input-group-text" id="healthdata-ckdstage-addon"> </span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-cre" class="form-label">CRE</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-cre" name="healthdata-add-cre" aria-describedby="healthdata-cre-addon" value="{{ $singleHealthData->cre }}"step="0.001" required>
                      <span class="input-group-text" id="healthdata-cre-addon">µmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-ua" class="form-label">UA</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-ua" name="healthdata-add-ua" value="{{ $singleHealthData->ua }}" aria-describedby="healthdata-ua-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-ua-addon">mmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-egfr" class="form-label">eGFR</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-egfr" name="healthdata-add-egfr" value="{{ $singleHealthData->egfr }}"aria-describedby="healthdata-egfr-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-egfr-addon">mL/min</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Urine</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-acr" class="form-label">ACR</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-acr" name="healthdata-add-acr" value="{{ $singleHealthData->acr }}" aria-describedby="healthdata-acr-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-acr-addon">mg/mmol</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-ma" class="form-label">MA</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-ma" name='healthdata-add-ma' value="{{ $singleHealthData->ma }}" aria-describedby="healthdata-ma-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-ma-addon">mg/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-pro" class="form-label">PRO</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-pro" name='healthdata-add-pro' value="{{ $singleHealthData->pro }}"aria-describedby="healthdata-pro-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-pro-addon">mg/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-upcr" class="form-label">UPCR</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-upcr" name='healthdata-add-upcr' value="{{ $singleHealthData->upcr }}"aria-describedby="healthdata-upcr-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-upcr-addon">mg/mmol</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Electrolysis</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-ca" class="form-label">CA</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-ca" name="healthdata-add-ca" value="{{ $singleHealthData->ca }}"aria-describedby="healthdata-ca-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-ca-addon">mg/dL</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-k" class="form-label">K</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-k" name="healthdata-add-k" value="{{ $singleHealthData->k }}"aria-describedby="healthdata-k-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-k-addon">mmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-na" class="form-label">NA</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-na" name="healthdata-add-na" value="{{ $singleHealthData->na }}"aria-describedby="healthdata-na-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-na-addon">mmol/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-p" class="form-label">P</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-p" name="healthdata-add-p" value="{{ $singleHealthData->p }}"aria-describedby="healthdata-p-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-p-addon">mg/dL</span>
                    </div>
                  </div>
                </div>
                <legend class="form-fieldset-title">Liver</legend>
                <div class="row">
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-gptalt" class="form-label">GPT/ALT</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-gptalt" name="healthdata-add-gptalt" value="{{ $singleHealthData->{'gpt/alt'} }}"aria-describedby="healthdata-gptalt-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-gptalt-addon">U/L</span>
                    </div>
                  </div>
                  <div class="col-md-3 mb-3">
                    <label for="healthdata-add-got" class="form-label">GOT</label>
                    <div class="input-group mb-3">
                      <input type="number" class="form-control" id="healthdata-add-got" value="{{ $singleHealthData->got }}"name="healthdata-add-got" aria-describedby="healthdata-got-addon" step="0.001" required>
                      <span class="input-group-text" id="healthdata-got-addon">U/L</span>
                    </div>
                  </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="./patients-healthdata.html" class="btn btn-secondary mx-2">Cancel</a>
            </form>
                
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
<script>
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