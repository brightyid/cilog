<?php

namespace Cilog\Providers;

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

}
