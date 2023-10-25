<?php

declare(strict_types=1);

namespace Database\Factories;
use App\Models\patient;
use App\Models\professional;
use App\Models\remark;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\remark>
 */
final class remarkFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = remark::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
{
    
    $patient = Patient::inRandomOrder()->first();
    $professional = professional::inRandomOrder()->first();
    
    $fakerDateTime = $this->faker->dateTimeBetween('-6 month', 'now');
    $formattedDateTime = $fakerDateTime->format('d/m/Y l h:i:s A');
    $convertedDateTime = Carbon::createFromFormat('d/m/Y l h:i:s A', $formattedDateTime)->format('Y-m-d H:i:s');

    $statuses = ['Critical Situation', 'Recovery', 'Discharge'];
    $randomStatus = $statuses[array_rand($statuses)];

    $commentsByStatus = [
        'Critical Situation' => 'A critical situation occurred that required immediate medical attention. The medical team responded swiftly and effectively to stabilize the patient and address the urgent medical needs.',
        'Recovery' => 'The patient has been making steady progress in their recovery journey. Positive signs of improvement have been observed in various aspects of the patient\'s health, indicating a positive trajectory towards full recovery.',
        'Discharge' => 'After thorough assessment and evaluation, the medical team has determined that the patient is now in a stable condition and no longer requires inpatient care. The patient has been safely discharged and provided with appropriate guidelines for continued recovery at home.'
    ];
    $fileExtension = $this->faker->boolean(50) ? $this->faker->randomElement(['pdf', 'csv']) : null;
    return [
        'patient_id_FK' => $patient->patient_id,
        'professional_id' => $professional->professional_id,
        'status' => $randomStatus,
        'remark_image' => $this->faker->imageUrl(640, 480, 'animals', true, 'cats'),
        'remark_file' => $fileExtension ? 'sample.' . $fileExtension : null,
        'remark_comment' => $commentsByStatus[$randomStatus],
        'remark_created_date' => $convertedDateTime,
    ];
}

}
