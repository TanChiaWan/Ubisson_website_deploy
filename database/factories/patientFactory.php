<?php

declare(strict_types=1);

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Organization;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

class PatientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Patient::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        
    
        $dateOfBirth = $this->faker->date();
        $age = Carbon::parse($dateOfBirth)->age;
        $organization = null;
        $organizationId = null;
        $organizationName = null;
        $dangerousLowStart = $this->faker->numberBetween(10, 80);
        $dangerousHighEnd = $this->faker->numberBetween(130, 200);
        
        // Generate a random value to determine if organizationid_FK should be null
        $shouldHaveOrganization = $this->faker->boolean(50); // Adjust the percentage as needed
        
        if ($shouldHaveOrganization) {
            $organization = Organization::inRandomOrder()->first();
            $organizationId = $organization->organizationid;
            $organizationName = $organization->organization_name;
        }
        
        return [
            'organizationid_FK' => $organizationId,
            'organization_name' => $organizationName,
    
            'patient_number' => $this->faker->randomNumber(),
            'patient_image' => $this->faker->imageUrl(),
            'patient_name' => $this->faker->name,
            'patient_gender' => $this->faker->randomElement(['Male', 'Female']),
            'diabetes_type' => $this->faker->randomElement(['Type 1', 'Type 2', 'Gestational','Pre-diabetes','Non-diabetes']),
            'date_of_birth' => $dateOfBirth,
            'date_of_diagnosis' => $this->faker->date(),
            'idealrangeBG_low' => $this->faker->numberBetween(70, 90),
            'idealrangeBG_high' => $this->faker->numberBetween(120, 140),
            'triggertimes' => 0,
            'dangerHigh' => 0,
            'dangerLow' => 0,
            'dangerousrangeBG_low' =>  $dangerousLowStart,
            'dangerousrangeBG_high' =>  $dangerousHighEnd,
            'patient_phonenum' => '+601' . $this->faker->numerify('######'),
            'emergencypersonname' => $this->faker->name,
            'emergencypersonphonenum' => '+601' . $this->faker->numerify('######'),
            'patient_age' => $age,
            'targetBG_low_BC' => $this->faker->randomFloat(1, 3, 6), // Adjust the range as needed
            'targetBG_high_BC' => $this->faker->randomFloat(1, 7, 14), // Adjust the range as needed
            'targetBG_low_AC' => $this->faker->randomFloat(1, 3, 6), // Adjust the range as needed
            'targetBG_high_AC' => $this->faker->randomFloat(1, 7, 14), // Adjust the range as needed
            'targetBG_low_BT' => $this->faker->randomFloat(1, 3, 6), // Adjust the range as needed
            'targetBG_high_BT' => $this->faker->randomFloat(1, 7, 14), // Adjust the range as needed
            'targethba1c' => $this->faker->randomFloat(1, 4, 6), // Adjust the range as needed
            'mincarb' => $this->faker->randomFloat(1, 3, 6), // Adjust the range as needed
            'maxcarb' => $this->faker->randomFloat(1, 7, 14), // Adjust the range as needed
            'minweight' => $this->faker->randomFloat(1, 3, 6), // Adjust the range as needed
            'maxweight' => $this->faker->randomFloat(1, 7, 14), // Adjust the range as needed
            'minbmi' => $this->faker->randomFloat(1, 17, 24), // Adjust the range as needed
            'maxbmi' => $this->faker->randomFloat(1, 20, 30), // Adjust the range as needed
            'totalactivity' => $this->faker->randomFloat(1, 1, 100), // Adjust the range as needed
        ];
    }
}
