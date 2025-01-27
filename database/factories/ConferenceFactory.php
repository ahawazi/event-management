<?php

namespace Database\Factories;

use App\Enums\Region;
use App\Enums\Status;
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
        $date = now()->addMonths(9);
        $endDate = now()->addMonths(9)->addDays(2);
        return [
            'name' => fake()->name(),
            'decisions' => fake()->paragraph(),
            'start_date' => $date,
            'end_date' => $endDate,
            'status' => fake()->randomElement(Status::class),
            'region' => fake()->randomElement(Region::class),
            'venue_id' => Venue::factory(),
        ];
    }
}
