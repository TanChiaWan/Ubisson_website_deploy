@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Create User</title>
        <meta charset="utf-8">
        <meta name="description" content="create">
        <meta name="author" content="Kong">
        <meta name="keywords" content="Organization">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/js/app.js')
        
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <link rel="stylesheet" href="../../css/stylekong2.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!--Bootstrap-->
     
        <link href="../../bootstrap/bootstrap.min.css" rel="stylesheet" />

        
        <!--Vue.js-->
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>

    <body>
        <div class="container"></div>
        <div class="row">
            <!--side bar-->
            <div class="col-sm-3">
        
            </div>
            @csrf
        
            <div class="col-sm-9">
                <div class="content">
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
                    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
                    <h1 >User Information</h1>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border1_User">
                                <h2 class="sub" >Personal Information</h2>
                            </div>
        
                            @csrf
                            <div class="container1_User">
        
                                <div class="form-group">
                                    <label for="name_User" >Name</label>
        
                                    <div class="col-xm-10">
                                        {!! Form::text('professional_name', null, array('placeholder' => 'Name')) !!}
        
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="Gender" >Gender</label>
        
                                    <div class="col-xm-10">
                                        {!! Form::select('professional_gender', ['Male' => 'Male', 'Female' => 'Female'], null) !!}
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="Mobile Phone" >Mobile Phone</label>
        
                                    <div class="col-xm-10">
                                        {!! Form::text('professional_mobile_phone', null, array('placeholder' => 'Mobile Phone')) !!}
        
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label class="required" >Organization</label>
                                    <div class="col-xm-10">
                                        <?php
                                        $selectedOrganizationId = isset($roles['organizationid']) ? $roles['organizationid'] : null;
                                        ?>
                                        {{ Form::select('organization_name', ['none' => 'Select an organization'] + collect($organizations)->mapWithKeys(function ($name, $id) {
                                        return [$id => $name];
                                        })->all(), $selectedOrganizationId, ['id' => 'organization_name']) }}
                                    </div>
                                </div>
        
                            </div>
        
                        </div>
                    </div>
        
                    <!--Account-->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border2_User">
                                <h2 class="sub" >Account</h2>
                            </div>
                            <div class="container2_User">
        
                                <div class="form-group">
                                    <label for="username_User" >Username</label>
        
                                    <div class="col-xm-10">
                                        {{ Form::text('username', null, ['placeholder' => 'Enter username', 'required']) }}
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="email_user" >E-mail Address</label>
        
                                    <div class="col-xm-10">
                                        {{ Form::text('professional_email_address', null, ['placeholder' => 'Enter email', 'required']) }}
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="password" >Password</label>
                                    <div class="col-xm-10">
                                        {{ Form::password('password', null, ['placeholder' => 'Enter password', 'required']) }}
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="confirmpassword" >Confirm Password</label>
                                    <div class="col-xm-10">
                                        {{ Form::password('password_confirmation', null, ['placeholder' => 'Enter confirm password', 'required']) }}
                                    </div>
                                </div>
        
        
                            </div>
        
                        </div>
                    </div>
        
        
                    <!--Professional Information-->
        
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="border3_User">
                                <h2 class="sub" >Professional Information</h2>
                            </div>
                            <div class="container3_User">
        
                                <div class="form-group">
                                    <label for="Profession" >Type of Profession</label>
        
                                    <div class="col-xm-10">
                                        {{ Form::select('professional_type_of_profession', [
                                        '' => 'Select',
                                        'Nurse' => 'Nurse',
                                        'Therapist' => 'Therapist',
                                        'Dietitians' => 'Dietitians',
                                        'Certified Diabetes Educator' => 'Certified Diabetes Educator',
                                        'Examiner' => 'Examiner',
                                        'Doctor' => 'Doctor',
                                        'Administration Staff' => 'Administration Staff',
                                        'Pharmacist' => 'Pharmacist',
                                        'Person In Charge' => 'Person In Charge'
                                        ]) }}
                                    </div>
                                </div>
        
        
        
                                <div class="form-group">
                                    <label for="roles" >Account Roles:</label>
                                    <div class="col-xm-10">
                                    <select name="professional_account_role" id="professional_account_role"></select>
                                        </div>
                                </div>
        
                                <div class="form-group">
                                    <label for="permissions" >Permissions:</label>
                                    <br/>
        
                                    <table id="permissions">
                                        <!-- Permissions dropdown will be populated dynamically -->
                                    </table>
        
                                </div>
        
        
        
                            </div>
                        </div>
                    </div>
        
                    <!--Submit Button-->
                    <div class="row">
                        <!--<div class="col-sm-12">-->
                        <div class="sbtn">
                            <button id="submitButton" type="submit" class="submitbtn">Submit</button>
                        </div>
                        <!--</div>-->
                    </div>
        
                </div>
        
        
            </div>
        </div>
        
                                    
                                    
                                <script>
                                         $(document).ready(function() {
                                            var selectedOrganizationId = "{{ $roles ? head(array_keys($roles)) : '' }}";
                                            if (selectedOrganizationId) {
                                                $('#organization_name').val(selectedOrganizationId);
                                                }

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
                                                                                    id: "select-all-permissions"
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
                                                                                    var categoryRow = $("<tr>").appendTo(permissionsTable);
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
                                                                                        <input class="checkbox2" type="checkbox" name="permissions[]" value="${id}">
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
                                    
    
    
    
                               
    
    
    {!! Form::close() !!}
            <script src="../bootstrap/bootstrap.min.js"></script>
            
    </body>
</html>
@endsection 