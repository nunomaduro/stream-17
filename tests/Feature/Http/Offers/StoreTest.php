<?php

use App\Enums\OfferStatus;
use App\Models\Offer;
use App\Models\User;

it('creates a offer', function () {
    // Arrange
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('offers.store'), [
            'title' => 'My Offer',
            'description' => 'This is my offer',
            'status' => OfferStatus::Draft->value,
        ]);

    $response->assertStatus(201);

    // Assert
    $offer = $user->offers()->first();
    expect(Offer::count())->toBe(1)
        ->and($offer->title)->toBe('My Offer')
        ->and($offer->description)->toBe('This is my offer')
        ->and($offer->user_id)->toBe($user->id)
        ->and($offer->status)->toBe(OfferStatus::Draft);
});

it('creates a offer that should be published immediately', function () {
    // Arrange
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('offers.store'), [
            'title' => 'My Offer',
            'description' => 'This is my offer',
            'status' => OfferStatus::Published->value,
        ]);

    $response->assertStatus(201);

    // Assert
    $offer = $user->offers()->first();
    expect($offer->status)->toBe(OfferStatus::Published);
});

it('requires a title', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('offers.store'), [
            'description' => 'This is my offer',
            'status' => OfferStatus::Published->value,
        ]);

    $response->assertStatus(302)
        ->assertSessionHasErrors([
            'title' => 'The title field is required.',
        ]);
});

it('requires a description', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)
        ->post(route('offers.store'), [
            'title' => 'This is the title',
            'status' => OfferStatus::Published->value,
        ]);

    $response->assertStatus(302)
        ->assertSessionHasErrors([
            'description' => 'The description field is required.',
        ]);
});
