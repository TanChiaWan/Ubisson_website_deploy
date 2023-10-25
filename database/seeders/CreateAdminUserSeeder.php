<?php

namespace Database\Seeders;
use App\Models\organization;
use App\Models\professional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organization = Organization::factory()->create();
       

        // ...
        
        $user = Professional::create([
            'organizationid_FK' => $organization->organizationid,
            'organization_name' => $organization->organization_name,
            'professional_name' => 'Hardik Savani',
            'professional_gender' => 'Male',
            'professional_mobile_phone' => '1234567890',
            'professional_organization' => 'Your Professional Organization',
            'username' => 'admin',
            'password' => bcrypt('123456'),
            'plain_password' => '123456',
            'professional_email_address' => 'admin@gmail.com',
            'professional_type_of_profession' => 'Your Profession',
            'professional_account_role' => 'Admin2',
            'status' => 'Active'
        ]);
        
        $roles = Role::where('guard_name', 'web2')->pluck('id')->all();
        $randomRoleId = array_rand($roles);
        $randomRole = Role::find($roles[$randomRoleId]);
        
        $permissions = Permission::where('guard_name', 'web2')->pluck('id')->all();
        $randomPermissions = array_rand($permissions, 3); // Assuming you want to assign 3 random permissions
        
        $randomRole->syncPermissions($randomPermissions);
        
        $user->assignRole([$randomRole->id]);
    }
}
