<?php

namespace App\Filament\Resources;

use App\Enums\Region;
use App\Filament\Resources\ConferenceResource\Pages;
use App\Models\Conference;
use Filament\Forms;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ConferenceResource extends Resource
{
    protected static ?string $model = Conference::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Conference Name')

                    ->helperText('The name of the conference.')
                    // ->placeholder('Enter the name of the conference.')

                    // hint is a thing in top right corner of the input
                    // ->hint('The name of the conference.')
                    // ->hintIcon('heroicon-o-rectangle-stack')
                    // ->hintAction('https://google.com')

                    ->required()
                    ->maxLength(60),

                Forms\Components\RichEditor::make('decisions')
                    ->required()

                    ->placeholder('Enter the decisions of the conference.')

                    // chose what buttons do't want to show
                    // ->disableToolbarButtons(['italic'])
                    // chose what buttons do want to show
                    ->ToolbarButtons(['bold', 'link', 'h1', 'h2']),

                Forms\Components\DateTimePicker::make('start_date')
                    // hide native date picker
                    ->native(false)
                    ->required(),

                Forms\Components\DateTimePicker::make('end_date')
                    ->native(false)
                    ->required(),

                Toggle::make('is_published')
                    ->default(false),

                Forms\Components\Select::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ])
                    ->required(),

                    Forms\Components\Select::make('region')
                    ->required()
                    ->enum(Region::class)
                    ->options(Region::class),

                Forms\Components\Select::make('venue_id')
                    ->relationship('venue', 'name'),

                // TODO
                // Forms\Components\TextInput::make('website')
                //     ->url()
                //     ->label('Your Website')
                //     ->prefix('https://')
                //     ->prefixIcon('heroicon-o-globe-alt')
                //     ->suffix('.com')
                //     ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('decisions')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('region')
                    ->searchable(),
                Tables\Columns\TextColumn::make('venue.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConferences::route('/'),
            'create' => Pages\CreateConference::route('/create'),
            'edit' => Pages\EditConference::route('/{record}/edit'),
        ];
    }
}
