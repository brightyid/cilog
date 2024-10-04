<?php

namespace Cilog\Console;

use Illuminate\Console\Command;

class InstallCilog extends Command
{
    protected $signature = 'cilog:install';

    protected $description = 'Install the Cilog Library';

    public function handle()
    {
        $endpoint = $this->ask('What is your Cilog endpoint? (e.g. https://cilog.nasa.gov)');

        if (!$endpoint) {
            $this->error('You need to provide a valid Cilog endpoint.');
            return;
        }

        $this->info('Setting Cilog endpoint...');

        $this->setEnvValue('CILOG_ENDPOINT', $endpoint);

        $this->info('Publishing Cilog configuration...');

        $this->call('vendor:publish', [
            '--provider' => "Cilog\Providers\CilogServiceProvider",
            '--tag' => "config"
        ]);

        $this->info('Installed Cilog.');
    }

    private function setEnvValue($key, $value)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = env($key);

        if ($oldValue) {
            $str = str_replace("{$key}={$oldValue}", "{$key}={$value}", $str);
        } else {
            $str .= "\n{$key}={$value}";
        }

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}
