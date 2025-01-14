<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conference_talk', function (Blueprint $table) {
            $table->foreignId('conference_id');
            $table->foreignId('talk_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conference_talk');
    }
};
