<?php

namespace App\Enums;

enum OfferStatus: string
{
    case Draft = 'draft';
    case Shared = 'shared';
    case Published = 'published';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draft',
            self::Shared => 'Shared',
            self::Published => 'Published',
            self::Archived => 'Archived',
        };
    }
}
