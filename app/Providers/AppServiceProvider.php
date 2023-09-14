<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Livewire;
use Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.LIVEWIRE_ASSET') != ''){
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post(config('app.LIVEWIRE_ASSET','').'/livewire/update', $handle);
            });

            Livewire::setScriptRoute(function ($handle) {
                return Route::get(config('app.LIVEWIRE_ASSET','').'/livewire/livewire.js', $handle);
            });
        }
    }
}
