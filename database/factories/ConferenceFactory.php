<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
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
            'name' => $this->faker->name(),
            'decisions' => $this->faker->word(),
            'start_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime(),
            'status' => $this->faker->word(),
            'region' => $this->faker->word(),
            'venue_id' => Venue::factory(),
        ];
    }
}
