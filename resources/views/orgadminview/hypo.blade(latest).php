
@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Hypo Event</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <title>BioTectiveDRC</title>
        <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
        

    </head>

<body>
<div class="container-fluid">
        
        <h5 class="fw-semibold mb-4">Hypo Events</h5>
        <div class="card">
            <div class="card-body">
                
            <form action="{{ route('logbook.search2org') }}" method="post">
            @csrf
            @if(isset($results) && isset($results2))
                <input type="hidden" name="bg_level" value="{{ json_encode($results->pluck('bg_level')->toArray()) }}">
                <input type="hidden" name="bp_level" value="{{ json_encode($results2->pluck('bp_level')->toArray()) }}">
                <input type="hidden" name="bp_level2" value="{{ json_encode($results2->pluck('bp_level2')->toArray()) }}">
            @endif

            @if(request()->has('period_glucose_hyper'))
                <input type="hidden" name="period_glucose_hyper" value="{{ request('period_glucose_hyper') }}">
            @endif

            @if(request()->has('criteria_1_glucose_hyper'))
                <input type="hidden" name="criteria_1_glucose_hyper" value="{{ request('criteria_1_glucose_hyper') }}">
            @endif

            @if(request()->has('criteria_2_glucose_hyper'))
                <input type='hidden' name="criteria_2_glucose_hyper" value="{{ request('criteria_2_glucose_hyper') }}">
            @endif

            @if(request()->has('criteria_1_pressure_hyper'))
                <input type="hidden" name="criteria_1_pressure_hyper" value="{{ request('criteria_1_pressure_hyper') }}">
            @endif

            @if(request()->has('criteria_2_pressure_hyper'))
                <input type="hidden" name="criteria_2_pressure_hyper" value="{{ request('criteria_2_pressure_hyper') }}">
            @endif

            @if(isset($results))
                <input type="hidden" name="bg_logbook_date" value="{{ json_encode($results->pluck('bg_logbook_date')->toArray()) }}">
            @endif

            @if(isset($results2))
                <input type="hidden" name="bp_logbook_date" value="{{ json_encode($results2->pluck('bp_logbook_date')->toArray()) }}">
            @endif
                <legend class= "form-fieldset-title">
                  <h5 class="fw-semibold mb-0">Search</h5>
                </legend>
                <legend class="form-fieldset-title">Blood Glucose</legend>
                
                <div class="row">
                    <div class="col-md-3 mb-3">

                        <label for="user-create-input-name" class="form-label">Criteria 1 <</label>
                        <div class="input-group mb-3">
                          <input type="number" class="input-field form-control" id="criteria_1_glucose_hyper" name="criteria_1_glucose_hyper" aria-describedby="criteria_1_glucose_hyper_addon" step="0.01" value="{{ old('criteria_1_glucose_hyper', $criteria1) }}">
                          <span class="input-group-text" id="criteria_1_glucose_hyper_addon">mmol/L</span>
                        </div>
                    </div>

    
                    <div class="col-md-3 mb-3">

                    <label for="user-create-input-name" class="form-label">Criteria 2 ≤</label>
                      <div class="input-group mb-3">
                        <input type="number" class="input-field form-control" id="criteria_2_glucose_hyper" name="criteria_2_glucose_hyper" aria-describedby="criteria_2_glucose_hyper_addon" step="0.01" value="{{ old('criteria_2_glucose_hyper', $criteria2) }}">
                        <span class="input-group-text" id="criteria_2_glucose_hyper_addon">mmol/L</span>
                      </div>
                  </div>   
                  

                  
                    <div class="col-md-3 mb-3">
                        <label for="user-create-input-phone" class="form-label">Duration</label>
                        <select class="borsize_hyper form-select" name="duration_glucose_hyper" id="duration_glucose_hyper">
                          <optgroup>
                          <option value="today">Today</option>
                              <option value="yesterday">Yesterday</option>
                              <option value="since 3 days">Since 3 days</option>
                              <option value="since a week">Since 1 week</option>
                              <option value="since 2 weeks">Since 2 weeks</option>
                          </optgroup>
                      </select>
                    </div>    
                  

                  
                    <div class="col-md-3 mb-3">
                        <label for="user-create-input-phone" class="form-label">Period</label>
                        <select class="borsize_hyper form-select" name="period_glucose_hyper" id="period_glucose_hyper">
                          <optgroup>
                              <option value="all time">All Time</option>
                              <option value="Wakeup">Wakeup</option>
                              <option value="Before Breakfast">Before Breakfast</option>
                              <option value="After Breakfast">After Breakfast</option>
                              <option value="Before Lunch">Before Lunch</option>
                              <option value="After Lunch">After Lunch</option>
                              <option value="Before Dinner">Before Dinner</option>
                              <option value="After Dinner">After Dinner</option>
                              <option value="Bedtime">Bedtime</option>
                              <option value="Midnight">Midnight</option>
                          </optgroup>
                      </select>
                    </div>    


              <hr>

              <legend class="form-fieldset-title">Blood Pressure</legend>
              <div class="row">
                <div class="col-md-3 mb-1">
                  <label for="user-create-input-name" class="form-label">Criteria 1 <</label>
                      <div class="input-group mb-3">
                        <input type="number" class="input-field form-control" id="criteria_1_pressure_hyper" name="criteria_1_pressure_hyper" aria-describedby="criteria_1_pressure_hyper_addon" step="10" value="{{ old('criteria_1_pressure_hyper', $criteria3) }}">
                        <span class="input-group-text" id="criteria_1_pressure_hyper_addon">mmHg</span>
                      </div>
                </div>
                <div class="col-md-3 mb-1">
                  <label for="user-create-input-name" class="form-label">Criteria 2 ≤</label>
                      <div class="input-group mb-3">
                        <input type="number" class="input-field form-control" id="criteria_2_pressure_hyper" name="criteria_2_pressure_hyper" aria-describedby="criteria_2_pressure_hyper_addon" step="10" value="{{ old('criteria_2_pressure_hyper', $criteria4) }}">
                        <span class="input-group-text" id="criteria_2_pressure_hyper_addon">mmHg</span>
                      </div>
                </div>
                <div class="col-md-3 mb-1">
                  <label for="user-create-input-phone" class="form-label">Duration</label>
                  <select class="borsize_hyper form-select" name="duration_glucose_hyper2" id="duration_glucose_hyper2">
                    <optgroup>
                      <option value="today">Today</option>
                      <option value="yesterday">Yesterday</option>
                      <option value="since 3 days">Since 3 days</option>
                      <option value="since a week">Since 1 week</option>
                      <option value="since 2 weeks">Since 2 weeks</option>
                    </optgroup>
                  </select>
                </div>
         
              </div>
              
               
              </div>
              
              <div class="row justify-content-end">
                <!-- Search and Report Button -->
                <div class="col-md-4 mb-2 text-end">
                  <!-- search -->
                  <button type="Search" class="btn btn-primary me-4">Search</button>
                  <a href="{{ route('hyporeport') }}"
>
    <button type="button" class="btn btn-primary me-4">Export</button>
</a>

                </div>
              </div>
      
  </div>
      </div>
      </form>   
     
</div>
<div class="container-fluid">
  <div class="card">
      <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Blood Glucose Events</h5>
         
<!--Blood Glucose Event-->

<div class="table-responsive table">
  <table class="table text-nowrap mb-0 align-middle">
                      <tr>
                        <th class="txtline">Patient Name</th>
                        <th class="txtline">Criteria 1</th>
                        <th class="txtline">Criteria 2</th>
                        <th class="txtline">Below Target Range</th>
                        <th class="txtline">Action</th>
                      </tr>
                      @php
$noDataAvailable = true;
$patientData = []; // Initialize an array to store patient data
@endphp

@foreach ($results as $result)
    @php
    $patient = $patients->firstWhere('patient_id', $result->patient_id_FK);
    @endphp

    @if ($patient && $criteria1 !== '0' && $criteria2 !== '0' && $criteria1 < $criteria2)
        @php
        // Check if the patient is already in the $patientData array
        $patientDataKey = array_search($patient->patient_id, array_column($patientData, 'patient_id'));

        if ($patientDataKey === false) {
            // If not in the array, add a new entry for the patient
            $patientData[] = [
                'patient_id' => $patient->patient_id,
                'patient_name' => $patient->patient_name,
                'biggercriteria1' => '',
                'betweencriteria2' => '',
                'abovetargetrange' => '',
            ];
            $patientDataKey = count($patientData) - 1; // Get the key of the newly added patient
        }

        // Update the respective fields based on conditions
        if ($result->bg_level < $criteria1 && $result->bg_level > $patient->targetBG_low_BC ) {
            $patientData[$patientDataKey]['abovetargetrange'] .= ($patientData[$patientDataKey]['abovetargetrange'] ? ', ' : '') . $result->bg_level;
        } elseif ($result->bg_level < $criteria2 && $criteria1 < $result->bg_level) {
            $patientData[$patientDataKey]['betweencriteria2'] .= ($patientData[$patientDataKey]['betweencriteria2'] ? ', ' : '') . $result->bg_level;
        } elseif($result->bg_level > $criteria2 )  {
            $patientData[$patientDataKey]['biggercriteria1'] .= ($patientData[$patientDataKey]['biggercriteria1'] ? ', ' : '') . $result->bg_level;
        }

        $noDataAvailable = false;
        @endphp
    @endif
@endforeach

@foreach ($patientData as $patient)
    <tr>
        <td>{{ $patient['patient_name'] }}</td>
        <td style="white-space: normal;">{{ !empty($patient['betweencriteria2']) ? $patient['betweencriteria2'] : '-' }}</td>
        <td style="white-space: normal;">{{ !empty($patient['biggercriteria1']) ? $patient['biggercriteria1'] : '-' }}</td>
        <td style="white-space: normal;">{{ !empty($patient['abovetargetrange']) ? $patient['abovetargetrange'] : '-' }}</td>
        <td>
                          <form action="{{ route('dashboard_bgorg') }}" method="post">
                          @csrf
            
                          <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));">
                            <i class="ti ti-eye"></i>
                          </button>
                        </form>
                      </td>
    </tr>
@endforeach
            @if ($noDataAvailable)
                <tr>
                <td></td>
                              <td></td>
                              <td>No data available in table</td>
                            
                              <td></td>
                              <td></td>
                </tr>
            @endif
                     
                      <!--<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>-->
                  </table>
                    
              </div>
      
  </div>
</div>

<!--Blood Pressure Event-->
<div class="row">
  <div class="container-fluid">
    <div class="card">
      <div class="card-body">
    
        <h5 class="card-title fw-semibold mb-4">Blood Pressure Event (sbp)</h5>

        <div class="table-responsive table">
          <table class="table text-nowrap mb-0 align-middle">
                      <tr>
                        <th class="txtline">Patient Name</th>
                        <th class="txtline">Criteria 1</th>
                        <th class="txtline">Criteria 2</th>
                        <th class="txtline">Above Target Range</th>
                        <th class="txtline">Action</th>
                        @php
$noDataAvailable = true;
$patientData = [];

foreach ($results2 as $result) {
    $patient = $patients->firstWhere('patient_id', $result->patient_id_FK);

    if ($patient && $criteria3 !== '0' && $criteria4 !== '0' && $criteria3 < $criteria4) {
        if (!isset($patientData[$patient->patient_id])) {
            $patientData[$patient->patient_id] = [
                'patient_name' => $patient->patient_name,
                'biggercriteria3' => [],
                'betweencriteria4' => [],
                'abovetargetranges' => [],
            ];
          
        }

        if ($result->bp_level < $criteria3 && $result->bp_level > $patient->targetBG_low_BC ) {
            $patientData[$patient->patient_id]['abovetargetranges'][] = $result->bp_level;
        } elseif ($result->bp_level < $criteria4 && $criteria3 < $result->bp_level) {
            $patientData[$patient->patient_id]['betweencriteria4'][] = $result->bp_level;
        } elseif($result->bp_level > $criteria4 )  {
            $patientData[$patient->patient_id]['biggercriteria3'][] =  $result->bp_level;
        }
        $noDataAvailable = false;
    }
}
@endphp


    @foreach ($patientData as $patient)
    <tr>
        <td>{{ $patient['patient_name'] }}</td>
        <td style="white-space: nowrap;">{{ !empty($patient['betweencriteria4']) ? implode(', ', $patient['betweencriteria4']) : '-' }}</td>
        <td style="white-space: nowrap;">{{ !empty($patient['biggercriteria3']) ? implode(', ', $patient['biggercriteria3']) : '-' }}</td>
        <td style="white-space: nowrap;">{{ !empty($patient['abovetargetranges']) ? implode(', ', $patient['abovetargetranges']) : '-' }}</td>
    
        <td>
                          <form action="{{ route('dashboard_bgorg') }}" method="post">
                          @csrf
            
                          <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));">
                            <i class="ti ti-eye"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
  
            @endforeach
            @if ($noDataAvailable)
                <tr>
                <td></td>
                              <td></td>
                              <td>No data available in table</td>
                              <td></td>
                              <td></td>
                </tr>
            @endif
                      <!--<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                      </tr>-->
                  </table>
                    
              </div>
      
  </div>
</div>
</div>
</div>





<!--</div>-->
</div>

<script>
    const checkboxes = document.querySelectorAll('.checkbox');
    var checkbox_select_all = document.getElementById('role-create-select-all');

    function checkSelectAll() {
        checkbox_select_all.addEventListener('change', function() {
            if (this.checked) {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = true;
                });
            } 
            else {
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
            }
        });
    }

    function runScript() {
        checkSelectAll();
        setTimeout(runScript, 100);
    }

    runScript();
        
  </script>
</body>

</html>
@endsection