
@extends('layouts.app') 
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

        <title>BioTectiveDRC</title>
        <link rel="shortcut icon" type="image/png" href="../assets/images/logos/SmallBioTectiveLogo.png" />
        

    </head>

<body>
<div class="container-fluid">
        
        <h5 class="fw-semibold mb-4">Hypo Events</h5>
        <div class="card">
            <div class="card-body">
                
            <form action="{{ route('logbook.search2') }}" method="post">
            @csrf
  
                <legend class= "form-fieldset-title">
                  <h5 class="fw-semibold mb-0">Search</h5>
                </legend>
                <legend class="form-fieldset-title">Blood Glucose</legend>
                
                <div class="row">
                    <div class="col-md-3 mb-3">

                        <label for="user-create-input-name" class="form-label">Criteria 1 &ge;</label>
                        <div class="input-group mb-3">
                          <input type="number" class="input-field form-control" id="criteria_1_glucose_hyper" name="criteria_1_glucose_hyper" aria-describedby="criteria_1_glucose_hyper_addon" step="0.01" value="{{ old('criteria_1_glucose_hyper', $criteria1) }}">
                          <span class="input-group-text" id="criteria_1_glucose_hyper_addon">mmol/L</span>
                        </div>
                    </div>

    
                    <div class="col-md-3 mb-3">

                      <label for="user-create-input-name" class="form-label">Criteria 2 &gt;</label>
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
                  <label for="user-create-input-name" class="form-label">Criteria 1 &ge;</label>
                      <div class="input-group mb-3">
                        <input type="number" class="input-field form-control" id="criteria_1_pressure_hyper" name="criteria_1_pressure_hyper" aria-describedby="criteria_1_pressure_hyper_addon" step="10" value="{{ old('criteria_1_pressure_hyper', $criteria3) }}">
                        <span class="input-group-text" id="criteria_1_pressure_hyper_addon">mmHg</span>
                      </div>
                </div>
                <div class="col-md-3 mb-1">
                  <label for="user-create-input-name" class="form-label">Criteria 2 &gt;</label>
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
                  <a href="{{ route('hyporeport') }}?
    {{ http_build_query([
        'bg_level' => $results->pluck('bg_level')->toArray(),
        'bp_level' => $results2->pluck('bp_level')->toArray(),
        'bp_level2' => $results2->pluck('bp_level2')->toArray(),
        'period' => request('period_glucose_hyper'),
        'bg_period' => $results->pluck('bg_period')->toArray(),
        'criteria1' => request('criteria_1_glucose_hyper'),
        'criteria2' => request('criteria_2_glucose_hyper'),
        'criteria3' => request('criteria_1_pressure_hyper'),
        'criteria4' => request('criteria_2_pressure_hyper'),
        'bg_logbook_date' => $results->pluck('bg_logbook_date')->toArray(),
        'bp_logbook_date' => $results2->pluck('bp_logbook_date')->toArray(),
    ]) }}"
>
    <button type="button" class="btn btn-primary me-4">Report</button>
</a>

                </div>
              </div>
      
  </div>
      </div>
      </form>   

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
                        <th class="txtline">Above Target Range</th>
                        <th class="txtline">Above Target Range 2</th>
                        <th class="txtline">Action</th>
                      </tr>
                      @php
                $noDataAvailable = true;
            @endphp
            @foreach ($results as $result)
            @php
                  $patient = $patients->firstWhere('patient_id', $result->patient_id_FK);
              @endphp
          
                @if ($patient && $criteria1 !== '0' && $criteria2 !== '0')
                    @php
                  
                        $noDataAvailable = false;
                    @endphp
                    <tr>
                        <td>{{ $patient ? $patient->patient_name : '-' }}</td>
                        <td>{{ $criteria1 }}</td>
                        <td>{{ $criteria2 }}</td>
                        <td>{{ $result->bg_level }}</td>
                        <td>-</td>
                        <td> <form action="{{ route('dashboard_bg') }}" method="post">
                          @csrf
                          <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
                          <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                          <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));">
                            <i class="ti ti-eye"></i>
                          </button>
                        </form></td>
                    </tr>
                @endif
            @endforeach
            @if ($noDataAvailable)
                <tr>
                <td></td>
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
                        <th class="txtline">Above Target Range 2</th>
                        <th class="txtline">Action</th>
                      </tr>
                      @php
                $noDataAvailable = true;
            @endphp
            @foreach ($results2 as $result)
                @php
                    $patient = $patients->where('patient_id', $result->patient_id_FK)->first();
                @endphp
                @if ($patient && $criteria3 !== '0' && $criteria4 !== '0')
                    @php
                        $noDataAvailable = false;
                    @endphp
                    <tr>
                        <td>{{ $patient ? $patient->patient_name : '-' }}</td>
                        <td>{{ $criteria3 }}</td>
                        <td>{{ $criteria4 }}</td>
                        <td>{{ $result->bp_level2 }}</td>
                        <td>{{ $result->bp_level}}</td>
                        <td><form action="{{ route('dashboard_bg') }}" method="post">
                          @csrf
                          <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
                          <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                          <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer; color: rgba(var(--bs-link-color-rgb), var(--bs-link-opacity, 1));">
                            <i class="ti ti-eye"></i>
                          </button>
                        </form></td>
                    </tr>
                @endif
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