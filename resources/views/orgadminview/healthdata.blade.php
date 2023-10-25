@extends('layouts.orgapp') 
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

        <!--CSS -->
        <link rel="stylesheet" href="../../css/stylekong.css">

        <!--Bootstrap-->
        <link href="../../bootstrap/bootstrap.min.css" rel="stylesheet" />


        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        
        
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
                            <a href="{{ route('dashboard_generalorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}" >DashBoard</a>
                              <a href="{{ route('patient', ['patientId' => $patient->patient_id,'organization_id' => $organizationid]) }}" >About Patient</a>
                              <a href="{{ route('logbook_bgorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}"> Logbook</a>
                        <a href="{{ route('healthdataorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}"class="active">Health Data</a>
                            </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="search_bar">
                                            <label class="search_fortxt">Search: </label>
                                            <input type="text" class="search_txt" id="search" name="search">  
                                            
                                            <div class="add_export_btn">
                                                <button class="add-button">
                                                    <span class="plus-symbol">Add</span> +
                                                </button>
                                                <button class="export-button">
                                                    <span class="symbol">Export</span> &#x21E3;
                                                </button>
                                            </div>
                                        </div>


                                        <form action="/action_page.php">
                                            <div class="checkbox-group">
                                                <input type="checkbox" id="general" name="general" checked>
                                                <label for="general">General</label>
                                                <input type="checkbox" id="pancreas" name="pancreas">
                                                <label for="pancreas">Pancreas</label>
                                                <input type="checkbox" id="urine" name="urine">
                                                <label for="urine">Urine</label>
                                                <input type="checkbox" id="liver" name="liver">
                                                <label for="liver">Liver</label>
                                                <input type="checkbox" id="lipids" name="lipids">
                                                <label for="lipids">Lipids</label>
                                                <input type="checkbox" id="glucose" name="glucose">
                                                <label for="glucose">Glucose</label>
                                                <input type="checkbox" id="kidneys" name="kidneys">
                                                <label for="kidneys">Kidneys</label>
                                                <input type="checkbox" id="electrolysis" name="electrolysis">
                                                <label for="electrolysis">Electrolysis</label>
                                            </div>

                                            <div class="border_Health_Data">
                                                <h2 class="sub_Health_Data">General</h2>          
                                            </div>
                                                <div class="container_Health_Data">
                                                    <table style="z-index: 1" >
                                                      
                                                        <tr>
                                                          <th class="txtline">Action</th>
                                                          <th class="txtline">Data Originate</th>
                                                          <th class="txtline">Date</th>
                                                          <th class="txtline">Weight(kg)</th>
                                                          <th class="txtline">Height(cm)</th>
                                                          <th class="txtline">SBP/DBP(mmHg)</th>
                                                          <th class="txtline">hr(bpm)</th>
                                                          <th class="txtline">Celsius('C)</th>
                                                          <th class="txtline">Fahrenheit('F)</th>
                                                        </tr>
                                                    
                                    
                                                        @foreach ($healthdata as $data)
                                                        @if ($data->patient_id_FK === $patient->patient_id)
                                                            <tr>
                                                                <td>
                                                                    <i class="fas fa-trash-alt"></i>
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </td>
                                                                <td>Patient</td>
                                                                <td>{{ $data->date }}</td>
                                                                <td>{{ $data->weight }}</td>
                                                                <td>{{ $data->height }}</td>
                                                                <td>{{ $data->sbp }}/{{ $data->dbp }}</td>
                                                                <td>{{ $data->hr }}</td>
                                                                <td>{{ $data->celcius }}</td>
                                                                <td>{{ $data->fahrenheit }}</td>
                                                            </tr>
                                                            @endif
                                                            @endforeach
                                                           

                                                    </table>
                                                      
                                                </div>

                                        </form>
                                        
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
    <script src="../../bootstrap/bootstrap.min.js"></script>


</body>
</html>
@endsection