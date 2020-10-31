<?php

namespace Tests;

use Illuminate\Support\Facades\Event;
use KirschbaumDevelopment\MutableListeners\Concerns\Mutable;

class MuteListenerTest extends TestCase
{
    public function testMuteMacroIsRegisteredOnEvent()
    {
        $this->assertTrue(
            Event::hasMacro('mute')
        );
    }

    public function testListenerCanBeMuted()
    {
        $this->registerListeners();
        Event::mute(Halloween::class, Tricks::class);

        event(new Halloween());

        $this->assertEquals(
            '🍭🍬',
            cache()->get(Treats::class)
        );

        $this->assertEmpty(
            cache()->get(Tricks::class)
        );
    }

    public function testMutableTrait()
    {
        $this->registerListeners();
        Tricks::mute(Halloween::class);

        event(new Halloween());

        $this->assertEquals(
            '🍭🍬',
            cache()->get(Treats::class)
        );

        $this->assertEmpty(
            cache()->get(Tricks::class)
        );
    }

    /**
     * Register the listener.
     *
     * @return void
     */
    protected function registerListeners()
    {
        Event::listen(Halloween::class, Treats::class);
        Event::listen(Halloween::class, Tricks::class);
    }
}

class Treats
{
    public function handle(Halloween $event)
    {
        cache()->put(static::class, '🍭🍬');
    }
}

class Tricks
{
    use Mutable;

    public function handle(Halloween $event)
    {
        cache()->put(static::class, '👻🧙💀');
    }
}

class Halloween
{
}
