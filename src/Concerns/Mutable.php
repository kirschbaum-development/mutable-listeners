<?php

namespace KirschbaumDevelopment\MutableListeners\Concerns;

use Illuminate\Support\Facades\Event;

trait Mutable
{
    /**
     * Mute an event listener in the dispatcher.
     *
     * @param string $event
     *
     * @return void
     */
    public static function mute(string $event)
    {
        Event::mute($event, static::class);
    }
}
