<?php

use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;

test('to array', function () {
    $user = User::factory()->create()->fresh();

    expect(array_keys($user->toArray()))->toBe([
        'id',
        'name',
        'email',
        'email_verified_at',
        'created_at',
        'updated_at',
    ]);
});

it('has offers', function () {
    $user = User::factory()->hasOffers(3)->create()->fresh();

    Offer::factory()->published()->create(['user_id' => $user->id]);

    $offer = $user->offers->last();

    expect($user->offers)->toHaveCount(4)
        ->and($offer->status)->toBe(OfferStatus::Published);
});
