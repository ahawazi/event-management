<?php

namespace App\Models;

use App\Enums\Region;
use App\Enums\Status;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Get;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Conference extends Model
{
    use HasFactory;

    protected $casts = [
        'id' => 'integer',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'region' => Region::class,
        'venue' => 'integer',
        'venue_id' => 'integer',
    ];

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function speakers(): BelongsToMany
    {
        return $this->belongsToMany(Speaker::class);
    }

    public function talks(): BelongsToMany
    {
        return $this->belongsToMany(Talk::class);
    }

    public static function getForm(): array
    {
        return [
            //also we can use the tab to separate the form into multiple sections
            Section::make('Conference Details')
                // this is like a sidebar
                // ->aside()
                ->collapsible()
                ->icon('heroicon-o-information-circle')
                ->description('Provide some basic information about the conference.')
                ->columns(['md' => 2, 'lg' => 3])
                ->schema([
                    TextInput::make('name')
                        ->columnSpanFull()

                        ->label('Conference Name')

                        ->helperText('The name of the conference.')
                        // ->placeholder('Enter the name of the conference.')

                        // hint is a thing in top right corner of the input
                        // ->hint('The name of the conference.')
                        // ->hintIcon('heroicon-o-rectangle-stack')
                        // ->hintAction('https://google.com')

                        ->required()
                        ->maxLength(60),

                    RichEditor::make('decisions')
                        ->columnSpanFull()

                        ->required()

                        ->placeholder('Enter the decisions of the conference.')

                        // chose what buttons do't want to show
                        // ->disableToolbarButtons(['italic'])
                        // chose what buttons do want to show
                        ->ToolbarButtons(['bold', 'link', 'h1', 'h2']),

                    DateTimePicker::make('start_date')
                        // hide native date picker
                        ->native(false)
                        ->required(),

                    DateTimePicker::make('end_date')
                        ->native(false)
                        ->required(),
                    Fieldset::make('Status')
                        ->columns(1)
                        ->schema([

                            Select::make('status')
                                ->enum(Status::class)
                                ->options([
                                    Status::class
                                ])
                                ->required(),
                            Toggle::make('is_published')
                                ->default(false),
                        ])
                ]),

            Section::make('Location')
                ->columns(2)
                ->schema([
                    Select::make('region')
                        ->live()
                        ->required()
                        ->enum(Region::class)
                        ->options(Region::class),

                    Select::make('venue_id')
                        ->searchable()
                        ->preload()

                        ->editOptionForm(Venue::getForm())
                        ->createOptionForm(Venue::getForm())

                        ->relationship('venue', 'name', modifyQueryUsing: function (Builder $query, Get $get) {
                            return $query->where('region', $get('region'));
                        }),
                ]),



            CheckboxList::make('speakers')
                ->relationship('speakers', 'name')
                ->options(
                    Speaker::all()->pluck('name', 'id')
                )


            // TODO
            // TextInput::make('website')
            //     ->url()
            //     ->label('Your Website')
            //     ->prefix('https://')
            //     ->prefixIcon('heroicon-o-globe-alt')
            //     ->suffix('.com')
            //     ->maxLength(255),
        ];
    }
}
