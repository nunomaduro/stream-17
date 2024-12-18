<?php

use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Support\Carbon;


test('to array', function () {
    $offer = Offer::factory()->create()->fresh();

    expect(array_keys($offer->toArray()))->toBe([
        'id',
        'user_id',
        'title',
        'description',
        'status',
        'published_at',
        'archived_at',
        'created_at',
        'updated_at',
    ]);
});

test('status', function () {
    $offer = Offer::factory()->create()->fresh();

    expect($offer->status)->toBe(OfferStatus::Draft);
});

test('published at', function () {
    $offer = Offer::factory()->published()->create()->fresh();

    expect($offer->published_at)->toBeInstanceOf(Carbon::class);
});

test('archived at', function () {
    $offer = Offer::factory()->archived()->create()->fresh();

    expect($offer->archived_at)->toBeInstanceOf(Carbon::class);
});

it('belongs to a user', function () {
    $offer = Offer::factory()->create();

    expect($offer->user)->toBeInstanceOf(User::class);
});
