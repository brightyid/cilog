<?php

namespace Cilog\Providers;

use Cilog\Console\InstallCilog;
use Illuminate\Support\ServiceProvider;

class CilogServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('cilog', function() {
            return new Cilog();
        });
    }

    public function boot() {
        $this->publishes([
            __DIR__.'/../config/cilog.php' => config_path('cilog.php'),
        ], 'config');
    }

    protected function registerCommands(): void
    {
        $this->commands([
            InstallCilog::class,
        ]);

        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCilog::class,
        ]);
    }
}
