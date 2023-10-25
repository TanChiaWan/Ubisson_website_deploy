
@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Logbook (Glucose)</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS -->
        <link rel="stylesheet" href="../css/stylekong.css">

        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>
        

    </head>

<body>
    <!--Side Bar-->
    <div class="closed_sidebar">&#9776; Menu</div>
    <!--<div class="container">-->
        <div class="row">
            <!--side bar-->
            <div class="col-sm-3">
               
            </div>

        <!--content-->
        <!--Body-->
                <div class="col-sm-9">
                    <div class="content">
                        <div class="topnav2">
                            <a href="{{ route('dashboard_general', ['patientId' => $patient->patient_id]) }}">DashBoard</a>
                        <a href="{{ route('aboutpatient', ['patientId' => $patient->patient_id]) }}" >About Patient</a>
                        <a href='{{ route('logbook_bg', ['patientId' => $patient->patient_id]) }}' class="active">Logbook</a>
                        <a href={{ route('healthdata', ['patientId' => $patient->patient_id]) }}>Health Data</a>
                        </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="tabnav">
                                        <a href={{ route('logbook_bg', ['patientId' => $patient->patient_id]) }} class="active">BG</a>
                                        <a href={{ route('logbook_bp', ['patientId' => $patient->patient_id]) }}  >BP</a>
                                    </div>

                                    <div class="tab_nav">
                              
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <!--Logbook Pressure Table-->
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="logbook_pressure_table">
                                        <table>
                                            <thead class='tablehead'>
                                                <tr>
                                                    <th class="txtline">Date</th>
                                                    <th class="txtline">Blood Glucose Level</th>
                                                    <th class="txtline">Period</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody class='tablebody'>
                                                @foreach ($logbook as $logbooks)
@if ($logbooks->patient_id_FK === $patient->patient_id)
    <tr>
        <td>{{ $logbooks->bg_logbook_date }}</td>
        <td class="txt_num">{{ $logbooks->bg_level }}</td>
        <td>{{ $logbooks->bg_period }}</td>
   
    </tr>
@endif
@endforeach
                                            </tbody>
                                        </table>
                                          
                                    </div>
                                    
                                </div>
                            </div>
                    </div>
                </div>


                

                
    <!--</div>-->
</div>

    <!--jQuery CDN - Slim version (=without AJAX)-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
    <!--Popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    
    <!--Bootstrap.js-->
    <script src="../bootstrap/bootstrap.min.js"></script>


</body>
</html>
@endsection 