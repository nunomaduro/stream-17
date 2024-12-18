<?php

use App\Actions\CreateOffer;
use App\Actions\PublishOffer;
use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;

it('publishes an offer', function () {
    // Arrange
    $user = User::factory()->create();
    $offer = Offer::factory()->create([
        'user_id' => $user->id,
        'status' => OfferStatus::Draft,
    ]);

    // Act
    $this->travelTo($now = now());
    $action = app(PublishOffer::class);
    $action->handle($offer);

    // Assert
    $offer->refresh();

    expect($offer->status)->toBe(OfferStatus::Published)
        ->and($offer->published_at->format('Y-m-d H:i:s'))->toBe($now->format('Y-m-d H:i:s'));
});
