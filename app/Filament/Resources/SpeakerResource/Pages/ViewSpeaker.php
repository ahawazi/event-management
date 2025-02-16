<?php

namespace App\Filament\Resources\SpeakerResource\Pages;

use App\Filament\Resources\SpeakerResource;
use App\Models\Speaker;
use Filament\Resources\Pages\ViewRecord;
use Filament\Tables\Actions\EditAction;

class ViewSpeaker extends ViewRecord
{
    protected static string $resource = SpeakerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()
                ->slideOver()
                ->form(Speaker::getForm())
        ];
    }
}
