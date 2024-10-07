<?php

namespace Brighty\Cilog\Console;

use Illuminate\Console\Command;

class InstallCilog extends Command
{
    protected $signature = 'cilog:install {--lumen : Install for Lumen}';

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
        
        if ($this->option('lumen')) {
            $configFile = app()->basePath('config/cilog.php');
            if (!file_exists($configFile)) {
                if (!is_dir(app()->basePath('config'))) {
                    mkdir(app()->basePath('config'));
                }
                
                $file = "<?php\n\nreturn [\n    'endpoint' => env('CILOG_ENDPOINT'),\n];\n";
                file_put_contents($configFile, $file);
            }
        } else {
            $this->call('vendor:publish', [
                '--provider' => 'Brighty\Cilog\Providers\CilogServiceProvider',
                '--tag' => 'config',
            ]);
        }
        
        $this->info('Installed Cilog.');
    }

    private function setEnvValue($key, $value)
    {
        if ($this->option('lumen')) {
            $envFile = app()->basePath('.env');
        } else {
            $envFile = app()->environmentFilePath();
        }
        
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
