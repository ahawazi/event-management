<?php

namespace App\Models;

use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Filament\Forms\Components\Group;

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
            Group::make()->columns(2)->schema([
                TextInput::make('name')
                    ->required()->maxLength(255),
                TextInput::make('email')
                    ->email()->required()->maxLength(255),
            ])
        ];
    }
}
