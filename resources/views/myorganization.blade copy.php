@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My Organization</title>
        <meta charset="utf-8">
        <meta name="description" content="my">
        <meta name="author" content="Kong">
        <meta name="keywords" content="My Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--CSS -->
        <link rel="stylesheet" href="../css/stylekong.css">

        <!--Bootstrap-->
        <link href="../bootstrap/bootstrap.min.css" rel="stylesheet" />
        
        
        <!--Vue.js-->
        <script src="https://unpkg.com/vue@2"></script>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <!--side bar-->
                <div class="col-sm-3">
                  
                </div>

                <!--content-->
                <div class="col-sm-9">
                    <div class="content">
                        <div class="container"></div>
                            <h1>My Organization</h1>
                          
                            <!-- Organization Info -->
                            <div class="border_My10">
                              <h2 class="sub_edit">Organization Info</h2>
                              <a href="{{ route('editorg', ['organizationid' => $organization->organizationid]) }}"><img src="../images/edit.png" alt="edit Pencil" id="edit_pencilMyOrg"></a>
                            </div>
                            <div class="container_My1">
                              <!-- Name -->
                              <div class="form-group_My1">
                                <h3 class="h3_word">Name</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_name"></span>
                                  <p>{{ $professional->organization_name }}</p>
                                </div>
                              </div>
                          
                              <!-- Customized Login URL -->
                              <div class="form-group_My1">
                                <h3 class="h3_word">Customized Login URL</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_login"></span>
                                  <p>{{ $organization->customized_login_url }}</p>
                                </div>
                              </div>
                          
                              <!-- Organization QR -->
                              <div class="form-group_My1">
                                <h3 class="h3_word">Organization QR</h3>
                                <div class="col-xm-10">
                                  <div onload="process()">
                                    <img src="../images/qr_code.png" id="QRCode" alt="QR_code">
                                  </div>
                                </div>
                              </div>
                            </div>
                            <br>
                          
                            <!-- Contact Info -->
                            <div class="border_My2">
                              <h2 class="sub_edit">Contact Info</h2>
                              
                            </div>
                            <div class="container_My2">
                              <!-- Address -->
                              <div class="form-group_My2">
                                <h3 class="h3_word">Address</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_address"></span>
                                  <p>{{ $organization->address }}</p>
                                </div>
                              </div>
                          
                              <!-- Mobile Phone -->
                              <div class="form-group_My">
                                <h3 class="h3_word">Mobile Phone</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_phone"></span>
                                  <p>{{ $organization->organization_mobile_phone }}</p>
                                </div>
                              </div>
                            </div>
                            <br>
                          
                            <!-- Preferences -->
                            <div class="border_My3">
                              <h2 class="sub_edit">Preferences</h2>
                             
                            </div>
                            <div class="container_My3">
                              <!-- Language -->
                              <div class="form-group_My">
                                <h3 class="h3_word">Language</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_language"></span>
                                  <p>{{ $organization->prefer_language }}</p>
                                </div>
                              </div>
                          
                              <!-- Region -->
                              <div class="form-group_My">
                                <h3 class="h3_word">Region</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_region"></span>
                                  <p>{{ $organization->region }}</p>
                                </div>
                              </div>
                          
                              <!-- Blood Glucose Unit -->
                             
                          
                          
                          
                     
                              <div class="form-group_My">
                                <h3 class="h3_word">Blood Glucose Unit</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_blood_glucose_unit"></span>
                                  <p>{{ $organization->blood_glucose_unit }}</p>
                                </div>
                              </div>
                          
                              <!-- Other Units -->
                              <div class="form-group_My">
                                <h3 class="h3_word">Other Units</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_other_units"></span>
                                  <p>{{ $organization->other_unit }}</p>
                                </div>
                              </div>
                            </div>
                            <br>
                          
                            <!-- Administrator -->
                            <div class="border_My4">
                              <h2 class="sub_edit">Administrator</h2>
                              
                            </div>
                            <div class="container_My4">
                              <!-- Name -->
                              <div class="form-group_My2">
                                <h3 class="h3_word">Name</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_admin_name"></span>
                                  <p>{{ $organization->administrator_name }}</p>
                                </div>
                              </div>
                          
                              <!-- E-mail Address -->
                              <div class="form-group_My4">
                                <h3 class="h3_word">E-mail Address</h3>
                                <div class="col-xm-10">
                                  <span id="confirm_email"></span>
                                    <p>{{ $organization->administrator_email_address }}</p>
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

        <!--JS File-->
        <script src="js/qrcodegeneration.js"></script>
        <script src="js/confirm.js"></script>
    </body>
</html>
@endsection 