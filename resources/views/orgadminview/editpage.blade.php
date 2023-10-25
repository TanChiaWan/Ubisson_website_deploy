@extends('layouts.orgapp') 
@section('content')

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Update About Patient</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!--CSS -->
        <link rel="stylesheet" href="../css/stylekong.css">

        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>
        

    </head>

    <body>
        <!--Side Bar-->
    <div class="container"></div>
        <div class="row">
            <!--side bar-->
            <div class="col-sm-3">
            </div>

            <!--content-->
            <!--Body-->

                            
                              <div class="col-sm-9">
                                <div class="content">
                                  
                                    <form action="{{ route('update-patient', ['patient_id' => $patient->patient_id]) }}" method="POST">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="border_Patient">
                                                    <h2 class="sub_Patient">Personal Information</h2>
                                                </div>
                                                <div class="container_Patient">
                                                    @csrf
                                                    <div class="photo">
                                                        <div id="profile-picture" style="background-image: url('{{ $patient->patient_image }}');" onclick="handleImageUpload()"></div>
                                                                    <input id="profile-input" name="patient_image" type="file" accept="image/*" onchange="previewImage(event)">
                                                    </div>
                                                    <p class="phototxt">Click to upload new photo</p>
                                                    <div class="form-group">
                                                        <label id='label1' class="required" >Full Name (As Per IC/Passport)</label>
                                                        <div class="col-xm-10">
                                                            <input type="text" id="patient_name" placeholder="Enter fullname" name="patient_name" required style="font-size: 20px; padding: 10px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group1">
                                                        <label for="date" >Date of Birth</label>
                                                        <div class="col-xm-10">
                                                            <input type="date" id="date_of_birth" name="date_of_birth" value="2000-07-22" min="2000-01-01" max="2050-12-31" style="font-size: 20px; padding: 10px;">
                                                        </div>
                                                    </div>
                                                    <div class="form-group23">
                                                        <label for="gender" >Gender</label>
                                                        <div class="col-xm-10">
                                                            <select name="patient_gender" id="patient_gender" style="font-size: 20px; padding: 10px;">
                                                                <optgroup>
                                                                    <option value="M">Male</option>
                                                                    <option value="F">Female</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group1">
                                                        <label for="diabetes" >Diabetes Type</label>
                                                        <div class="col-xm-10">
                                                            <select name="diabetes_type" id="diabetes_type" style="font-size: 20px; padding: 10px;">
                                                                <optgroup>
                                                                    <option value="Type1">Type 1</option>
                                                                    <option value="Type2">Type 2</option>
                                                                    <option value="GestationalDiabetes">Gestational Diabetes</option>
                                                                    <option value="Prediabetes">Pre-diabetes</option>
                                                                    <option value="Nondiabetes">Non-diabetes</option>
                                                                </optgroup>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                    
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="border_Patient1">
                                                    <h2 class="sub_Patient">Advanced Information</h2>
                                                </div>
                                                <div class="container_Patient1">
                                                    <div class="form-group">
                                                        <label for="organisation" >Organisation</label>
                                                        <div class="col-xm-10">
                                                            <select  style="font-size: 20px;" name="organization_name" id="organization_name">
                                                                @foreach($organizations as $organization)
                                                                    <option value="{{ $organization->organization_name }}">{{ $organization->organization_name }}</option>
                                                                @endforeach
                                                            </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date" >Date of Diagnosis</label>
                                                    <div class="col-xm-10">
                                                        <input type="date" id="date_of_diagnosis" style="font-size: 20px;" name="date_of_diagnosis" value="2023-07-22" min="1950-01-01" max="2050-12-31">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobilephone" >Mobile Phone</label>
                                                    <div class="col-xm-10">
                                                        <input type="text"  style="font-size: 20px;" id="patient_phonenum" placeholder="Enter phone number" name="patient_phonenum" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="patientnumber" >Patient Number</label>
                                                    <div class="col-xm-10">
                                                        <input type="text" style="font-size: 20px; " id="patient_number" placeholder="Enter patient number" name="patient_number" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="border_Patient2">
                                                <h2 class="sub_Patient">Emergency Information</h2>
                                            </div>
                                            <div class="container_Patient2">
                                                <div class="form-group">
                                                    <label for="emrName" >Emergency Contact Name</label>
                                                    <div class="col-xm-10">
                                                        <input type="text" id="emergencypersonname" placeholder="Enter emergency contact name" name="emergencypersonname" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="emrPhone" >Emergency Mobile Phone</label>
                                                    <div class="col-xm-10">
                                                        <input type="text" id="emergencypersonphonenum" placeholder="Enter emergency mobile phone" name="emergencypersonphonenum" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                    
                                    <div class="row">
                                        <div class="two_btn4">
                                            <button type="button" class="cancelbtn">Cancel</button>
                                            <button type="submit" class="savebtn">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
            
                        </div>
                    </div>

                    
        </div>
    </div>

    <!--jQuery CDN - Slim version (=without AJAX)-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        
    <!--Popper.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    
    <!--Bootstrap.js-->
    <script src="../bootstrap/bootstrap.min.js"></script>

    <script src="../js/nav.js"></script>

    <script src="../js/imageUpload.js"></script>
    </body>
</html>
@endsection