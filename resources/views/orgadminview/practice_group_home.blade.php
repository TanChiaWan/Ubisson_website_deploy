@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite('resources/js/app.js')
        <!--CSS-->
    </head>

    <body>
                        
                       
                <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-2">Practice Groups</h5>
            <p class="mb-3">{{$practicegroupCount}} Practice Groups</p>
            <div class="d-flex justify-content-end"><a href="{{ route('practice',['organization_id' => $organizationid]) }}" class="btn btn-primary m-1">New Practice Group</a></div>
            <div class="row mb-2">
                <div class="col-md-12 d-flex align-items-center justify-content-center">
                    <div class="dangerous_event_indicator_shape low_event_color"></div>Dangerous Low Event
                    <div class="dangerous_event_indicator_shape high_event_color"></div>Dangerous High Event
                </div>
            </div>
            <div class="row">
                            
                            <practicegroup :logbook="{{ $logbook }}" :patient="{{ $patient }}":practice_groups="{{ $practice_groups }}" :patientingroup="{{ $patientingroup }}" :professionalingroup="{{ $professionalingroup }}"></practicegroup>
    </body>
</html>
@endsection 
