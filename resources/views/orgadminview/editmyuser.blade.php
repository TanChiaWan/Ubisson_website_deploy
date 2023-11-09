@extends('layouts.orgapp') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update User</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="../../css/stylekong2.css">
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    </head>

    <body>
    <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update User</h5>
            @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> There were some problems with your input.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('updateuserorg') }}" enctype="multipart/form-data">
                    <input type="hidden" name="professional_id" value="{{ $professionalss->professional_id }}">


            @csrf
                <legend class="form-fieldset-title">Personal Information</legend>
                <div class="row">
                <div class="col-sm-12 d-flex justify-content-center photo">
                @if (filter_var($professionalss->professional_image, FILTER_VALIDATE_URL))
                    <div id="profile-picture" onclick="handleImageUpload()" style="background-image: url('{{ $professionalss->professional_image }}');"></div>
                @else
                
                <img id="profile-picture" onclick="handleImageUpload()"  src="{{ asset('storage/' . $professionalss->professional_image) }}" alt="Uploaded Image">
                                    @endif
                                    <input type="hidden" name="current_image" value="{{ asset('storage/' . $professionalss->professional_image) }}">
                                    <input id="profile-input" type="file" name="new_image" accept="image/*" onchange="previewImages(event)">
                    
<script>
                                      
                                      function previewImages(event) {
var image = document.getElementById('profile-picture');
var imageURL = URL.createObjectURL(event.target.files[0]);
console.log('New image URL:', imageURL);
image.src = imageURL;
}
</script>

                        </div>
                        <p class="col-sm-12 d-flex justify-content-center">Click to upload new photo</p>
                        
                    <div class="col-md-6 mb-3">
                        <label for="user-create-input-name" class="form-label">Name</label>
                        <input type="text" name="professional_name" placeholder="Name" id="user-create-input-name" class="form-control" value="{{ $professionalss->professional_name }}">
                      
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="user-create-input-gender" class="form-label">Gender</label>
                        <select name="professional_gender" class="form-select" id="user-create-input-gender" value="{{ $professionalss->professional_gender }}" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="user-create-input-phone" class="form-label">Mobile Phone</label>
                      <input type="text" name="professional_mobile_phone" placeholder="Mobile Phone" class="form-control" id="user-create-input-phone" value="{{ $professionalss->professional_mobile_phone }}" required>

                  </div>
                  <div class="col-md-6 mb-3">
                      <label for="user-create-input-organization" class="form-label">Organization</label>
                      
                  
                      <?php
                    $selectedOrganizationId = isset($roles['organizationid']) ? $roles['organizationid'] : null;
                ?>
                           <select name="organization_name" class="form-select" id="organization_name" required disabled>
    <option value="none">Select an organization</option>
  
    <option value="{{   $user->organizationid_FK }}" {{  $user->organization_name ? 'selected' : '' }}>{{ $user->organization_name }}</option>

    
</select>


                  </div>
                </div>
                <legend class="form-fieldset-title">Account</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="user-create-input-username" class="form-label">Username</label>
                        <input type="text" name="username" placeholder="Enter username" class="form-control" id="user-create-input-username" value="{{ $professionalss->username }}" required>

                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="user-create-input-email" class="form-label">E-mail Address</label>
                      <input type="text" name="professional_email_address" placeholder="Enter email" class="form-control" id="user-create-input-email" value="{{ $professionalss->professional_email_address }}" required>

                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6 mb-3">
                      <label for="user-create-input-password" class="form-label">Password</label>
                      <input type="password" name="password" placeholder="Enter password" class="form-control" id="user-create-input-password" value="{{ $professionalss->password }}"required>
   

                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="user-create-input-confirmpassword" class="form-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" placeholder="Enter confirm password" class="form-control" id="user-create-input-confirmpassword" value="{{ $professionalss->password }}"required>

                  </div>
                </div>
                <legend class="form-fieldset-title">Professional Information</legend>
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="user-create-input-typeofprofession" class="form-label">Type of Profession</label>
                    <select name="professional_type_of_profession" class="form-select" id="user-create-input-typeofprofession" value="{{ $professionalss->professional_type_of_profession }}"required>
                        <option value="">Select</option>
                        <option value="Nurse">Nurse</option>
                        <option value="Therapist">Therapist</option>
                        <option value="Dietitians">Dietitians</option>
                        <option value="Certified Diabetes Educator">Certified Diabetes Educator</option>
                        <option value="Examiner">Examiner</option>
                        <option value="Doctor">Doctor</option>
                        <option value="Administration Staff">Administration Staff</option>
                        <option value="Pharmacist">Pharmacist</option>
                        <option value="Person In Charge">Person In Charge</option>
                    </select>

                  </div>
                  <div class="col-md-6 mb-3">
    <label for="temperature_unit" class="form-label">Temperature Unit</label>
    <select name="temperature_unit" id="temperature_unit" class="form-select" value="{{ $professionalss->temperature_unit }}"required>
        <option value="">Select</option>
        <option value="Celcius (°C)">Celcius(°C)</option>
        <option value="Farenheit (°F)">Farenheit(°F)</option>
    </select>
</div>

                  <div class="col-md-6 mb-3">
                    <label for="user-create-input-accountrole" class="form-label">Account Role</label>
                    <select class="form-select" name="professional_account_role" id="professional_account_role" value="{{ $professionalss->professional_account_role }}"required>
              
            
                    </select>
                  </div>
                </div>
                <legend class="form-fieldset-title">Permissions</legend>
                <table id="permissions">
                                        <!-- Permissions dropdown will be populated dynamically -->
                                    </table>
                <button type="submit" class="btn btn-primary">Submit</button>
            
                
          </div>
        </div>
      </div>
                                   
                                       
                                    
                                    
      <script>
                                         $(document).ready(function() {
                                          

                                            $("#professional_account_role").append("<option value='none'>Select a organization first</option>");
                                            $("#permissions").html("<p>None</p>");
                                            function loadRolesAndPermissions() {
                                                $.get("{{ route('loadRoles') }}", { selectedOrganization: $("#organization_name").val() }, function(data) {
                                                $("#professional_account_role").empty();
                                                $("#permissions").empty();
                                               
                                                                                $(".container3_User").css("height", 34 + "VH");
                                                                                $("#permissions").html("<p>Select a role first.</p>");
                                                
                                                if (data) {
                                                    $("#professional_account_role").append("<option value='none'>Select a role</option>");

                                                    $.each(data, function(key, value) {
                                                    $("#professional_account_role").append("<option value='" + value + "'>" + value + "</option>");
                                                    });

                                                    // Calculate the count of permissions
                                                    var permissionsCount = $('#permissions input[type="checkbox"]').length;

                                                    // Adjust the container height based on permissionsCount
                                                 

                                                    // Set the calculated height to the container using CSS
                                                 

                                                    $("#permissions").html("<p>Select a role first.</p>");
                                                
                                                            }
                                                                });
                                                            }

                                                    $('#organization_name').change(function() {
                                                        loadRolesAndPermissions();

                                                    });

                                                    // Call the function on page load
                                                    loadRolesAndPermissions();          

                                                    function loadRolesAndPermissions2() {
                                                        var rowCount = 0;
                                                                        $.get("{{ route('loadPermissions') }}", {
                                                                            selectedRole: $("#professional_account_role").val(),
                                                                            selectedOrganization: $("#organization_name").val(),
                                                                        }, function(response) {
                                                                            $("#permissions").empty();
                                                                            

                                                                            var permissionsTable = $("<table>").addClass("permissions-table");
                                                                            var currentCategory = null;
                                                                            var currentRow = null;
                                                                            var permissionsCount = 0;

                                                                           
                                                                            if ($("#professional_account_role").val() !== "none") {
                                                                               
                                                                                // Create a row for the "Select All" checkbox
                                                                                var selectAllRow = $("<tr>").appendTo(permissionsTable);

                                                                                // Create a cell for the "Select All" checkbox
                                                                                var selectAllCell = $("<td>").attr("colspan", "2").addClass("select-all-cell");
                                                                                var selectAllCheckbox = $("<input>").attr({
                                                                                    type: "checkbox",
                                                                                    id: "select-all-permissions",
                                                                                    class: "checkbox form-check-input"
                                                                                });
                                                                                var selectAllLabel = $("<label>").attr("for", "select-all-permissions").text("Select All");
                                                                                selectAllCell.append(selectAllCheckbox, selectAllLabel);
                                                                                selectAllRow.append(selectAllCell);

                                                                                // Add event listener to the "Select All" checkbox
                                                                                selectAllCheckbox.on("change", function() {
                                                                                    var checkboxes = permissionsTable.find("input[type='checkbox']");
                                                                                    checkboxes.prop("checked", $(this).is(":checked"));
                                                                                });
                                                                            }

                                                                            $.each(response.permissions, function(index, permission) {
                                                                                var id = permission.id;
                                                                                var name = permission.name;
                                                                                var permission_category = permission.permission_category;

                                                                                if (permission_category !== currentCategory) {
                                                                                    currentCategory = permission_category;
                                                                                    // Create a new table row for the category heading
                                                                                    var categoryRow = $("<tr>").addClass('text-center text-decoration-underline').appendTo(permissionsTable);

                                                                                    $("<th>").attr("colspan", "2").text(permission_category).appendTo(categoryRow);
                                                                                    currentRow = null;
                                                                                    permissionsCount = 0;
                                                                                }

                                                                                if (currentRow === null || permissionsCount >= 3) {
                                                                                    // Create a new table row for the permissions
                                                                                    currentRow = $("<tr>").appendTo(permissionsTable);
                                                                                    permissionsCount = 0;
                                                                                }

                                                                                // Create table cells for permission data
                                                                                var checkboxCell = $("<td>").html(`
                                                                                    <label class="checkbox">
                                                                                        <input class="checkbox form-check-input" type="checkbox" name="permissions[]" value="${id}">
                                                                                    </label>
                                                                                `);
                                                                                var nameCell = $("<td>").text(name);

                                                                                // Append cells to the current row
                                                                                currentRow.append(checkboxCell, nameCell);
                                                                                permissionsCount++;
                                                                                rowCount++;
                                                                                // Check if the current row has reached the maximum number of permissions (3)
                                                                                if (permissionsCount >= 3) {
                                                                                    currentRow = null;
                                                                                }
                                                                            });

                                                                            // Append the table to the permissions container
                                                                            $("#permissions").append(permissionsTable);
                                                                            if ($("#professional_account_role").val() == "none") {
                                                                                $(".container3_User").css("height", 34 + "VH");
                                                                                $("#permissions").html("<p>Select a role first.</p>");
                                                                            }else{
                                                                            // Calculate the count of permissions
                                                                            var permissionsCount = response.permissions.length;

                                                                            // Calculate the desired height based on the number of rows in the table
                                                                            var rowHeights = [];
                                                                            permissionsTable.find("tr").each(function() {
                                                                            var rowHeightSum = 0;
                                                                            var rowCount = 0;
                                                                            $(this).find("th:first-child, td:first-child").each(function() {
                                                                                rowHeightSum += $(this).outerHeight();
                                                                                rowCount++;
                                                                            });
                                                                            if (rowCount > 0) {
                                                                                var averageRowHeight = rowHeightSum / rowCount;
                                                                                var averageRowHeightVH = averageRowHeight / $(window).height() * 100;
                                                                                rowHeights.push(averageRowHeightVH);
                                                                            }
                                                                            });

                                                                            var totalRowHeights = rowHeights.reduce(function(sum, height) {
                                                                            return sum + height;
                                                                            }, 0);
                                                                            var averageRowHeightVH = totalRowHeights / rowHeights.length;
                                                                          
                                                                            var permissionsRowCount = permissionsTable.find("tr").length;
                                                                            
                                                                            var containerHeight = permissionsRowCount * averageRowHeightVH;
                                                                            

                                                                            var currentHeight = $(".container3_User").height();
                                                                            var windowHeight = $(window).height();
                                                                            var currentHeightVH = (currentHeight / windowHeight) * 100;

                                                                            var newHeightVH = containerHeight + currentHeightVH;
                                                                           
                                                                            $(".container3_User").css("height", newHeightVH + "vh");
                                                                            // Get the current height of .container3_User
            

                                                                            }
                                                                          
                                                                               

                                                                        }).fail(function() {
                                                                            // Handle error if the AJAX request fails
                                                                            console.log("Failed to load permissions.");
                                                                        });
                                                                    }

                                                                    // Calculate the initial margin-top of the submit button row on page load

                                                


                                                    $("#professional_account_role").change(function() {
                                                        
                                                        loadRolesAndPermissions2();
                                                    });



                                            });
                                </script>
                                    
             
                                    
    
             <script src="../js/imageUpload.js"></script>
             <script src="../js/nav.js"></script>
                               
                 
    {!! Form::close() !!}
           
            
    </body>
</html>
@endsection 