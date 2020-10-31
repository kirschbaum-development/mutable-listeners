<?php

namespace KirschbaumDevelopment\MutableListeners;

use Closure;
use Opis\Closure\ReflectionClosure;
use Illuminate\Support\Facades\Event;

class Mixin
{
    /**
     * Mute an event listener in the dispatcher.
     *
     * @return callback
     */
    public function mute()
    {
        return function (string $event, string $listener) {
            collect(data_get($this->listeners, $event, []))->each(function ($closure, $index) use ($event, $listener) {
                $reflection = new ReflectionClosure($closure);

                $use = data_get($reflection->getUseVariables(), 'listener');

                if ($use === null || $use instanceof Closure || $use !== $listener) {
                    return;
                }

                unset($this->listeners[$event][$index]);
            });
        };
    }
}
