<?php

use App\Models\Offer;
use App\Models\User;

it('lists only published jobs', function () {
    $user = User::factory()->create();
    $jobA = Offer::factory()->published()->create(['published_at' => now()->subDay()]);
    $jobB = Offer::factory()->published()->create();

    Offer::factory()->draft()->create();

    $response = $this->actingAs($user)
        ->get(route('offers.index'));

    $response
        ->assertOk()
        ->assertJsonCount(2)
        ->assertJson([
            ['id' => $jobB->id, 'title' => $jobB->title, 'description' => $jobB->description, 'published_at' => $jobB->published_at],
            ['id' => $jobA->id, 'title' => $jobA->title, 'description' => $jobA->description, 'published_at' => $jobA->published_at],
        ]);
});
