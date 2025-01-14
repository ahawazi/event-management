<?php

use App\Models\User;

it('has attributes', function () {
    expect(User::factory()->make())
        ->name->not->toBeNull()
        ->email->not->toBeNull()
        ->password->not->toBeNull();
});
