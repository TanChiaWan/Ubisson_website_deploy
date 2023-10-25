<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\organization;
use Spatie\Permission\Models\Role;
use App\Models\professional;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\professional>
 */
final class professionalFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = professional::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    

    public function definition(): array
{
    $organization = Organization::inRandomOrder()->first();

    $plainPassword = '12345678';
    $rememberToken = $this->faker->boolean ? Str::random(10) : null;
    $status = $this->faker->randomElement(['Active', 'Disabled']); // Randomize the status
    $temperature = $this->faker->randomElement(['Celcius (°C)', 'Farenheit (°F)']); // Randomize the status
    $roleName = Role::inRandomOrder()->first()->name; // Get a random role name from the roles table

    static $usernameNumber = 1; // Initialize a static variable to keep track of the username number
    $username = 'admin' . $usernameNumber; // Generate the username with the current username number
    $usernameNumber++; // Increment the username number for the next generated username

    $organizationIdFK = null; // Set the organizationid_FK to null for some entries
    if ($this->faker->boolean(80)) {
        $organizationIdFK = $organization->organizationid;
    }

    return [
        'organizationid_FK' => $organizationIdFK,
        'organization_name' => $organization ? $organization->organization_name : null,
        'professional_name' => $this->faker->name,
        'professional_gender' => $this->faker->randomElement(['Male', 'Female']),
        'professional_mobile_phone' => $this->faker->phoneNumber,
        'professional_image' => $this->faker->imageUrl(),
        'username' => $username, // Use the generated username
        'password' => bcrypt($plainPassword),
        'plain_password' => $plainPassword,
        'remember_token' => $rememberToken,
        'professional_email_address' => $this->faker->email,
        'professional_type_of_profession' => $this->faker->randomElement([
            'Nurse',
            'Therapist',
            'Dietitians',
            'Certified Diabetes Educator',
            'Examiner',
            'Doctor',
            'Administration Staff',
            'Pharmacist',
            'Person In Charge',
        ]),
        'temperature_unit' => $temperature,
        'professional_account_role' => $roleName, // Assign the random role name
        'status' => $status, // Set the randomized status
    ];
}


public function configure()
{
    return $this->afterCreating(function (Professional $professional) {
        $organization = Organization::inRandomOrder()->first();
        $newProfessional = Professional::inRandomOrder()
            ->where('organizationid_FK', $organization->organizationid)
            ->first();


        if ($organization && $newProfessional) {  
            $organization->administrator_name = $newProfessional->professional_name;
            $organization->administrator_username = $newProfessional->username;
            $organization->administrator_email_address = $newProfessional->professional_email_address;
            $organization->save();
        }
    });
}



    
}
