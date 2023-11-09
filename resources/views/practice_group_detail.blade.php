@extends('layouts.app')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <title>Practice Group</title>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="../assets/css/datatables2.css" rel="stylesheet">

        </head>
        <body>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="card-title fw-semibold mb-4">Practice Group</h5>
                                <p class="mb-0">{{ $practicegroup->name }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <a class="btn btn-primary m-2 btn-with-icon" onclick="manageProfessional({{ $practicegroup->practice_group_id }})"><i class="ti ti-stethoscope"></i>Manage Professionals</a>
                                <a class="btn btn-primary m-2 btn-with-icon" onclick="managePatients({{ $practicegroup->practice_group_id }})"><i class="ti ti-user"></i>Manage Patients</a>
                                <a id="export-button" class="btn btn-primary m-2 btn-with-icon" onclick="gatherDataAndExport()">
                                    <i class="ti ti-file-export"></i>Export
                                </a>
                                <a class="btn btn-primary m-2 btn-with-icon" data-bs-toggle="modal" data-bs-target="#delete_practice_group_modal"><i class="ti ti-trash"></i>Delete Group</a>
                            </div>
                        </div>
                        <!-- Include Flatpickr CSS and JS files -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

                        <div class="tab_nav mt-3" >
    <label for="date-range">Select Date Range:</label>
    <input type="text" id="date-range" name="date-range" class="tabnav2" style="overflow: hidden; border: 1px solid #3BB4B6; border-radius: 1vw; background-color: white; margin-bottom: 2vh;margin-top: 2vh; margin-left: 1vw; margin-right: 1vw; width: 20vw;">

         </div>
        
                        <!-- Delete dialog box start -->
                        <div class="modal fade" id="delete_practice_group_modal" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Practice Group</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">Are you sure you want to delete this group?</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-danger" onclick="deletes({{ $practicegroup->practice_group_id }})">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="data-form" method="POST" action="">
    @csrf <!-- Add CSRF token for Laravel -->
    <input type="hidden" name="filtered_data" id="filtered-data">
    <!-- Other input fields if needed -->
    <input type="submit" style="display: none;" id="submit-button">
</form>
                        <div class="table-responsive table">
                            <table class="table text-nowrap mb-0 align-middle datatable">
                                <thead class="text-dark fs-4">
                                    <tr style="background-color: #7ecbcc;">
                                        <th class="border-bottom-0 sortable" onclick="sortTable(0)">
                                            <h6 class="fw-semibold mb-0">Name</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(1)">
                                            <h6 class="fw-semibold mb-0">Phone no.</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(2)">
                                            <h6 class="fw-semibold mb-0">Dangerous Event (Total)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(3)">
                                            <h6 class="fw-semibold mb-0">Dangerous Low Event (Before Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(4)">
                                            <h6 class="fw-semibold mb-0">Dangerous High Event (Before Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" >
                                            <h6 class="fw-semibold mb-0">Dangerous Low Event (After Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" >
                                            <h6 class="fw-semibold mb-0">Dangerous High Event (After Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" >
                                            <h6 class="fw-semibold mb-0">Dangerous Low Event (Bedtime)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" >
                                            <h6 class="fw-semibold mb-0">Dangerous High Event (Bedtime)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(5)">
                                            <h6 class="fw-semibold mb-0">Ideal Range (Before Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(5)">
                                            <h6 class="fw-semibold mb-0">Ideal Range (After Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(5)">
                                            <h6 class="fw-semibold mb-0">Ideal Range (Bedtime)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(6)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(Low) (Before Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(6)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(Low) (After Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(6)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(Low)  (Bedtime)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(7)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(High) (Before Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(7)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(High)  (After Consumption)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(7)">
                                            <h6 class="fw-semibold mb-0">Dangerous Range(High)  (Bedtime)</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(8)">
                                            <h6 class="fw-semibold mb-0">Last recorded</h6>
                                        </th>
                                        <th class="border-bottom-0 sortable" onclick="sortTable(9)">
                                            <h6 class="fw-semibold mb-0">Date Added</h6>
                                        </th>
                                        <th class="border-bottom-0">
                                            <h6 class="fw-semibold mb-0">Action</h6>
                                            
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                <script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#date-range", {
        mode: "range",
        dateFormat: "Y-m-d",
        onClose: function(selectedDates, dateStr, instance) {
            // Extract start and end dates from the selected date range
            const [start, end] = dateStr.split(' to');

            // Get your filtered data using Fetch API
            fetch("{{ route('filter-logbook') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}", // Add CSRF token for Laravel
                },
                body: JSON.stringify({
                    start_date: start,
                    end_date: end,
                }),
            })
            .then(response => response.json())
            .then(data => {
                // Store the data in the hidden input field
                document.getElementById('filtered-data').value = JSON.stringify(data);
                // Trigger the form submission
                document.getElementById('submit-button').click();
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    }); });

</script>

@if(request()->isMethod('post'))
    @php
        $filteredData = json_decode(request('filtered_data'));
        $filteredDataCollection = collect($filteredData);
    @endphp
@endif

                                @foreach($patientingroup as $patientingroup)
    @php
        $matchingPatient = $patient->firstWhere('patient_id', $patientingroup->patient_id);
        
       
    @endphp
    
    @if ($matchingPatient && $patientingroup->group_id == $practicegroup->practice_group_id)
    
    @php
    // Initialize variables for the ideal and dangerous BG ranges
    $dangerousRangeLow = null;
    $dangerousRangeHigh = null;
    $totalcountBC = 0;
    $minBG = 0;
    $maxBG = 0;
    $logbookLowCount = 0;
    $logbookLowPercentage = 0;
    $logbookHighCount = 0;
    $logbookHighPercentage = 0;
    // Initialize variables for the ideal and dangerous BG ranges for AC
    $dangerousRangeLowAC = null;
    $dangerousRangeHighAC = null;
    $totalcountAC = 0;
            $minBGAC = 0;
            $maxBGAC = 0;
            $logbookLowACCount = 0;
            $logbookLowPercentageAC = 0;
            $logbookHighACCount = 0;
            $logbookHighPercentageAC = 0;
            
            
    // Initialize variables for the ideal and dangerous BG ranges for BT
    $dangerousRangeLowBT = null;
    $dangerousRangeHighBT = null;
    $totalcountBT = 0;
            $minBGBT = 0;
            $maxBGBT = 0;
            $logbookLowBTCount = 0;
            $logbookLowPercentageBT = 0;
            $logbookHighBTCount = 0;
            $logbookHighPercentageBT = 0;
    // Filter logbook records within the BG range
    if (isset($filteredData)) {
        $totalLogbookEntries = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)->count();
            // Filter logbook records within the specified date range
            $filteredLogbook = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level >= $matchingPatient->targetBG_low_BC
                        && $entry->bg_level <= $matchingPatient->targetBG_high_BC
                        && in_array($entry->bg_period, ['Wakeup', 'Before Breakfast', 'Before Lunch', 'Before Dinner']);
                })
                ->sortBy('bg_level');
                // Filter logbook records within the BG range for AC
    $filteredLogbookAC = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
        ->filter(function ($entry) use ($matchingPatient) {
            return $entry->bg_level >= $matchingPatient->targetBG_low_AC
                && $entry->bg_level <= $matchingPatient->targetBG_high_AC
                && in_array($entry->bg_period, ['After Breakfast', 'After Lunch', 'After Dinner']);
        })
        ->sortBy('bg_level');
        $filteredLogbookBT = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
        ->filter(function ($entry) use ($matchingPatient) {
            return $entry->bg_level >= $matchingPatient->targetBG_low_BT
                && $entry->bg_level <= $matchingPatient->targetBG_high_BT
                && in_array($entry->bg_period, ['Bedtime']);
        })
        ->sortBy('bg_level');
            }
            else{
                $filteredLogbook = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
        ->filter(function ($entry) use ($matchingPatient) {
            return $entry->bg_level >= $matchingPatient->targetBG_low_BC
                && $entry->bg_level <= $matchingPatient->targetBG_high_BC
                && in_array($entry->bg_period, ['Wakeup','Before Breakfast','Before Lunch','Before Dinner']);
        })
        ->sortBy('bg_level');
        $filteredLogbookAC = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
        ->filter(function ($entry) use ($matchingPatient) {
            return $entry->bg_level >= $matchingPatient->targetBG_low_AC
                && $entry->bg_level <= $matchingPatient->targetBG_high_AC
                && in_array($entry->bg_period, ['After Breakfast', 'After Lunch', 'After Dinner']);
        })
        ->sortBy('bg_level');
        $filteredLogbookBT = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
        ->filter(function ($entry) use ($matchingPatient) {
            return $entry->bg_level >= $matchingPatient->targetBG_low_BT
                && $entry->bg_level <= $matchingPatient->targetBG_high_BT
                && in_array($entry->bg_period, ['Bedtime']);
        })
        ->sortBy('bg_level');
            }
    

 

    // Filter logbook records within the BG range for BT
   

    if ($filteredLogbook && ($filteredLogbook->count() > 0)) {
        $totalLogbookEntries = $logbook->where('patient_id_FK', $matchingPatient->patient_id)->count();
        // Calculate the ideal BG range for BC
        $minBG = $filteredLogbook->first()->bg_level;
        $maxBG = $filteredLogbook->last()->bg_level;

        $filteredLogbookcount = $filteredLogbook->count();
      
        $filteredLogbookpercentage = number_format(($filteredLogbookcount / $totalLogbookEntries) * 100, 2);

        // Check if logbook entries are outside the ideal range for BC
        if ($logbook->where('patient_id_FK', $matchingPatient->patient_id)->count() > 0) {
            if (isset($filteredData)) {
            $logbookLow = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level < $matchingPatient->targetBG_low_BC
                        && in_array($entry->bg_period, ['Wakeup','Before Breakfast','Before Lunch','Before Dinner']);
                });

            $logbookHigh = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level > $matchingPatient->targetBG_high_BC
                        && in_array($entry->bg_period, ['Wakeup', 'Before Breakfast', 'Before Lunch', 'Before Dinner']);
                });
            }else{
                $logbookLow = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level < $matchingPatient->targetBG_low_BC
                        && in_array($entry->bg_period, ['Wakeup','Before Breakfast','Before Lunch','Before Dinner']);
                });

            $logbookHigh = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level > $matchingPatient->targetBG_high_BC
                        && in_array($entry->bg_period, ['Wakeup', 'Before Breakfast', 'Before Lunch', 'Before Dinner']);
                });
            }

            if ($logbookLow->count() > 0 ) {
                $logbookLowCount = $logbookLow->count();
                $logbookHighCount = $logbookHigh->count();
         
                $totalcountBC =  $logbookLowCount + $logbookHighCount;
                $logbookLowPercentage = number_format(($logbookLowCount / $totalLogbookEntries) * 100, 2);
                $logbookHighPercentage = number_format(($logbookHighCount / $totalLogbookEntries) * 100, 2);

                // Calculate the dangerous range (low) for BC
                $maxLowerThanMinBG = $logbookLow->filter(function ($entry) use ($minBG) {
                    return $entry->bg_level < $minBG;
                })->max('bg_level');
                $minDangerous = $logbookLow->min('bg_level');
                if ($minDangerous == $dangerousRangeLow) {
                    $dangerousRangeLow = "$minDangerous";
                } else {
                    $dangerousRangeLow = "$minDangerous - $maxLowerThanMinBG";
                }

                $color = '#668DC4';
            }

            // Calculate the dangerous range (high) for BC
            if ($logbookHigh->count() > 0) {
                $minHigherThanMaxBG = $logbookHigh->filter(function ($entry) use ($maxBG) {
                    return $entry->bg_level > $maxBG;
                })->min('bg_level');
                $maxDangerous = $logbookHigh->max('bg_level');
                if ($minHigherThanMaxBG == $maxDangerous) {
                    $dangerousRangeHigh = "$minHigherThanMaxBG";
                } else {
                    $dangerousRangeHigh = "$minHigherThanMaxBG - $maxDangerous";
                }
                // Set the color based on "High"
                $color = '#EC1F28';
            }
        } else {
            $totalcountBC = 0;
            $minBG = 0;
            $maxBG = 0;
            $logbookLowCount = 0;
            $logbookLowPercentage = 0;
            $logbookHighCount = 0;
            $logbookHighPercentage = 0;
        }
    }

    if ($filteredLogbookAC && ($filteredLogbookAC->count() > 0)) {
        $totalLogbookEntries = $logbook->where('patient_id_FK', $matchingPatient->patient_id)->count();
        // Calculate the ideal BG range for AC
        $minBGAC = $filteredLogbookAC->first()->bg_level;
        $maxBGAC = $filteredLogbookAC->last()->bg_level;

        $filteredLogbookcountAC = $filteredLogbookAC->count();
        
        $filteredLogbookpercentageAC = number_format(($filteredLogbookcountAC / $totalLogbookEntries) * 100, 2);
        
        // Check if logbook entries are outside the ideal range for AC
        if ($logbook->where('patient_id_FK', $matchingPatient->patient_id)->count() > 0) {
            if (isset($filteredData)) {
            $logbookLowAC = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level < $matchingPatient->targetBG_low_AC
                        && in_array($entry->bg_period, ['After Breakfast', 'After Lunch', 'After Dinner']);
                });

            $logbookHighAC = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level > $matchingPatient->targetBG_high_AC
                        && in_array($entry->bg_period, ['After Breakfast', 'After Lunch', 'After Dinner']);
                });
            }else{
                $logbookLowAC = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level < $matchingPatient->targetBG_low_AC
                        && in_array($entry->bg_period, ['After Breakfast', 'After Lunch', 'After Dinner']);
                });

            $logbookHighAC = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level > $matchingPatient->targetBG_high_AC
                        && in_array($entry->bg_period, ['After Breakfast', 'After Lunch', 'After Dinner']);
                });
            }
            if ($logbookLowAC->count() > 0) {
                $logbookLowACCount = $logbookLowAC->count();
                $logbookHighACCount = $logbookHighAC->count();
                $totalcountAC =  $logbookLowACCount + $logbookHighACCount;
                $logbookLowPercentageAC = number_format(($logbookLowACCount / $totalLogbookEntries) * 100, 2);
                $logbookHighPercentageAC = number_format(($logbookHighACCount / $totalLogbookEntries) * 100, 2);

                // Calculate the dangerous range (low) for AC
                $maxLowerThanMinBGAC = $logbookLowAC->filter(function ($entry) use ($minBGAC) {
                    return $entry->bg_level < $minBGAC;
                })->max('bg_level');
               
                $minDangerousAC = $logbookLowAC->min('bg_level');
                
                if ($minDangerousAC == $maxLowerThanMinBGAC) {
                    $dangerousRangeLowAC = "$minDangerousAC";
                } else {
                    $dangerousRangeLowAC = "$minDangerousAC - $maxLowerThanMinBGAC";
                }

                $color = '#668DC4';
            }

            // Calculate the dangerous range (high) for AC
            if ($logbookHighAC->count() > 0) {
                $minHigherThanMaxBGAC = $logbookHighAC->filter(function ($entry) use ($maxBGAC) {
                    return $entry->bg_level > $maxBGAC;
                })->min('bg_level');
                $maxDangerousAC = $logbookHighAC->max('bg_level');
                if ($minHigherThanMaxBGAC == $maxDangerousAC) {
                    $dangerousRangeHighAC = "$minHigherThanMaxBGAC";
                } else {
                    $dangerousRangeHighAC = "$minHigherThanMaxBGAC - $maxDangerousAC";
                }
                // Set the color based on "High"
                $color = '#EC1F28';
            }
        } else {
            $totalcountAC = 0;
            $minBGAC = 0;
            $maxBGAC = 0;
            $logbookLowACCount = 0;
            $logbookLowPercentageAC = 0;
            $logbookHighACCount = 0;
            $logbookHighPercentageAC = 0;
        }
    }
    
    if ($logbook->where('patient_id_FK', $matchingPatient->patient_id)->count() > 0) {
        if (isset($filteredData)) {
            $logbookLowBT = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level < $matchingPatient->targetBG_low_BT
                        && in_array($entry->bg_period, ['Bedtime']);
                });

            $logbookHighBT = $filteredDataCollection->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level > $matchingPatient->targetBG_high_BT
                        && in_array($entry->bg_period, ['Bedtime']);
                });
        }else{
            $logbookLowBT = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level < $matchingPatient->targetBG_low_BT
                        && in_array($entry->bg_period, ['Bedtime']);
                });

            $logbookHighBT = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                ->filter(function ($entry) use ($matchingPatient) {
                    return $entry->bg_level > $matchingPatient->targetBG_high_BT
                        && in_array($entry->bg_period, ['Bedtime']);
                });

        }
            
                $logbookLowBTCount = $logbookLowBT->count();
                
                $logbookHighBTCount = $logbookHighBT->count();
             
                $totalcountBT =  $logbookLowBTCount + $logbookHighBTCount;
               
             
               
                if ($logbookLowBT->count() > 0) {
                    $logbookLowPercentageBT = number_format(($logbookLowBTCount / $totalLogbookEntries) * 100, 2);
                // Calculate the dangerous range (low) for BT
                $maxLowerThanMinBGBT = $logbookLowBT->filter(function ($entry) use ($minBGBT) {
                    return $entry->bg_level < $minBGBT;
                })->max('bg_level');
                $minDangerousBT = $logbookLowBT->min('bg_level');
        
                if ($minDangerousBT == $maxLowerThanMinBGBT || $maxLowerThanMinBGBT == $minDangerousBT || $maxLowerThanMinBGBT == null) {
                    $dangerousRangeLowBT = "$minDangerousBT";
                }
                else {
                    $dangerousRangeLowBT = "$minDangerousBT - $maxLowerThanMinBGBT";
                }

                $color = '#668DC4';
            }

            // Calculate the dangerous range (high) for BT
            if ($logbookHighBT->count() > 0) {
                $logbookHighPercentageBT = number_format(($logbookHighBTCount / $totalLogbookEntries) * 100, 2);
                $minHigherThanMaxBGBT = $logbookHighBT->filter(function ($entry) use ($maxBGBT) {
                    return $entry->bg_level > $maxBGBT;
                })->min('bg_level');
                $maxDangerousBT = $logbookHighBT->max('bg_level');
                if ($minHigherThanMaxBGBT == $maxDangerousBT) {
                    $dangerousRangeHighBT = "$minHigherThanMaxBGBT";
                } else {
                    $dangerousRangeHighBT = "$minHigherThanMaxBGBT - $maxDangerousBT";
                }
                // Set the color based on "High"
                $color = '#EC1F28';
            }
        } 
    if ($filteredLogbookBT && ($filteredLogbookBT->count() > 0)) {
        
        // Calculate the ideal BG range for BT
        $minBGBT = $filteredLogbookBT->first()->bg_level;
        $maxBGBT = $filteredLogbookBT->last()->bg_level;


        $filteredLogbookcountBT = $filteredLogbookBT->count();
        
        $filteredLogbookpercentageBT = number_format(($filteredLogbookcountBT / $totalLogbookEntries) * 100, 2);
        // Check if logbook entries are outside the ideal range for BT
        
    }
    @endphp




<!-- <script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#date-range", {
        mode: "range",
        dateFormat: "Y-m-d", // Format to match the 'Y-m-d' format in your database
        onClose: function(selectedDates, dateStr, instance) {
            var startDate = dateStr.split(" to ")[0]; // Extract start date in Y-m-d format
            var endDate = dateStr.split(" to ")[1];   // Extract end date in Y-m-d format
            var csrfToken = "{{ csrf_token() }}";
            var patientId = "{{ $matchingPatient->patient_id }}";
            console.log("Selected Start Date:", startDate);
            console.log("Selected End Date:", endDate);
            console.log("CSRF Token:", csrfToken);
            console.log("Patient ID:", patientId);

            // Make an AJAX request to filter logbook entries
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
                type: "POST",
                url: "/filter-logbook",
                data: {
                    startDate: startDate,
                    endDate: endDate,
                    patientId: patientId
                },
                success: function(data) {
                    console.log(data);
                    
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        }
    });



    function formatDate(date) {
        // Format the date as 'Y-m-d H:i:s'
        return date.getFullYear() + '-' + padNumber(date.getMonth() + 1) + '-' + padNumber(date.getDate()) + ' ' + padNumber(date.getHours()) + ':' + padNumber(date.getMinutes()) + ':' + padNumber(date.getSeconds());
    }

    function padNumber(num) {
        return num.toString().padStart(2, '0');
    }
});

</script> -->

        
     

                                            <tr>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $matchingPatient->patient_name }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">+{{ $matchingPatient->patient_phonenum }}</p>
                                                </td>
                                                @if ( $totalcountBC == 0 && $totalcountAC == 0 && $totalcountBT == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">0</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $totalcountAC  + $totalcountBC + $totalcountBT }}</p>
                                                </td>
                                                @endif
                                                @if ( $logbookLowCount == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" >0</p>
                                                </td>
                                                @elseif ($logbookLowCount > 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #668DC4;">{{ $logbookLow->count() }}</p>
                                                </td>
                                                @endif
                                                @if ( $logbookHighCount == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">0</p>
                                                </td>
                                                @elseif ($logbookHighCount > 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #EC1F28;">{{ $logbookHigh->count() }}</p>
                                                </td>
                                                @endif
                                                @if ( $logbookLowACCount == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" >0</p>
                                                </td>
                                                @elseif ($logbookLowACCount > 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #668DC4;">{{ $logbookLowAC->count() }}</p>
                                                </td>
                                                @endif
                                                @if ( $logbookHighACCount == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">0</p>
                                                </td>
                                                @elseif ($logbookHighACCount > 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #EC1F28;">{{ $logbookHighAC->count() }}</p>
                                                </td>
                                                @endif
                                                @if ( $logbookLowBTCount == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" >0</p>
                                                </td>
                                                @elseif ($logbookLowBTCount > 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #668DC4;">{{ $logbookLowBT->count() }}</p>
                                                </td>
                                                @endif
                                                @if ( $logbookHighBTCount == 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">0</p>
                                                </td>
                                                @elseif ($logbookHighBTCount > 0)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #EC1F28;">{{ $logbookHighBT->count() }}</p>
                                                </td>
                                                @endif
                                               

                                                @if ($minBG && $maxBG)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #67C56D;">{{ $minBG }}-{{ $maxBG }}</br> ({{$filteredLogbookpercentage}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($minBGAC && $maxBGAC)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #67C56D;">{{ $minBGAC }}-{{ $maxBGAC }}</br> ({{$filteredLogbookpercentageAC}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($minBGBT && $maxBGBT)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #67C56D;">{{ $minBGBT }}-{{ $maxBGBT }}</br> ({{$filteredLogbookpercentageBT}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($dangerousRangeLow)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #668DC4;">{{ $dangerousRangeLow }} </br>({{$logbookLowPercentage}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($dangerousRangeLowAC)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #668DC4;">{{ $dangerousRangeLowAC }} </br>({{$logbookLowPercentageAC}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($dangerousRangeLowBT)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #668DC4;">{{ $dangerousRangeLowBT }} </br>({{$logbookLowPercentageBT}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($dangerousRangeHigh)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #EC1F28;">{{ $dangerousRangeHigh }} </br>({{$logbookHighPercentage}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($dangerousRangeHighAC)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #EC1F28;">{{ $dangerousRangeHighAC }} </br>({{$logbookHighPercentageAC}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                @if ($dangerousRangeHighBT)
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal" style="color: #EC1F28;">{{ $dangerousRangeHighBT }} </br>({{$logbookHighPercentageBT}}%)</p>
                                                </td>
                                                @else
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">-</p>
                                                </td>
                                                @endif
                                                
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $patientingroup->updated_at }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                    <p class="mb-0 fw-normal">{{ $patientingroup->created_at }}</p>
                                                </td>
                                                <td class="border-bottom-0">
                                                <form action="{{ route('dashboard_general') }}" method="post">
                          @csrf
                          <input type="hidden" name="patient_id" value="{{ $matchingPatient->patient_id }}" class="text-center">
                          <input type="hidden" name="professional_id" value="{{ $user->professional_id }}">
                          <button type="submit" style="background: none; border: none; outline: none; padding: 0; cursor: pointer;color: rgba(var(--bs-link-color-rgb),var(--bs-link-opacity,1));"><i class="ti ti-eye"></i></button>
                          </form>
                                                </td>
                                            </tr>
                                        @endif
                                        <script>
                                            
function gatherDataAndExport() {
    @foreach($patientingroup as $patientingroup)


        @if ($matchingPatient && $patientingroup->group_id == $practicegroup->practice_group_id)
            var matchingPatientName = '{{ $matchingPatient->patient_name }}';
            var matchingPatientPhone = '{{ $matchingPatient->patient_phonenum }}';
            var totalcountBC = {{ $matchingPatient->totalcountBC }};
            var totalcountAC = {{ $matchingPatient->totalcountAC }};
            var totalcountBT = {{ $matchingPatient->totalcountBT }};
            var logbookLowCount = {{ $matchingPatient->logbookLowCount }};
            var logbookHighCount = {{ $matchingPatient->logbookHighCount }};
            var logbookLowACCount = {{ $matchingPatient->logbookLowACCount }};
            var logbookHighACCount = {{ $matchingPatient->logbookHighACCount }};
            var logbookLowBTCount = {{ $matchingPatient->logbookLowBTCount }};
            var logbookHighBTCount = {{ $matchingPatient->logbookHighBTCount }};
            var minBG = '{{ $matchingPatient->minBG }}';
            var maxBG = '{{ $matchingPatient->maxBG }}';
            var minBGAC = '{{ $matchingPatient->minBGAC }}';
            var maxBGAC = '{{ $matchingPatient->maxBGAC }}';
            var minBGBT = '{{ $matchingPatient->minBGBT }}';
            var maxBGBT = '{{ $matchingPatient->maxBGBT }}';
            var dangerousRangeLow = '{{ $matchingPatient->dangerousRangeLow }}';
            var dangerousRangeLowAC = '{{ $matchingPatient->dangerousRangeLowAC }}';
            var dangerousRangeLowBT = '{{ $matchingPatient->dangerousRangeLowBT }}';
            var dangerousRangeHigh = '{{ $matchingPatient->dangerousRangeHigh }}';
            var dangerousRangeHighAC = '{{ $matchingPatient->dangerousRangeHighAC }}';
            var dangerousRangeHighBT = '{{ $matchingPatient->dangerousRangeHighBT }}';

            // Call the exported function with the gathered data
            exported(
                {{ $practicegroup->practice_group_id }},
                matchingPatientName,
                matchingPatientPhone,
                totalcountBC,
                totalcountAC,
                totalcountBT,
                logbookLowCount,
                logbookHighCount,
                logbookLowACCount,
                logbookHighACCount,
                logbookLowBTCount,
                logbookHighBTCount,
                minBG,
                maxBG,
                minBGAC,
                maxBGAC,
                minBGBT,
                maxBGBT,
                dangerousRangeLow,
                dangerousRangeLowAC,
                dangerousRangeLowBT,
                dangerousRangeHigh,
                dangerousRangeHighAC,
                dangerousRangeHighBT
            );
        @endif
    @endforeach
}
</script>
                  @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            

            <!-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        flatpickr("#date-range", {
            mode: "range", // Enable date range selection
            dateFormat: "Y-m-d", // Set your desired date format
            onChange: function (selectedDates, dateStr, instance) {
                // Get the selected date range
                const dateRange = instance.selectedDates;

                // Filter the table rows based on the date range
                filterTableByDateRange(dateRange);
            }
        });

        // Function to filter the table rows by date range
        function filterTableByDateRange(dateRange) {
            const tableRows = document.querySelectorAll('.table tbody tr');

            tableRows.forEach(function (row) {
                const updatedDate = new Date(row.querySelector('td:nth-child(9)').textContent);
                const createdDate = new Date(row.querySelector('td:nth-child(10)').textContent);

                // Check if the row falls within the selected date range
                if (dateRange[0] <= updatedDate && updatedDate <= dateRange[1] &&
                    dateRange[0] <= createdDate && createdDate <= dateRange[1]) {
                    row.style.display = 'table-row'; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        }
    });
</script> -->


            <script>
            function managePatients(practiceGroupId) {
                var url = "{{ route('prac5', ['practice_group_id' => 'PRACTICE_GROUP_ID']) }}";
                url = url.replace('PRACTICE_GROUP_ID', practiceGroupId);
                window.location.href = url;
            }
            function manageProfessional(practiceGroupId) {
                var url = "{{ route('prac4', ['practice_group_id' => 'PRACTICE_GROUP_ID']) }}";
                url = url.replace('PRACTICE_GROUP_ID', practiceGroupId);
                window.location.href = url;
            }
            function deletes(practiceGroupId) {
                var url = "{{ route('practice_group_detaildelete', ['practice_group_id' => 'PRACTICE_GROUP_ID']) }}";
                url = url.replace('PRACTICE_GROUP_ID', practiceGroupId);
                window.location.href = url;
            }
           
    
 
            // Define the constant for DataTables library URL
                const DATATABLES_URL = 'https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js';

                $(document).ready(function() {
                    // Load DataTables library dynamically
                    loadScript(DATATABLES_URL, function() {
                        $('.datatable').DataTable({
                        lengthMenu: [5, 10, 25, 100], // Define the available entries options
                        scrollX:true
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







 
  

            <!-- Script for datatable and export function in datatable -->
 
        </body>
    </html>
@endsection




