<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Organization;
use App\Models\PracticeGroup;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;


final class PracticeGroupFactory extends Factory
{
    /**
    * The name of the factory's corresponding model.
    *
    * @var string
    */
    protected $model = PracticeGroup::class;

    /**
    * Define the model's default state.
    *
    * @return array
    */
    public function definition(): array
    {
        $organization = Organization::inRandomOrder()->first();
        $groupId = DB::table('practice_groups')->count() + 1;
        $name = 'Practice Group ' . $groupId;
        $organizationId = $organization->organizationid;

        return [
            'organizationid_FK' => $organizationId,
            'name' => $name,
            'subTitle' => $this->faker->optional()->sentence,
            'dangerHightotal' => 0,
            'dangerLowtotal' => 0,
            'thread_id' => $this->faker->optional()->uuid,
        ];
    }
}
