<?php

declare(strict_types=1);

namespace Database\Factories;
use App\Models\Professional;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Organization>
 */
final class organizationFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = Organization::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
     public function definition(): array
    {
        $administratorName = '-';
        $administratorUsername = '-';
        $administratorEmail = '-';

        $organization = Organization::inRandomOrder()->first();

        return [
            'organization_name' => $this->faker->company,
            'address' => $this->faker->address(['full' => true]),
            'organization_mobile_phone' => $this->faker->numerify(str_repeat('#', 20)),
            'administrator_name' => $administratorName,
            'administrator_username' => $administratorUsername,
            'administrator_email_address' => $administratorEmail,
            'prefer_language' => $this->faker->word,
            'region' => $this->faker->city,
            'blood_glucose_unit' => $this->faker->randomElement(['mg/dL', 'mmol/L']),
            'other_unit' => $this->faker->randomElement(['English', 'metric']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Organization $organization) {

            $organization->update([
                'customized_login_url' => "/14.167.2.15/organization/{$organization->organizationid}",
            ]);
        });
    }
}

