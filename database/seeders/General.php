<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class General extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\organization::factory(20)->create();
        \App\Models\professional::factory(80)->create();
        \App\Models\patient::factory(10)->create();
        \App\Models\remark::factory(100)->create();
        \App\Models\allergy::factory(100)->create();
        \App\Models\diagnosis::factory(100)->create();
        \App\Models\healthdata::factory(100)->create();
        \App\Models\logbook::factory(100)->create();
        \App\Models\practicegroup::factory(1)->create();
  
        $logbooks = \App\Models\logbook::all();

 
$practice_groups = \App\Models\PracticeGroup::all();

foreach ($logbooks as $logbook) {
    $matchingPatient = \App\Models\Patient::where('patient_id', $logbook->patient_id_FK)->first();

    if ($matchingPatient) {
        $bgLevel = $logbook->bg_level;
        $dangerLowStart = $matchingPatient->dangerousrangeBG_low;
        $dangerLowEnd = $matchingPatient->idealrangeBG_low;
        $dangerHighStart = $matchingPatient->idealrangeBG_high;
        $dangerHighEnd = $matchingPatient->dangerousrangeBG_high;

        if ($bgLevel >= $dangerLowStart && $bgLevel <= $dangerLowEnd) {
            $matchingPatient->dangerLow++;
        }

        if ($bgLevel >= $dangerHighStart && $bgLevel <= $dangerHighEnd) {
            $matchingPatient->dangerHigh++;
        }

        $matchingPatient->triggertimes = $matchingPatient->dangerLow + $matchingPatient->dangerHigh;

        $matchingPatient->save();

       
        
}
    }
}
}


    

