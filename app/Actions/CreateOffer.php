<?php

namespace App\Actions;

use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CreateOffer
{
    public function __construct(protected PublishOffer $publishOfferAction)
    {
        //
    }

    public function handle(User $user, OfferStatus $status, string $title, string $description): Offer
    {
        return DB::transaction(function () use ($user, $status, $title, $description) {
            $offer = $user->offers()->create([
                'title' => $title,
                'description' => $description,
                'status' => OfferStatus::Draft,
            ]);

            match ($status) {
                OfferStatus::Published => $this->publishOfferAction->handle($offer),
                default => null,
            };

            return $offer;
        });
    }
}
