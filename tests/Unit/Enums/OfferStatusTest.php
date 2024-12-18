<?php

use App\Enums\OfferStatus;

test('all cases have a label', function () {
    collect(OfferStatus::cases())->each(function (OfferStatus $case) {
        expect($case->label())->toBeString();
    });
});
