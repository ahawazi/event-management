<?php

use App\Models\Conference;

it('has attributes', function () {
    expect(Conference::factory()->create())
        ->name->not->tobeNull()
        ->decisions->not->tobeNull()
        ->start_date->not->tobeNull()
        ->end_date->not->tobeNull()
        ->status->not->tobeNull()
        ->region->not->tobeNull()
        ->venue->not->tobeNull()
        ->venue_id->not->tobeNull();
});
