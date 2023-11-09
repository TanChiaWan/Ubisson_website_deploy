<?php

namespace Database\Factories;

use App\Models\Logbook;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class LogbookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Logbook::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $patientId = Patient::whereNotNull('organizationid_FK')->inRandomOrder()->value('patient_id');
        $bgPeriods = ['Wakeup','After Breakfast', 'Before Breakfast','After Lunch','Before Lunch','After Dinner','Before Dinner','Bedtime'];
    
        $randomDate = $this->faker->unique()->dateTimeBetween('-14 days', 'now');
        $bgLogbookDate = $randomDate->format('Y-m-d H:i:s'); // Use the correct format
    
        // Generate unique dates for each bgPeriod
        $bgLogbookDates = array_fill_keys($bgPeriods, $bgLogbookDate);
    
        // Shuffle the bgPeriods array to achieve 50/50 probability
        shuffle($bgPeriods);
    
        return [
            'patient_id_FK' => $patientId,
            'bp_logbook_date' => $this->faker->unique()->dateTimeBetween('-14 days', 'now')->format('Y-m-d'),
            'bp_level' => $this->faker->numberBetween(80, 200),
            'bp_level2' => $this->faker->numberBetween(50, 150),
            'bp_pulse' => $this->faker->numberBetween(60, 200),
            'bg_period' => $bgPeriods[0], // Set the first bg_period
            'bp_period' => $this->faker->randomElement(['Morning', 'Night']),
            'bg_logbook_date' => $bgLogbookDates[$bgPeriods[0]], // Use the same date for the first bg_period
            'bg_level' => $this->faker->randomFloat(1, 2, 20), 
            'carbohydrate' => $this->faker->numberBetween(20, 100),
            'rapid' => $this->faker->numberBetween(1.0, 10.0),
            'exercise' => $this->faker->numberBetween(20, 100),
            'image' => $this->faker->imageUrl(),
            'image_title' => $this->faker->sentence(5, true),
         

        ];
    }
    






    
    
}
