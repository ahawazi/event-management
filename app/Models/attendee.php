<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendee extends Model
{
    /** @use HasFactory<\Database\Factories\AttendeesFactory> */
    use HasFactory;

    public function Conference(): BelongsTo
    {
        return $this->belongsTo(Conference::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(20),
            TextInput::make('email')
                ->required()
                ->maxLength(50),
        ];
    }
}
