@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <title> My About Patient</title>
    <meta charset="utf-8">
    <meta name="description" content="create">
    <meta name="author" content="Kong">
    <meta name="keywords" content="Organization">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!--CSS -->
    <link rel="stylesheet" href="../../css/stylekong.css">
    <link rel="stylesheet" href="../../css/app.css">
    <!--Bootstrap-->
    <link href="../../bootstrap/bootstrap.min.css" rel="stylesheet" />


    <!--Vue.js-->
    <script src="https://unpkg.com/vue@2"></script>


</head>

<body>
    <!--Side Bar-->
  
        <div class="row">
            <!--side bar-->
            <div class="col-sm-3">
            </div>

            <!--content-->
            <!--Body-->
            <div class="col-sm-9">
                <div class="content2">
                    <div class="topnavmy" id="myTopnav">
                    <a href="{{ route('dashboard_generalorg', ['patientId' => $patient->patient_id, 'organizationid' => $organizationid]) }}">DashBoard</a>

                        <a href="{{ route('patient', ['patientId' => $patient->patient_id,'organization_id' => $organizationid]) }}" class="active">About Patient</a>
                        <a href="{{ route('logbook_bgorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}">Logbook</a>
                        <a href="{{ route('healthdataorg', ['patientId' => $patient->patient_id,'organizationid' => $organizationid]) }}">Health Data</a>
                        
                       
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_Patient3">
                                <h2 class="sub_Patient_My">Personal Information</h2>
                                <a href='{{ route('editpage', ['patientId' => $patient->patient_id]) }}'><img src="../../images/edit.png" alt="edit Pencil" id="edit_pencil_Patient2"></a>
                            </div>
                            <div class="container_Patient3">
                               
                                    <div class="ImagePerson">
                                        <div id="profile-picture">
                                            <img src='{{ $patient->patient_image }}' alt='patient image' style="display: none;">
                                        </div>
                                        <div class="grid">
                                            <p id="PatientName" class="g-col-4">{{ $patient->patient_name }}</p>
                                            <p class="g-col-4">{{ $patient->patient_gender }}</p>
                                        </div>

                                        <div class="grid">
                                            <p class="g-col-4">Patient Number</p>
                                            <p id="PatientName" class="g-col-4">{{ $patient->patient_number }}</p>
                                        </div>

                                        <div class="grid">
                                            <p class="g-col-4">Diabetes Type</p>
                                            <p id="PatientName" class="g-col-4">{{ $patient->diabetes_type }}</p>
                                        </div>
                                    </div>
                                
                            </div>

                        </div>
                    </div>

                    <!--Advanced Information-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_Patient4">
                                <h2 class="sub_Patient_My">Advanced Information</h2>
                                
                            </div>
                            <div class="container_Patient4">
                                
                                    <div class="advance">
                                        <div class="grid1">
                                            <p class="g-col-6 g-col-md-4">Organisation</p>
                                            <p class="g-col-6 g-col-md-4">{{ $patient->organization_name }}</p>
                                        </div>

                                        <div class="grid2">
                                            <p class="g-col-6 g-col-md-4">Date of Diagnosis</p>
                                            <p class="g-col-6 g-col-md-4">{{ $patient->date_of_diagnosis }}</p>
                                        </div>

                                        <div class="grid3">
                                            <p class="g-col-6 g-col-md-4">Mobile Phone</p>
                                            <p class="g-col-6 g-col-md-4">{{ $patient->patient_phonenum }}</p>
                                        </div>


                                    </div>

                                    <div class="grid4">
                                        <p class="g-col-6 g-col-md-4">QR Code to Patient Profile</p>
                                        <p class="g-col-6 g-col-md-4"><img src="../../images/qr_code.png" class="imgsize"></p>
                                    </div>

                              
                            </div>

                        </div>
                    </div>

                    <!--Emergency Information-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_Patient5">
                                <h2 class="sub_Patient_My">Emergency Information</h2>
                               
                            </div>
                            <div class="container_Patient5">
                             
                                    <div class="advance">
                                        <div class="grid1">
                                            <p class="g-col-6 g-col-md-4">Emergency Contact Name</p>
                                            <p class="g-col-6 g-col-md-4">{{ $patient->emergencypersonname }}</p>
                                        </div>

                                        <div class="grid2">
                                            <p class="g-col-6 g-col-md-4">Emergency Mobile Phone</p>
                                            <p class="g-col-6 g-col-md-4">{{ $patient->emergencypersonphonenum }}</p>
                                        </div>

                                    </div>

                                
                            </div>

                        </div>
                    </div>
                    <!--
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_target">
                                    <h2 class="sub_target">Glucose Target</h2>
                                    <a href=""><img src="../images/edit.png" alt="edit Pencil" id="edit_pencil_target"></a>           
                            </div>
                                    <div class="container_target">
                                        
                                            <div class="container_target1">
                                                <div class="column">
                                                  <p><strong>Before Comsumption:</strong></p>
                                                </div>
                                                <div class="column">
                                                  <p id="before_comsumption_range" class="colleft">4.0 - 10.0 mmol</p>
                                                </div>

                                                <div class="column">
                                                    <p><strong>After Comsumption:</strong></p>
                                                </div>
                                                <div class="column">
                                                    <p id="after_comsumption_range" class="colleft">4.0 - 10.0 mmol</p>
                                                </div>

                                                <div class="column">
                                                    <p><strong>Bedtime:</strong></p>
                                                </div>
                                                <div class="column">
                                                    <p id="bedtime_range" class="colleft">4.0 - 10.0 mmol</p>
                                                </div>

                                                <div class="column">
                                                    <p><strong>HbA1c:</strong></p>
                                                </div>
                                                <div class="column">
                                                    <p id="hba1c_percentage" class="colleft">5.0 %</p>
                                                </div>
                                            </div> 

                                        
                                    </div>
                            
                        </div>
                    </div>-->

                    <!--Target Range-->
                    <!--
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border_targetrange">
                                    <h2 class="sub_targetrange">Target Range</h2>
                                    <a href=""><img src="../images/edit.png" alt="edit Pencil" id="edit_pencil_range"></a>           
                            </div>
                                    <div class="container_targetrange">
                                        
                                            <div class="container_range">
                                                <div class="column">
                                                  <p><strong>Carbs:</strong></p>
                                                </div>
                                                <div class="column">
                                                  <p id="carbs_range" class="colleft2">0.0 - 0.0 g</p>
                                                </div>

                                                <div class="column">
                                                    <p><strong>Weight:</strong></p>
                                                </div>
                                                <div class="column">
                                                    <p id="weight_range" class="colleft2">0.0 - 0.0 kg</p>
                                                </div>

                                                <div class="column">
                                                    <p><strong>BMI:</strong></p>
                                                </div>
                                                <div class="column">
                                                    <p id="bmi_range" class="colleft2">17.9 - 25.0 kg/m2</p>
                                                </div>

                                                <div class="column">
                                                    <p><strong>Activity:</strong></p>
                                                </div>
                                                <div class="column">
                                                    <p id="activity_range" class="colleft2">100.0 min</p>
                                                </div>
                                            </div> 

                                       
                                    </div>
                            
                        </div>
                    </div>
                    Save and Cancel Button-->
                 
                </div>
            </div>
            


        </div>
    </div>

    <!--jQuery CDN - Slim version (=without AJAX)-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <!--Popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

    <!--Bootstrap.js-->
                            </div>
    <script src="../../bootstrap/bootstrap.min.js"></script>

    <script src="../../js/nav.js"></script>

    <script src="../../js/update_glucose_target.js"></script>

    <script src="../../js/update_target_range.js"></script>

    <script src="../../js/ImageRetrieve.js"></script>
</body>

</html>@endsection 