# mitake-laravel

[![Build Status](https://travis-ci.org/minchao/mitake-laravel.svg?branch=master)](https://travis-ci.org/minchao/mitake-laravel)
[![Latest Stable Version](https://poser.pugx.org/minchao/mitake-laravel/v/stable)](https://packagist.org/packages/minchao/mitake-laravel)
[![Latest Unstable Version](https://poser.pugx.org/minchao/mitake-laravel/v/unstable)](https://packagist.org/packages/minchao/mitake-laravel)
[![composer.lock](https://poser.pugx.org/minchao/mitake-laravel/composerlock)](https://packagist.org/packages/minchao/mitake-laravel)

This is a simple Laravel service provider for making it easy to access the [Mitake PHP SDK](https://github.com/minchao/mitake-php) in your Laravel and Lumen applications.

## Installation

The Mitake service provider can be installed via [Composer](https://getcomposer.org/).

```
composer require minchao/mitake-laravel
``` 

To use the Mitake service provider, you must register the provider when bootstrapping your application.

### Laravel

#### Laravel 5.5 and above

The package will automatically register provider and facade.

#### Laravel 5.4 and below

Add `Mitake\Laravel\MitakeServiceProvider` to the `providers` section of your `config/app.php`:

```php
    'providers' => [
        // ...
        Mitake\Laravel\MitakeServiceProvider::class,
    ];
```

Add Mitake facade to the `aliases` section of your `config/app.php`:

```php
    'aliases' => [
        // ...
        'Mitake' => Mitake\Laravel\Facade\Mitake::class,
    ];
```

Or use the facade class directly:

```php
use Mitake\Laravel\Facade\Mitake;
```

### Lumen

Register the `Mitake\Laravel\MitakeServiceProvider` in your `bootstrap/app.php`:

```php
    $app->register(Mitake\Laravel\MitakeServiceProvider::class);
```

## Configuration

Publish the package configuration using Artisan.

```
php artisan vendor:publish --provider="Mitake\Laravel\MitakeServiceProvider"
```

Then update `config/mitake.php` with your credentials. Alternatively, you can update your `.env` file.

```
MITAKE_USERNAME=username
MITAKE_PASSWORD=password
```

## Usage

To use the Mitake SDK within your app, you need to retrieve it from the service container:

```php
$mitake = app(\Mitake\Client::class);

$message = (new \Mitake\Message\Message())
    ->setDstaddr('0987654321')
    ->setSmbody('Hello, Laravel IoC Container');
$result = $mitake->send($message);
```

Or, you can use the Mitake facade:

```php
$message = (new \Mitake\Message\Message())
    ->setDstaddr('0987654321')
    ->setSmbody('Hello, Facade');
$result = Mitake::send($message);
```

## License

See the [LICENSE](LICENSE) file for license rights and limitations (BSD 3-Clause).
