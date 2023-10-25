<?php

declare(strict_types=1);

namespace Database\Factories;
use App\Models\patient;
use App\Models\allergy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\allergy>
 */
final class allergyFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = allergy::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        $patient = Patient::inRandomOrder()->first();
        $fakerDateTime = $this->faker->dateTimeBetween('-6 month', 'now');
      
        return [
            'patient_id_FK' => $patient->patient_id,
            'allergy_name' => fake()->word,
            'allergy_symptoms' => fake()->word,
            'allergy_severity' => fake()->word,
            'allergycreated_date' => $fakerDateTime,
        ];
    }
}
