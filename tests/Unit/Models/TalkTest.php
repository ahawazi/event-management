<?php

use App\Models\Talk;

it('has attributes', function () {
    expect(Talk::factory()->make())
        ->title->not->toBeNull()
        ->abstract->not->toBeNull()
        ->speaker_id->not->toBeNull()
        ->length->not->toBeNull()
        ->status->not->toBeNull()
        ->new_talk->not->toBeNull();
});
