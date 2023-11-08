<?php

namespace Database\Seeders;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\organization;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
        
            'Messages' => [
                'View Message',
                'Send Message',
                
            ],
        
            'Organisation' => [
                'View Own Organisation',
                'Edit Own Organisation',
                'View Other Organisation',
                'Edit Other Organisation',
                'Create Organisation',
            ],
            'Patient' => [
                'View Internal Patient',
                'Edit Internal Patient',
                'Create Internal Patient',
                'View Internal Patient Data',
                'Create Internal Patient Data',
                'Edit Internal Patient Data',
                'Disable Internal Patient',
                'View External Patient',
                'Edit External Patient',
                'Create External Patient',
                'View External Patient Data',
                'Create External Patient Data',
                'Edit External Patient Data',
                'Disable External Patient',
            ],
            'Practice Group' => [
                'View Hyper Event',
                'View Hypo Event',
                'View Appointment',
               
              
                'Create Practice Group',
                'View Practice Group',
                'Edit Practice Group',
                'Delete Practice Group',
                'Add Patient To Group',
                'Add Professional To Group',
            ],
            'Roles And Permission' => [
                'View Roles',
                'Edit Roles',
                'Create Roles',
                'Manage Permissions',
            ],
            'User' => [
                'View Internal User',
                'Edit Internal User',
                'Create Internal User',
                'Disable Internal User',
                'View External User',
                'Edit External User',
                'Create External User',
                'Disable External User',
            ],
        ];
        
     
        
        $roles = ['Super Admin', 'Admin', 'User'];
$organizations = Organization::all();

foreach ($roles as $roleName) {
    $randomNumber = mt_rand(1, 9999); // Generate a random number between 1 and 9999
    $adminName = $roleName . $randomNumber;
    $adminRole = Role::create(['name' => $adminName]);

    foreach ($organizations as $organization) {
        if ($organization) {
            $randomOrganization = $organizations->random();

            // Check if the role already exists
            $existingRole = Role::where('name', $adminName)
                ->where('guard_name', 'web')
                ->first();

            if (!$existingRole) {
                $role = Role::create(['name' => $adminName]);
            } else {
                $role = $existingRole;
            }

            $randomOrganizationID = $randomOrganization->organizationid;
            $role->organizationid = $randomOrganizationID;
            $role->save();

            $rolePermissions = [];

            foreach ($permissions as $category => $permissionNames) {
                $randomPermissionNames = collect($permissionNames)->random(mt_rand(1, count($permissionNames)));

                foreach ($randomPermissionNames as $permissionName) {
                    // Check if the permission already exists
                    $existingPermission = Permission::where('name', $permissionName)
                        ->where('guard_name', 'web')
                        ->first();

                    if (!$existingPermission) {
                        $permission = Permission::create([
                            'name' => $permissionName,
                            'guard_name' => 'web',
                            'permission_category' => $category,
                            'created_at' => Carbon::now()->format('d-m-Y'),
                            'updated_at' => Carbon::now()->format('d-m-Y'),
                        ]);
                    } else {
                        $permission = $existingPermission;
                    }

                    // Assign the random organization ID to the role permission
                    $rolePermissions[$permission->id] = ['organizationid' => $randomOrganizationID];
                }
            }

            $role->permissions()->sync($rolePermissions);
        }
    }
}

        
    
    

// ...

        
    }
}
