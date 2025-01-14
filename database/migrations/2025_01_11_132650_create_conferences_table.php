<?php

use App\Models\Venue;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('name', 60);
            $table->string('decisions');

            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->string('status');
            $table->string('region');

            $table->foreignIdFor(Venue::class, 'venue_id')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
