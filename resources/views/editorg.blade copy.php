@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create Organization</title>
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
    <div class="container">
        <div class="row">
            <!--side bar-->
            <div class="col-sm-3">
    
            </div>
    
            <!--content-->
            <!--Body-->
            <div class="col-sm-9">
                <div class="content">
                    <h1>Edit Organization</h1>
                    <form action="{{ route('update-org', ['organizationid' => $organization->organizationid]) }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="border1_edit">
                                    <h2 class="sub">Organization Info</h2>
                                </div>
                                <div class="container1_edit">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <div class="col-xm-10">
                                            <input id="organization_name" type="text" placeholder="Enter name"
                                                   class="@error('organization_name') is-invalid @enderror"
                                                   name="organization_name" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="required">Customized Login URL</label>
                                        <div class="col-xm-10">
                                            <input id="customized_login_url" type="text" placeholder="Paste URL here"
                                                   class="@error('customized_login_url') is-invalid @enderror"
                                                   name="customized_login_url" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!--Contact Info-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="border2_edit">
                                    <h2 class="sub">Contact Info</h2>
                                </div>
                                <div class="container2_edit">
                                    <div class="form-group">
                                        <label class="required">Address</label>
                                        <div class="col-xm-10">
                                            <input id="address" type="text" placeholder="Enter address"
                                                   class="@error('address') is-invalid @enderror" name="address" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="required">Mobile Phone</label>
                                        <div class="col-xm-10">
                                            <input id="organization_mobile_phone" type="text"
                                                   placeholder="Enter phone number" class="@error('organization_mobile_phone') is-invalid @enderror"
                                                   name="organization_mobile_phone" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!--Administrator-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="border3_edit">
                                    <h2 class="sub">Administrator</h2>
                                </div>
                                <div class="container3_edit">
                                    <div class="form-group">
                                        <label class="required">Name</label>
                                        <div class="col-xm-10">
                                            <input id="administrator_name" type="text" placeholder="Enter name"
                                                   class="@error('administrator_name') is-invalid @enderror"
                                                   name="administrator_name" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="required">E-mail Address</label>
                                        <div class="col-xm-10">
                                            <input id="administrator_email_address" type="text"
                                                   placeholder="Enter e-mail"
                                                   class="@error('administrator_email_address') is-invalid @enderror"
                                                   name="administrator_email_address" required>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label class="required">Username</label>
                                        <div class="col-xm-10">
                                            <input id="administrator_username" type="text" placeholder="Enter username"
                                                   class="@error('administrator_username') is-invalid @enderror"
                                                   name="administrator_username" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!--Preferences-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="border4_edit">
                                    <h2 class="sub">Preferences</h2>
                                </div>
                                <div class="container4_edit">
                                    <div class="form-group">
                                        <label for="Language">Language</label>
                                        <div class="col-xm-10">
                                            <select name="prefer_language" id="prefer_language">
                                                <optgroup>
                                                    <option value="">Select</option>
                                                    <option value="English">English</option>
                                                    <option value="Malay">Malay</option>
                                                    <option value="Simplified Chinese">Simplified Chinese</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="Region">Region</label>
                                        <div class="col-xm-10">
                                            <select name="region" id="region">
                                                <optgroup>
                                                    <option value="">Select</option>
                                                    <option value="Kuching">Kuching</option>
                                                    <option value="Sri Aman">Sri Aman</option>
                                                    <option value="Sibu">Sibu</option>
                                                    <option value="Miri">Miri</option>
                                                    <option value="Limbang">Limbang</option>
                                                    <option value="Sarikei">Sarikei</option>
                                                    <option value="Kapit">Kapit</option>
                                                    <option value="Kota Samarahan">Kota Samarahan</option>
                                                    <option value="Bintulu">Bintulu</option>
                                                    <option value="Mukah">Mukah</option>
                                                    <option value="Betong">Betong</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="Blood Glucose Unit">Blood Glucose Unit</label>
                                        <div class="col-xm-10">
                                            <select name="blood_glucose_unit" id="blood_glucose_unit">
                                                <optgroup>
                                                    <option value="">Select</option>
                                                    <option value="mmol/L">mmol/L</option>
                                                    <option value="mg/dL">mg/dL</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
    
                                    <div class="form-group">
                                        <label for="Other Units">Other Units</label>
                                        <div class="col-xm-10">
                                            <select name="other_unit" id="other_unit">
                                                <optgroup>
                                                    <option value="">Select</option>
                                                    <option value="English">English</option>
                                                    <option value="Metric">Metric</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- Add Button -->
                        <div class="row">
                            <div class="btn3">
                                <button type="submit" class="addbtn">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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