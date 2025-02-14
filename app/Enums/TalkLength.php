<?php

namespace App\Enums;

enum TalkLength: string
{
    case LIGHTNING = 'Lightning - 15 minutes';
    case NORMAL = 'Normal - 30 minutes';
    case KEYNOTE = 'Keynote';

    public function getIcon(): string
    {
        return match ($this) {
            self::LIGHTNING => 'heroicon-o-bolt',
            self::NORMAL => 'heroicon-o-megaphone',
            self::KEYNOTE => 'heroicon-o-key',
        };
    }
}
