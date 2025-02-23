<?php

namespace App\Filament\Resources;

use App\Enums\TalkStatus;
use App\Filament\Resources\TalkResource\Pages;
use App\Models\Talk;
use Filament\Tables\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\support\Str;

class TalkResource extends Resource
{
    protected static ?string $model = Talk::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(Talk::getForm());
    }

    public static function table(Table $table): Table
    {
        return $table
            //this is save the fillter in session
            ->persistFiltersInSession()
            //add note to filtter icone
            ->filtersTriggerAction(function ($action) {
                return $action->button()->label('Filters');
            })
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(function (Talk $record) {
                        return Str::limit($record->abstract, 40);
                    }),
                ImageColumn::make('speaker.avatar')
                    ->label('Speaker Avatar')
                    ->circular()
                    ->defaultImageUrl(function ($record) {
                        return 'https://ui-avatars.com/api/?background=0D8ABC&color=fff&name=' . urlencode($record->speaker->name);
                    }),
                Tables\Columns\TextColumn::make('speaker.name')
                    ->searchable()
                    ->sortable(),
                // IconColumn::make('new_talk')->boolean(),
                ToggleColumn::make('new_talk')
                    ->sortable(),
                TextColumn::make('status')
                    ->sortable()
                    ->badge()
                    ->color(function ($state) {
                        return $state->getColor();
                    }),
                IconColumn::make('length')
                    ->icon(function ($state) {
                        return $state->getIcon();
                    }),
            ])
            ->filters([
                TernaryFilter::make('new_talk'),
                SelectFilter::make('speaker')
                    ->relationship('speaker', 'name')
                    ->multiple()
                    ->searchable()
                    ->preload(),
                Filter::make('has_avatar')
                    ->label('Show only Speaker Has Avatar')
                    ->toggle()
                    ->query(function ($query) {
                        return $query->whereHas('speaker', function (Builder $query) {
                            $query->whereNotNull('avatar');
                        });
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
                ActionGroup::make([
                    Action::make('approve')
                        ->visible(function ($record) {
                            return $record->status === (TalkStatus::SUBMITTED);
                        })
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(function (Talk $record) {
                            $record->approve();
                        })->after(function () {
                            Notification::make()->success()->title('This talk has been approved!')
                                ->duration(2000)
                                ->body('The talk has been approved and is now visible to the public.')
                                ->send();
                        }),

                    Action::make('reject')
                        ->icon('heroicon-o-no-symbol')
                        ->color('danger')
                        ->requiresConfirmation()
                        ->visible(function ($record) {
                            return $record->status === (TalkStatus::SUBMITTED);
                        })
                        ->action(function (Talk $record) {
                            $record->reject();
                        })->after(function () {
                            Notification::make()->danger()->title('This talk has been rejected!')
                                ->duration(2000)
                                ->body('The talk has been rejected and is no longer visible to the public.')
                                ->send();
                        }),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    RestoreBulkAction::make(),

                    BulkAction::make('approve')->action(function (Collection $records) {
                        $records->each->approve();
                    }),
                ]),

            ])->headerActions([
                Action::make('export')
                    ->tooltip('will be implemented soon')
                    ->action(function () {
                        dd("Exporting Talks");
                    })
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
            'index' => Pages\ListTalks::route('/'),
            'create' => Pages\CreateTalk::route('/create'),
            // 'edit' => Pages\EditTalk::route('/{record}/edit'),
        ];
    }
}
