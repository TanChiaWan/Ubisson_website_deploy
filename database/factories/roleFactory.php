<?php

declare(strict_types=1);

namespace Database\Factories;
use App\Models\professional;
use App\Models\permission;
use App\Models\organization;
use App\Models\role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\role>
 */
final class roleFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = role::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        $permission = permission::factory()->create();
        $professional = professional::factory()->create();
        $organization = organization::factory()->create();
    
        return [
            'permission_id_FK' => $permission->permission_id,
            'professional_id_FK' => $professional->professional_id,
            'organizationid_FK' => $organization->organizationid,
            'role_name' => $this->faker->word,
            'role_organization' => $organization->organization_name,
            'permissions' => $permission->permissions,
            'role_created_date' => $this->faker->dateTime(),
            'role_updated_date' => $this->faker->dateTime(),
        ];
    }
    
}
