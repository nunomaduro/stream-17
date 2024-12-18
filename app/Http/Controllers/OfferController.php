<?php

namespace App\Http\Controllers;

use App\Actions\CreateOffer;
use App\Enums\OfferStatus;
use App\Http\Requests\CreateOfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OfferController
{
    public function index(): array
    {
        $offers = Offer::query()
            ->where('status', OfferStatus::Published)
            ->orderByDesc('published_at')
            ->get();

        return $offers->map(fn (Offer $offer) => [
            'id' => $offer->id,
            'title' => $offer->title,
            'description' => $offer->description,
            'published_at' => $offer->published_at->format('Y-m-d H:i:s'),
        ])->all();
    }

    public function store(CreateOfferRequest $request, CreateOffer $action): Response
    {
        $action->handle(
            $request->user(),
            $request->enum('status', OfferStatus::class),
            $request->string('title'),
            $request->string('description'),
        );

        return response(status: 201);
    }
}
