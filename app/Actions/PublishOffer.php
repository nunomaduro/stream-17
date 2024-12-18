<?php

namespace App\Actions;

use App\Enums\OfferStatus;
use App\Models\Offer;

class PublishOffer
{
    public function handle(Offer $offer): void
    {
        $offer->update([
            'status' => OfferStatus::Published,
            'published_at' => now(),
        ]);
    }
}








