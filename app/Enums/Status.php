<?php

namespace App\Enums;

enum Status: string
{
    case draft = 'Draft';
    case published = 'Published';
    case archived = 'Archived';
}
