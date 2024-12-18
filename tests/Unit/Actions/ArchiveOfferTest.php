<?php

use App\Actions\ArchiveOffer;
use App\Actions\CreateOffer;
use App\Actions\PublishOffer;
use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;

it('archives an offer', function () {
    // Arrange
    $user = User::factory()->create();
    $offer = Offer::factory()->create([
        'user_id' => $user->id,
        'status' => OfferStatus::Draft,
    ]);

    // Act
    $this->travelTo($now = now());
    $action = app(ArchiveOffer::class);
    $action->handle($offer);

    // Assert
    $offer->refresh();

    expect($offer->status)->toBe(OfferStatus::Archived)
        ->and($offer->archived_at->format('Y-m-d H:i:s'))->toBe($now->format('Y-m-d H:i:s'));
});

it('may archives an offer that has been published', function () {
    // Arrange
    $this->travelTo($now = now());

    $user = User::factory()->create();
    $offer = Offer::factory()->published()->create([
        'user_id' => $user->id,
    ]);

    $publishedAt = $offer->published_at;

    // Act
    $action = app(ArchiveOffer::class);
    $action->handle($offer);

    // Assert
    $offer->refresh();

    expect($offer->status)->toBe(OfferStatus::Archived)
        ->and($offer->published_at->format('Y-m-d H:i:s'))->toBe($publishedAt->format('Y-m-d H:i:s'))
        ->and($offer->archived_at->format('Y-m-d H:i:s'))->toBe($now->format('Y-m-d H:i:s'));
});
