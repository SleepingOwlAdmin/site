<?php

namespace App\Providers;

use App\Contracts\LocaleInterface;
use App\Locale;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(LocaleInterface::class, function($app) {
            return new Locale($app['translator']);
        });
    }
}