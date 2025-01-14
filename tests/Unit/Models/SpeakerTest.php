<?php

use App\Models\Speaker;

it('has attributes', function () {
    expect(Speaker::factory()->create())
        ->name->not->toBeNull()
        ->email->not->toBeNull()
        ->bio->not->toBeNull()
        ->twitter_handle->not->toBeNull();
});
