<?php

use App\Actions\CreateOffer;
use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;

it('creates an offer', function () {
    // Arrange
    $user = User::factory()->create();
    $action = app(CreateOffer::class);

    // Act
    $offer = $action->handle($user, OfferStatus::Draft, 'My Offer', 'This is my offer');

    // Assert
    expect(Offer::count())->toBe(1)
        ->and($offer->title)->toBe('My Offer')
        ->and($offer->description)->toBe('This is my offer')
        ->and($offer->user_id)->toBe($user->id)
        ->and($offer->status)->toBe(OfferStatus::Draft);
});

it('creates an offer and sets the status to published', function () {
    // Arrange
    $user = User::factory()->create();
    $action = app(CreateOffer::class);

    // Act
    $offer = $action->handle($user, OfferStatus::Published, 'My Offer', 'This is my offer');

    // Assert
    expect($offer->status)->toBe(OfferStatus::Published);
});
