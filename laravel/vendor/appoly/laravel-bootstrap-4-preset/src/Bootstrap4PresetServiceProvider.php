<?php
namespace Appoly\Bootstrap4Preset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class Bootstrap4PresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('bootstrap4', function ($command) {
            Bootstrap4Preset::install();
            
            $command->info('Bootstrap 4 scaffolding installed successfully.');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });

        PresetCommand::macro('bootstrap4-auth', function ($command) {
            Bootstrap4Preset::installAuth();

            $command->info('Bootstrap 4 scaffolding with Auth views installed successfully.');
            $command->comment('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }
}