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

        event(new Halloween);

        $this->assertEquals(
            '🍭🍬',
            cache()->get(Treats::class)
        );

        $this->assertEquals(
            '👃🏼🦶🏼',
            cache()->get(SmellyFeet::class)
        );


        $this->assertEmpty(
            cache()->get(Tricks::class)
        );
    }

    public function testMutableTraitMute()
    {
        $this->registerListeners();
        Tricks::mute(Halloween::class);

        event(new Halloween);

        $this->assertEquals(
            '🍭🍬',
            cache()->get(Treats::class)
        );

        $this->assertEquals(
            '👃🏼🦶🏼',
            cache()->get(SmellyFeet::class)
        );


        $this->assertEmpty(
            cache()->get(Tricks::class)
        );
    }

    public function testSoloMacroIsRegisteredOnEvent()
    {
        $this->assertTrue(
            Event::hasMacro('solo')
        );
    }

    public function testListenerCanBeSolo()
    {
        $this->registerListeners();
        Event::solo(Halloween::class, Tricks::class);

        event(new Halloween);

        $this->assertEmpty(
            cache()->get(Treats::class)
        );

        $this->assertEmpty(
            cache()->get(SmellyFeet::class)
        );


        $this->assertEquals(
            '👻🧙💀',
            cache()->get(Tricks::class)
        );
    }

    public function testMutableTraitSolo()
    {
        $this->registerListeners();
        Tricks::solo(Halloween::class);

        event(new Halloween);

        $this->assertEmpty(
            cache()->get(Treats::class)
        );

        $this->assertEmpty(
            cache()->get(SmellyFeet::class)
        );

        $this->assertEquals(
            '👻🧙💀',
            cache()->get(Tricks::class)
        );
    }

    protected function registerListeners()
    {
        Event::listen(Halloween::class, Tricks::class);
        Event::listen(Halloween::class, Treats::class);
        Event::listen(Halloween::class, SmellyFeet::class);
    }
}

class Tricks
{
    use Mutable;

    public function handle()
    {
        cache()->put(static::class, '👻🧙💀');
    }
}

class Treats
{
    public function handle()
    {
        cache()->put(static::class, '🍭🍬');
    }
}

class SmellyFeet
{
    public function handle()
    {
        cache()->put(static::class, '👃🏼🦶🏼');
    }
}

class Halloween
{
}
