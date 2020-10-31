# Laravel Mutable Listeners

A package for unregistering Listeners from Events in Laravel!

## Installation

You can install this package via composer:

```bash
composer require kirschbaum-development/mutable-listeners
```

## Usage
`Halloween` is full of `Tricks` and `Treats`:

```
class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Halloween::class => [
            Tricks::class,
            Treats::class,
        ]
    ];
}
```

What if you could could get all the chocolatery without any of the chicanery?

### Event Facade
```php
Event::mute(Halloween::class, Tricks::class);
```

### Mutable Trait
A trait can also be added to a `Listener` for simplified muting:
```php
use KirschbaumDevelopment\MutableListeners\Mutable;

class Tricks
{
    use Mutable;

    // ...
}

Tricks::mute(Halloween::class);
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email justin@kirschbaumdevelopment.com or nathan@kirschbaumdevelopment.com instead of using the issue tracker.

## Credits

- [Justin Seliga](https://github.com/jrseliga)
- [Bogdan Cismariu](https://github.com/bcismariu)

## Sponsorship

Development of this package is sponsored by Kirschbaum Development Group, a developer driven company focused on problem solving, team building, and community. Learn more [about us](https://kirschbaumdevelopment.com/team) or [join us](https://careers.kirschbaumdevelopment.com/careers)!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
