<?php

namespace Mitake\Laravel;

use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Foundation\Application as LaravelApplication;
use Illuminate\Support\ServiceProvider;
use Laravel\Lumen\Application as LumenApplication;
use Mitake\Client;

class MitakeServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application service
     *
     * @return void
     */
    public function boot()
    {
        $dist = __DIR__ . '/../config/mitake.php';

        if ($this->app instanceof LaravelApplication && $this->app->runningInConsole()) {
            $this->publishes([$dist => config_path('mitake.php')]);
        } elseif ($this->app instanceof LumenApplication) {
            $this->app->configure('mitake');
        }

        $this->mergeConfigFrom($dist, 'mitake');
    }

    /**
     * Register bindings in the container
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Client::class, function ($app) {
            return $this->createMitakeClient($app['config']);
        });
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return [Client::class];
    }

    /**
     * @param Config $config
     *
     * @return Client
     */
    protected function createMitakeClient(Config $config)
    {
        $options = $config->get('mitake');

        return new Client($options['username'], $options['password']);
    }
}
