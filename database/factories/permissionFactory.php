<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\permission;
use App\Models\professional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\permission>
 */
final class permissionFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = permission::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        $professional = professional::factory()->create();
        $permissions = [
            'Audit' => [
                'View Logs',
            ],
            'Messages' => [
                'View Message',
                'Send Message',
                'View Broadcast Message',
                'Send Broadcast Message',
                'Edit Broadcast Message',
            ],
            'Old Permissions' => [
                'Internal Patients',
                'External Patients',
                'My Organization',
                'All Organizations',
                'Modify Roles',
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
                'Create Appointment',
                'Edit Appointment',
                'Delete Appointment',
                'Add Patient From App',
                'Merge Patient Account',
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
                'Change User Password',
                'View External User',
                'Edit External User',
                'Create External User',
                'Disable External User',
            ],
        ];
    
        $randomPermissions = [];
        foreach ($permissions as $group => $groupPermissions) {
            foreach ($groupPermissions as $permission) {
                if (rand(0, 1)) {
                    $randomPermissions[$group][] = $permission;
                }
            }
        }
        return [
            'professional_id_FK' => $professional->professional_id,
            'permission_name' => $this->faker->word,
            'permission_category' => $this->faker->word,
            'permission_created_date' => $this->faker->dateTime(),
            'permission_updated_date' => $this->faker->dateTime(),
            'permissions' => json_encode($randomPermissions),
        ];
    }
}
            
