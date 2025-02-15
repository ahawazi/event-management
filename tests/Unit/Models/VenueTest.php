<?php

use App\Models\Venue;

it('has attributes', function () {
    expect(Venue::factory()->create())
        ->name->not->toBeNull()
        ->city->not->toBeNull()
        ->country->not->toBeNull()
        ->postal_code->not->toBeNull()
        ->region->not->toBeNull();
});
