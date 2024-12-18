<?php

namespace Database\Factories;

use App\Enums\OfferStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'status' => OfferStatus::Draft,
            'published_at' => null,
            'archived_at' => null,
        ];
    }

    public function draft(): static
    {
        return $this->state([
            'status' => OfferStatus::Draft,
        ]);
    }

    public function published(): static
    {
        return $this->state([
            'status' => OfferStatus::Published,
            'published_at' => now(),
        ]);
    }

    public function archived(): static
    {
        return $this->state([
            'status' => OfferStatus::Archived,
            'archived_at' => now(),
        ]);
    }
}
