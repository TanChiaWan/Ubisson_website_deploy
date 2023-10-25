<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Professional;
use App\Models\Medication;
use App\Models\Diagnosis;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Diagnosis>
 */
final class diagnosisFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Diagnosis::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        $professional = Professional::inRandomOrder()->first();
        $patient = Patient::inRandomOrder()->first();
       
        // Generate a random number of medicine IDs to store in the list, or set to null
        
    
        return [
            'patient_id_FK' => $patient->patient_id,
            'diagnosis_title' => $this->faker->sentence(3),
            'diagnosis_startdate' => $this->faker->dateTimeBetween('-6 month', 'now')->format('Y-m-d'),
            'diagnosis_enddate' => $this->faker->dateTimeBetween('-5 month', 'now')->format('Y-m-d'),
            'severity' => $this->faker->randomElement(['Mild', 'Moderate', 'Severe']),
            'professional_id' => $professional->professional_id,
            'diagnosiscreated_date' => $this->faker->dateTimeBetween('-6 month', 'now')->format('Y-m-d'),
            'diagnosisupdated_date' => $this->faker->dateTimeBetween('-6 month', 'now')->format('Y-m-d'),
        
            'taken_period' => $this->faker->randomElement(['After Breakfast', 'Before Breakfast','After Lunch','Before Lunch','After Dinner','Before Dinner']),
            'date_taken' => $this->faker->dateTimeBetween('-6 month', 'now'),
            'active' => $this->faker->boolean,
            'inuse' => $this->faker->boolean,
        ];
    }
    

}
