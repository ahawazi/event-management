<?php

namespace Database\Seeders;

use App\Models\Talk;
use Illuminate\Database\Seeder;

class TalkSeeder extends Seeder
{
    public function run(): void
    {
        Talk::factory()->count(2)->create();
    }
}
