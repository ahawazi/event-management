<?php

namespace App\Filament\Resources\AttendeeResource\Widgets;

use Filament\Widgets\ChartWidget;

class AttendeeChartWidget extends ChartWidget
{
    protected static ?string $heading = 'Chart';

    protected function getData(): array
    {
        return [
            //
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
