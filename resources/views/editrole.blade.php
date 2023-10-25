@extends('layouts.app') 
@section('content')
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Update Role</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        
       
    </head>

    <div class="container-fluid">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Role</h5>
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
                    {!! Form::open(array('route' => ['updaterole', $role->id], 'method' => 'POST')) !!}
            @csrf
                <legend class="form-fieldset-title">Role Information</legend>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="role-create-input-name" class="form-label">Role Name</label>
                       
                        {!! Form::text('name', $role->name, ['placeholder' => 'Name', 'required', 'class' => 'form-control', 'id' => 'role-create-input-name']) !!}


                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="role-create-input-organization" class="form-label">Organization</label>
                        <?php
                        $selectedOrganizationId = isset($roles['organizationid']) ? $roles['organizationid'] : null;
                       
                        ?>
                        {{ Form::select('organization_name', ['none' => 'Select an organization'] + collect($organizations)->mapWithKeys(function ($name, $id) {
                            return [$id+1 => $name];
                        })->all(), $role->organizationid, ['id' => 'organization_name', 'class' => 'form-select', 'required']) }}

                        {{ Form::hidden('organizationid', $selectedOrganizationId, ['id' => 'selected_organization_id']) }}
                       
                    </div>
                </div>
                <legend class="form-fieldset-title">Permissions</legend>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="checkbox form-check-input" id="role-create-select-all" name="role-create-select-all">
                    <label for="role-create-select-all" class="form-check-label">  {{ Form::checkbox('select_all_allowed', null, false, ['class' => 'select-all checkbox form-check-input', 'id' => 'checkbox_select_all']) }}
                                                    Select All</label>
                </div>
                <div class="table-responsive table">
                    <table class="table text-nowrap mb-0 align-middle">
                      <thead class="text-dark fs-4">
                        <tr style="background-color: #7ecbcc;">
                          <th class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Name</h6>
                          </th>
                          <th colspan='2'class="border-bottom-0">
                            <h6 class="fw-semibold mb-0">Default Permissions</h6>
                          </th>
                        </tr>
                      </thead>
                    <tbody>
    <tr>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    @php
        $previousCategory = null; // Initialize the $previousCategory variable
    @endphp
    @foreach($permission as $value)
        @if($value->permission_category !== $previousCategory)
            <tr class="text-center text-decoration-underline">
                <td class="border-bottom-0" colspan="3">
                {{ Form::checkbox('permission_category[]', $value->permission_category, false, ['class' => ' checkbox form-check-input permission-category-checkbox']) }}
                    <strong>{{ $value->permission_category }}</strong>
                </td>
            </tr>
        @endif
        <tr>
            <td class="border-bottom-0">
              
                {{ $value->name }}
            </td>
            <td class="border-bottom-0">
            {{ Form::checkbox('permission[]', $value->id, false, ['class' => 'allowed-permission permission-checkbox checkbox form-check-input', 'data-category' => $value->permission_category]) }}
            </td>
            <td></td>
        </tr>
        @php
            $previousCategory = $value->permission_category;
        @endphp
    @endforeach
</tbody>

                    </table>
                </div>

                <!--<div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>-->
                <button type="submit" class="btn btn-primary">Submit</button>
                {!! Form::close() !!}

                
          </div>
        </div>
      </div>


                                    
                                    <script>
                                        document.addEventListener('DOMContentLoaded', () => {
                                            const permissionCategories = document.querySelectorAll('.permission-category-checkbox');
                                            const permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
                                            const nameCheckboxes = document.querySelectorAll('.name-checkbox');
                                            const checkboxSelectAll = document.querySelector('#checkbox_select_all');
                                    
                                            function checkSelectAll() {
                                                if (checkboxSelectAll && checkboxSelectAll.checked) {
                                                    permissionCategories.forEach(checkbox => {
                                                        checkbox.checked = true;
                                                    });
                                                    permissionCheckboxes.forEach(checkbox => {
                                                        checkbox.checked = true;
                                                    });
                                                    nameCheckboxes.forEach(checkbox => {
                                                        checkbox.checked = true;
                                                    });
                                                } else {
                                                    permissionCategories.forEach(checkbox => {
                                                        checkbox.checked = false;
                                                    });
                                                    permissionCheckboxes.forEach(checkbox => {
                                                        checkbox.checked = false;
                                                    });
                                                    nameCheckboxes.forEach(checkbox => {
                                                        checkbox.checked = false;
                                                    });
                                                }
                                            }
                                    
                                            // Function to check permissions when their permission category is checked
                                            function checkPermissions(event) {
                                                const permissionCategory = event.currentTarget;
                                                const permissionCategoryValue = permissionCategory.value;
                                                const relatedPermissionCheckboxes = document.querySelectorAll(`.permission-checkbox[data-category="${permissionCategoryValue}"]`);
                                    
                                                relatedPermissionCheckboxes.forEach(checkbox => {
                                                    checkbox.checked = permissionCategory.checked;
                                                });
                                            }
                                    
                                            // Function to check allowed and default permissions when the name checkbox is checked
                                            function checkNamePermissions(event) {
                                                const nameCheckbox = event.currentTarget;
                                                const permissionCategoryValue = nameCheckbox.dataset.category;
                                                const allowedPermissionCheckbox = document.querySelector(`.allowed-permission[data-category="${permissionCategoryValue}"]`);
                                                const defaultPermissionCheckbox = document.querySelector(`.default-permission[data-category="${permissionCategoryValue}"]`);
                                    
                                                allowedPermissionCheckbox.checked = nameCheckbox.checked;
                                                defaultPermissionCheckbox.checked = nameCheckbox.checked;
                                            }
                                    
                                            if (permissionCategories.length > 0) {
                                                permissionCategories.forEach(permissionCategory => {
                                                    permissionCategory.addEventListener('change', checkPermissions);
                                                });
                                            }
                                    
                                            if (checkboxSelectAll) {
                                                checkboxSelectAll.addEventListener('change', () => {
                                                    checkSelectAll();
                                                });
                                            }
                                    
                                            if (nameCheckboxes.length > 0) {
                                                nameCheckboxes.forEach(nameCheckbox => {
                                                    nameCheckbox.addEventListener('change', checkNamePermissions);
                                                });
                                            }
                                    
                                            // Run the initial checks
                                            checkSelectAll();
                                        });
                                    </script>

        
                              
    </body>
</html>
@endsection 