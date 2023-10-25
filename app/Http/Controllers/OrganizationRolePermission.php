<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\OrganizationRolePermission; // Update the namespace and class name accordingly

class OrganizationRolesPermissionsController extends Controller
{
    private $locationManager;
    
    public function __construct(OrganizationRolePermission $organizationRolesPermissions)
    {
        $this->locationManager = $organizationRolesPermissions;
    }
    
    public function getOrganization()
    {
        return $this->locationManager->getOrganization();
    }
    
    public function getRole(Request $request)
    {
        $organizationId = $request->organization_id;
        return $this->locationManager->getRole($organizationId);
    }
    
    public function getPermission(Request $request)
    {
        $organizationId = $request->organization_id;
        $roleId = $request->role_id;
        return $this->locationManager->getPermission($organizationId, $roleId);
    }
}
