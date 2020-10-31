<?php

namespace KirschbaumDevelopment\MutableListeners\Providers;

use Illuminate\Support\Facades\Event;
use KirschbaumDevelopment\MutableListeners\Mixin;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Event::mixin(new Mixin);
    }
}
