<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '123456789',
            ]
        );

        $this->call([
            SpeakerSeeder::class,
            VenueSeeder::class,
            ConferenceSeeder::class,
            TalkSeeder::class,
            AttendeeSeeder::class,
        ]);
    }
}
