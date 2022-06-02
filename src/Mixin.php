<?php

namespace KirschbaumDevelopment\MutableListeners;

use Closure;
use Opis\Closure\ReflectionClosure;

class Mixin
{
    public function mute(): Closure
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

    public function solo(): Closure
    {
        return function (string $event, string $listener) {
            collect(data_get($this->listeners, $event, []))->each(function ($closure, $index) use ($event, $listener) {
                $reflection = new ReflectionClosure($closure);

                $use = data_get($reflection->getUseVariables(), 'listener');

                if ($use === null || $use instanceof Closure || $use === $listener) {
                    return;
                }

                unset($this->listeners[$event][$index]);
            });
        };
    }
}
