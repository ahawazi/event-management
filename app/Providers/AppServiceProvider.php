<?php

namespace App\Providers;

use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Model::unguard();

        CreateAction::configureUsing(function ($action) {
            return $action->slideOver();
        });
    }
}
