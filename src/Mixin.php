<?php

namespace KirschbaumDevelopment\MutableListeners;

use Closure;
use ReflectionFunction;

class Mixin
{
    public function mute(): Closure
    {
        return function (string $event, string $listener) {
            collect(data_get($this->listeners, $event, []))->each(function ($closure, $index) use ($event, $listener) {
                $use = match(gettype($closure)) {
                    'string' => $listener,
                    'object' => match(get_class($closure)) {
                        Closure::class => data_get((new ReflectionFunction($closure))->getClosureUsedVariables(), 'listener'),
                        default => null
                    },
                };

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
                $use = match(gettype($closure)) {
                    'string' => $listener,
                    'object' => match(get_class($closure)) {
                        Closure::class => data_get((new ReflectionFunction($closure))->getClosureUsedVariables(), 'listener'),
                        default => null
                    },
                };

                if ($use === null || $use instanceof Closure || $use === $listener) {
                    return;
                }

                unset($this->listeners[$event][$index]);
            });
        };
    }
}
