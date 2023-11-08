
@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/js/app.js')
        <link rel="stylesheet" href="../assets/css/styles.mintry.css" />



        
   
        
    </head>

    <body>


     
                <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Practice Groups</h5>
            <p class="mb-3">{{$practicegroupCount}} Practice Groups</p>
            <div class="d-flex justify-content-end"><a href="{{ route('prac3') }}" class="btn btn-primary m-1">New Practice Group</a></div>
            <div class="row mb-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <div class="dangerous_event_indicator_shape low_event_color"></div>Dangerous Low Event
                    <div class="dangerous_event_indicator_shape high_event_color"></div>Dangerous High Event
                </div>
            </div>
            <div class="row">
                            
                            <!-- <practice_group :logbook="{{ $logbook }}" :patient="{{ $patient }}":practice_groups="{{ $practice_groups }}" :patientingroup="{{ $patientingroup }}" :professionalingroup="{{ $professionalingroup }}"></practice_group> -->
                            @foreach($practice_groups as $group)
<div class="col-md-4">
    <a href="{{ route('practice_group_detail', ['practice_group_id' => $group->practice_group_id]) }}"
       style="text-decoration: none; color: inherit;">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 groupname" style="padding-right: 0;">
                        <b><h6>{{ $group->name }}</h6></b>
                        <p>{{ $group->subTitle }}</p>
                    </div>
                    <div class="col-md-6 text-end">
                        @php
                            $professionalingroupCount = 0;
                            $patientingroupCount = 0;
                            $totalLogbookLowCount = 0;
                            $totalLogbookHighCount = 0;
                        @endphp
                        @foreach($patientingroup as $patientinGroup)
                            @if ($patientinGroup->group_id === $group->practice_group_id)
                                @php
                                    $matchingPatient = $patient->firstWhere('patient_id', $patientinGroup->patient_id);
                                    if ($matchingPatient) {
                                        $logbookLow = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                                            ->filter(function ($entry) use ($matchingPatient) {
                                                return $entry->bg_level < $matchingPatient->targetBG_low_BC
                                                    && in_array($entry->bg_period, ['Wakeup', 'Before Breakfast', 'Before Lunch', 'Before Dinner']);
                                            });

                                        $logbookHigh = $logbook->where('patient_id_FK', $matchingPatient->patient_id)
                                            ->filter(function ($entry) use ($matchingPatient) {
                                                return $entry->bg_level > $matchingPatient->targetBG_high_BC
                                                    && in_array($entry->bg_period, ['Wakeup', 'Before Breakfast', 'Before Lunch', 'Before Dinner']);
                                            });

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

                                        $totalLogbookLowCount += $logbookLow->count() + $logbookLowAC->count() + $logbookLowBT->count();
                                        $totalLogbookHighCount += $logbookHigh->count() + $logbookHighAC->count() + $logbookHighBT->count();
                                    }
                                    $patientingroupCount++;
                                @endphp
                            @endif
                        @endforeach
                        @foreach($professionalingroup as $professionalGroup)
                            @if ($professionalGroup->group_id === $group->practice_group_id)
                                @php
                                    $professionalingroupCount++;
                                @endphp
                            @endif
                        @endforeach
                        <i class="ti ti-stethoscope ms-2 me-2"
                           id="organizationResult_{{ $group->practice_group_id }}"
                           style="margin: 0 5px;">{{ $professionalingroupCount }}</i>
                        <i class="ti ti-user ms-2 me-2"
                           id="organization2Result_{{ $group->practice_group_id }}"
                           style="margin: 0 5px;">{{ $patientingroupCount }}</i>
                    </div>
                </div>
                <hr style="background-color: #707070;">
                <p class="text-center"></p>
                <div class="row text-center">
                    <div class="col-md-6 low_event_color">{{ $totalLogbookLowCount }}</div>
                    <div class="col-md-6 high_event_color">{{ $totalLogbookHighCount }}</div>
                </div>
            </div>
        </div>
    </a>
</div>
@endforeach



      


      @push('scripts')
<script>
  
    document.addEventListener('DOMContentLoaded', function () {
        @foreach($practice_groups as $group)
            (function() {
                const group = {!! json_encode($group) !!}; // Convert the PHP object to JavaScript
                const organizationResult = document.getElementById(`organizationResult_${group.practice_group_id}`);
                const organization2Result = document.getElementById(`organization2Result_${group.practice_group_id}`);

                // Call JavaScript functions and update the content of the <i> elements
                const orgCount = displayOrganization(group);
                const org2Count = displayOrganization2(group);
console.log(organizationResult);
                if (organizationResult) {
                    organizationResult.innerHTML = `(${orgCount})`;
                }

                if (organization2Result) {
                    organization2Result.innerHTML = `(${org2Count})`;
                }
            })();
        @endforeach
    });
    
    function displayOrganization(group) {
        let patientingroupCount = 0;
        // Iterate through the patientingroup array and count based on group_id
        @foreach($patientingroup as $patientGroup)
            if ({{$patientGroup->group_id}} === group.practice_group_id) {
                patientingroupCount++;
            }
        @endforeach
        return patientingroupCount;
    }
    function displayOrganization2(group) {
        let professionalingroupCount = 0;
        // Iterate through the professionalingroup array and count based on group_id
        @foreach($professionalingroup as $professionalGroup)
            if ({{$professionalGroup->group_id}} === group.practice_group_id) {
                professionalingroupCount++;
            }
        @endforeach
        return professionalingroupCount;
    }
</script>
@endpush


       
    </body>
</html>
@endsection 
