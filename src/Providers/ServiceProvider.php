<?php

namespace KirschbaumDevelopment\MutableListeners\Providers;

use Illuminate\Support\Facades\Event;
use KirschbaumDevelopment\MutableListeners\Mixin;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{
    public function boot(): void
    {
        Event::mixin(new Mixin);
    }
}
