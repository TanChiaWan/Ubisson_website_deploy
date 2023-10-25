<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\patient;
use App\Models\healthdata;
use Illuminate\Database\Eloquent\Factories\Factory;

final class healthdataFactory extends Factory
{
    protected $model = healthdata::class;

    public function definition(): array
    {
        $randomDate = $this->faker->dateTimeThisYear();
        $celcius = $this->faker->randomFloat(1, 35, 42);
        $daysBefore = mt_rand(1, 15);
        $bgLogbookDate = date('Y-m-d', strtotime("-$daysBefore days"));
        $patientId = Patient::inRandomOrder()->value('patient_id');
      
        $category = $this->faker->randomElement([
            'General',
            'Glucose',
            'Lipids',
            'Kidney',
            'Urine',
            'Electrolysis',
            'Liver'
        ]);
    
        $unit = '';
    
        switch ($category) {
            case 'General (Weight, Height, SBP/DBP, HR, Celsius, Fahrenheit)':
                $unit = 'kg, cm, mmHg, bpm, °C, °F';
                break;
            case 'Glucose (Operator, GA)':
                $unit = 'mmol/L, -';
                break;
            case 'Lipids (CHO, HDL, LDL-C, TG)':
                $unit = 'mg/dL, mg/dL, mg/dL, mg/dL';
                break;
            case 'Kidney (CKD Stage, CRE, UA, eGFR)':
                $unit = '-,mg/dL, mg/dL, mL/min/1.73m²';
                break;
            case 'Urine (ACR, MA, PRO, UPCR)':
                $unit = 'mg/g, mg/g, mg/g, mg/mmol';
                break;
            case 'Electrolysis (CA, K, NA, P)':
                $unit = 'mg/dL, mEq/L, mEq/L, mg/dL';
                break;
            case 'Liver (GPT/ALT, GOT)':
                $unit = 'U/L, U/L';
                break;
            default:
                $unit = '';
        }
        $randomDate = $this->faker->dateTimeThisYear();
        return [
            'patient_id_FK' => $patientId,
            'date' => $bgLogbookDate,
            'weight' => $this->faker->randomFloat(1, 30, 100),
            'height' => $this->faker->randomFloat(1, 100, 190),
            'sbp' => $this->faker->numberBetween(100, 200),
'dbp' => $this->faker->numberBetween(60, 90),
            'pulse' => $this->faker->numberBetween(60, 90),
            'hr' => $this->faker->randomFloat(1, 40, 120),
            'celcius' => $celcius,
            'fahrenheit' => ($celcius * 9/5) + 32,
            'operator' => $this->faker->randomFloat(1, 1, 10),
            'a1cpercentage' => $this->faker->randomFloat(1, 1, 10),
            'testID' => $this->faker->randomFloat(1, 1, 10),
            'lotview' => $this->faker->randomFloat(1, 1, 10),
            'instid' => $this->faker->randomFloat(1, 1, 10),

            'ga' => $this->faker->randomFloat(1, 0, 20),
            'cho' => $this->faker->randomFloat(2, 2, 15),
            'hdl' => $this->faker->randomFloat(1, 0, 3),
            'ldlc' => $this->faker->randomFloat(1, 0, 5),
            'tg' => $this->faker->randomFloat(1, 0, 10),
            'tc' => $this->faker->randomFloat(1, 0, 10),
            'cpeptide' => $this->faker->randomFloat(2, 0, 5),
            'ckdstage' => $this->faker->randomFloat(0, 1, 5),
            'cre' => $this->faker->randomFloat(2, 20, 500),
            'ua' => $this->faker->randomFloat(1, 100, 600),
            'egfr' => $this->faker->randomFloat(2, 30, 200),
            'acr' => $this->faker->randomFloat(1, 0, 300),
            'ma' => $this->faker->randomFloat(2, 0, 1),
            'pro' => $this->faker->randomFloat(1, 0, 200),
            'upcr' => $this->faker->randomFloat(1, 0, 500),
            'ca' => $this->faker->randomFloat(1, 0, 10),
            'k' => $this->faker->randomFloat(1, 2, 7),
            'na' => $this->faker->randomFloat(1, 120, 150),
            'p' => $this->faker->randomFloat(1, 0, 6),
            'gpt/alt' => $this->faker->randomFloat(1, 5, 1000),
          
            'got' => $this->faker->randomFloat(1, 5, 1000),
            'carbon' => $this->faker->randomFloat(1, 100, 300),
            'activity' => $this->faker->randomFloat(1, 100, 300),
            'unit' => $unit,
        ];
    
           
           
    }
}

