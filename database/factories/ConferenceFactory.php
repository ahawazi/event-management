<?php

namespace Database\Factories;

use App\Enums\Region;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Conference;
use App\Models\Venue;

class ConferenceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Conference::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'decisions' => fake()->word(),
            'start_date' => fake()->dateTime(),
            'end_date' => fake()->dateTime(),
            'status' => fake()->word(),
            'region' => fake()->randomElement(Region::class),
            'venue_id' => Venue::factory(),
        ];
    }
}
