<?php

namespace KirschbaumDevelopment\MutableListeners\Concerns;

use Illuminate\Support\Facades\Event;

trait Mutable
{
    public static function mute(string $event): void
    {
        Event::mute($event, static::class);
    }

    public static function solo(string $event): void
    {
        Event::solo($event, static::class);
    }
}
