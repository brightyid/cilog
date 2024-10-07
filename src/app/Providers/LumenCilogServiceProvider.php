<?php

namespace Brighty\Cilog\Providers;

use Brighty\Cilog\Console\InstallCilog;
use Illuminate\Support\ServiceProvider;

class LumenCilogServiceProvider extends ServiceProvider {

    public function register() {
        $this->app->bind('cilog', function() {
            return new Cilog();
        });
        
        $this->mergeConfigFrom(
            __DIR__.'/../../config/cilog.php', 'cilog'
        );
    }

    public function boot() {
        $this->registerCommands();
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
