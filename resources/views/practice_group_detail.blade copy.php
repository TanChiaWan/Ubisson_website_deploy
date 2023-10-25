@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Practice Group</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
        <!--CSS-->
        <link href="../css/styles.css" rel="stylesheet">
        
        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>

        <!--font-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css">

    </head>

    <body>
        <div class="closed_sidebar" onclick="OpenSideBar()">&#9776; </div>
        <div class="container"></div>
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
                  
                </div>

                

                <!--content-->
                <div class="col-sm-8">
                    <div class="content">
                        <h1>Practice Group</h1>
                        <p class="subtitle">{{ $practicegroup->name }}</p>

                        <div class="row">
                            <div class="col-sm-12 practice_group_button_wrapper" style="justify-content: center; overflow-x: auto;">
                                <button class="btn_practice_group" style="margin: 10px;" onclick="manageProfessional({{ $practicegroup->practice_group_id }})">Manage Professionals</button>
                                <button class="btn_practice_group" style="margin: 10px;" onclick="managePatients({{ $practicegroup->practice_group_id }})">Manage Patients</button>

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
    function exported(practiceGroupId) {
        
        var url = "{{ route('export', ['practice_group_id' => 'PRACTICE_GROUP_ID']) }}";
        url = url.replace('PRACTICE_GROUP_ID', practiceGroupId);
        window.location.href = url;
    }
</script>
                                <button class="btn_practice_group" style="margin: 10px;" onclick="exported({{ $practicegroup->practice_group_id }})">Exports</button>
                                <button class="btn_practice_group" style="margin: 10px;" onclick="deletes({{ $practicegroup->practice_group_id }})">Delete Group</button>

                            </div>
                        </div>

                        <div class="row">                        
                            <div class="col-sm-12">
                                <div class="table_wrapper" style="overflow-x: auto; ">
                                    <table id="practice_group_table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Phone no.</th>
                                            <th>Times</th>
                                            <th>Ideal Range</th>
                                            <th>Dangerous Range(Low)</th>
                                            <th>Dangerous Range(High)</th>
                                            <th>Last recorded</th>
                                            <th>Date Added</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach($patientingroup as $patientingroup)
    @php
        $matchingPatient = $patient->firstWhere('patient_id', $patientingroup->patient_id);
    @endphp
    @if ($matchingPatient && $patientingroup->group_id == $practicegroup->practice_group_id)
        <tr>
            <td>{{ $matchingPatient->patient_name }}</td>
            <td>+{{ $matchingPatient->patient_phonenum }}</td>
            <td>{{ $matchingPatient->triggertimes }}</td>
            <td>{{ $matchingPatient->idealrangeBG_low }} to {{ $matchingPatient->idealrangeBG_high }} </td>
            <td>{{ $matchingPatient->dangerousrangeBG_low }} to {{ $matchingPatient->idealrangeBG_low }}</td>
            <td>{{ $matchingPatient->idealrangeBG_high }} to {{ $matchingPatient->dangerousrangeBG_high }}</td>
            <td>{{$patientingroup->updated_at}}</td>
            <td>{{$patientingroup->created_at}}</td>
            <td><a href="#"><i class="fa fa-eye"></i></a></td>
        </tr>
        <!--
            $bgLevel = $logbook->bg_level;
            $dangerLowStart = $matchingPatient->dangerousrangeBG_low_start;
            $dangerLowEnd = $matchingPatient->dangerousrangeBG_low_end;
            $dangerHighStart = $matchingPatient->dangerousrangeBG_high_start;
            $dangerHighEnd = $matchingPatient->dangerousrangeBG_high_end;

            if ($bgLevel >= $dangerLowStart && $bgLevel <= $dangerLowEnd) {
                $matchingPatient->dangerLow++;
            }

            if ($bgLevel >= $dangerHighStart && $bgLevel <= $dangerHighEnd) {
                $matchingPatient->dangerHigh++;
            }

            $matchingPatient->triggertimes = $matchingPatient->dangerLow + $matchingPatient->dangerHigh;
        -->
    @endif
@endforeach



                                       
                                        
                                    </table>
                                
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    

        <script>
            function OpenSideBar() {
                document.getElementById("sidebar").style.width = "100%";
            }

            function CloseSideBar() {
                document.getElementById("sidebar").style.width = "0";
            }

         </script>

        <!--jQuery CDN - Slim version (=without AJAX)-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
        <!--Popper.js-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        
        <!--Bootstrap.js-->
        <script src="bootstrap/bootstrap.min.js"></script>

        <!--Vue-paginate.js-->
        <script src="https://unpkg.com/vuejs-paginate@latest"></script>

        <script src="../vuejs_all_organization.js"></script>
    </body>
</html>
@endsection 