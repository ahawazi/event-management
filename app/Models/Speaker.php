<?php

namespace App\Models;

use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Speaker extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'qualifications' => 'array',
    ];

    public function conferences(): BelongsToMany
    {
        return $this->belongsToMany(Conference::class);
    }

    public static function getForm()
    {
        return [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            FileUpload::make('avatar')
                ->maxSize(1024 * 1024 * 2),
            TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Textarea::make('bio')
                ->required()
                ->columnSpanFull(),
            TextInput::make('twitter_handle')
                ->required()
                ->maxLength(255),
            // TODO Add a `CheckboxList` component for the `qualifications` attribute or enum.
            CheckboxList::make('qualifications')
                ->columnSpanFull()
                ->searchable()
                //this will allow the user to select multiple options
                ->bulkToggleable()
                ->options(
                    [
                        'business-leader' => 'Business Leader',
                        'charisma' => 'Charismatic Speaker',
                        'first-time' => 'First Time Speaker',
                        'hometown-hero' => 'Hometown Hero',
                        'humanitrain' => 'Works in Humanitarian Field',
                        'laracasts-contributor' => 'Laracasts Contributor',
                        'twitter-influencer' => 'large Twitter Following',
                        'youtube-influencer' => 'large Youtube Following',
                        'open-source' => 'Open Source Creator / maintainer',
                        'unique-perspective' => 'Unique Perspective',
                    ]
                )
                ->descriptions([
                    'business-leader' => 'This speaker is a business leader.',
                    'charisma' => 'This speaker is a charismatic speaker.',
                    'first-time' => 'This speaker is a first time speaker.',
                    'hometown-hero' => 'This speaker is a hometown hero.',
                    'humanitrain' => 'This speaker works in the humanitarian field.',
                    'laracasts-contributor' => 'This speaker is a Laracasts contributor.',
                    'twitter-influencer' => 'This speaker has a large Twitter following.',
                    'youtube-influencer' => 'This speaker has a large Youtube following.',
                    'open-source' => 'This speaker is an open source creator/maintainer.',
                    'unique-perspective' => 'This speaker has a unique perspective.',
                ])
                ->columns(3),
        ];
    }
}
