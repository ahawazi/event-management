<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Speaker;
use App\Models\Talk;

class TalkFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Talk::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(4),
            'abstract' => fake()->text(),
            'speaker_id' => Speaker::factory(),
        ];
    }
}
