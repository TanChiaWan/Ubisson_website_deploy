<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
final class UserFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = User::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        $plainPassword = $this->faker->password;

        return [
            'username' => $this->faker->userName,
            'password' => bcrypt($plainPassword),
            'remember_token' => Str::random(10),
            'plain_password' => $plainPassword // Add the plain text password as an additional attribute
        ];
    }
}
