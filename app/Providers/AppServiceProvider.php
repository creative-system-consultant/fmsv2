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
        Livewire::setUpdateRoute(function ($handle) {
            return Route::post(config('app.LIVEWIRE_ASSET',null).'/livewire/update', $handle);
        });

        Livewire::setScriptRoute(function ($handle) {
            return Route::get(config('app.LIVEWIRE_ASSET',null).'/livewire/livewire.js', $handle);
        });
    }
}
