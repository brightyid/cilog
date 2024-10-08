<?php

namespace Brighty\Cilog\Providers;

use Brighty\Cilog\Console\InstallCilog;
use Illuminate\Support\ServiceProvider;

class CilogServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('cilog', function() {
            return new Cilog();
        });
        
        $this->mergeConfigFrom(
            __DIR__.'/../../config/cilog.php', 'cilog'
        );

        $this->registerCommands();
    }

    public function boot() {
        $this->publishes([
            __DIR__.'/../../config/cilog.php' => base_path('config/cilog.php'),
        ], 'config');
    }

    protected function registerCommands(): void
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            InstallCilog::class,
        ]);
    }
}
