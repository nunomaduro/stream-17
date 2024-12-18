<?php

namespace App\Actions;

use App\Enums\OfferStatus;
use App\Models\Offer;

class ArchiveOffer
{
    public function handle(Offer $offer): void
    {
        $offer->update([
            'status' => OfferStatus::Archived,
            'archived_at' => now(),
        ]);
    }
}








