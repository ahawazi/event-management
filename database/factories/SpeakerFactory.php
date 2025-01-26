<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Speaker;

class SpeakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speaker::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'bio' => fake()->text(),
            'qualifications' => fake()->randomElements([
                'business-leader',
                'charisma',
                'first-time',
                'hometown-hero',
                'humanitrain',
                'laracasts-contributor',
                'twitter-influencer',
                'youtube-influencer',
                'open-source',
                'unique-perspective',
            ]),
            'twitter_handle' => fake()->word(),
        ];
    }
}
