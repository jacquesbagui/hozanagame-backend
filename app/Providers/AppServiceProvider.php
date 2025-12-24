<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Force HTTP en local pour éviter les problèmes avec Herd
        if (app()->environment('local')) {
            URL::forceScheme('http');

            // Aussi forcer l'URL de base en HTTP si elle est en HTTPS
            if (str_starts_with(config('app.url'), 'https://')) {
                $url = str_replace('https://', 'http://', config('app.url'));
                config(['app.url' => $url]);
            }
        }
    }
}
