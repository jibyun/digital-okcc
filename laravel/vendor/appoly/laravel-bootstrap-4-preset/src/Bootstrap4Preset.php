<?php

namespace Appoly\Bootstrap4Preset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class Bootstrap4Preset extends Preset
{
    public static function install()
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapJs();
        static::removeNodeModules();
    }

    public static function installAuth()
    {
        static::install();
        static::scaffoldAuth();
    }

    protected static function updatePackageArray(array $packages)
    {
        return [
            'bootstrap' => '^4.0.0',
            'popper.js' => '^1.12.9',
            'jquery' => '^3.2.1',
        ] + Arr::except($packages, ['bootstrap-sass', 'jquery']);
    }

    protected static function updateStyles()
    {
        (new Filesystem)->deleteDirectory(resource_path('assets/sass'));
        (new Filesystem)->delete(public_path('js/app.js'));
        (new Filesystem)->delete(public_path('css/app.css'));

        if (! file_exists(resource_path('assets/sass'))) {
            mkdir(resource_path('assets/sass'));
        }
        
        copy(__DIR__ . '/stubs/_custom.scss', resource_path('assets/sass/_custom.scss'));
        copy(__DIR__ . '/stubs/app.scss', resource_path('assets/sass/app.scss'));
    }

    protected static function updateBootstrapJs()
    {
        (new Filesystem)->delete(resource_path('assets/js/bootstrap.js'));
        copy(__DIR__ . '/stubs/bootstrap.js', resource_path('assets/js/bootstrap.js'));
    }

    protected static function scaffoldAuth()
    {
        file_put_contents(app_path('Http/Controllers/HomeController.php'), static::compileControllerStub());

        file_put_contents(
            base_path('routes/web.php'),
            "Auth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n\n",
            FILE_APPEND
        );

        (new Filesystem)->copyDirectory(__DIR__.'/stubs/views', resource_path('views')); 
    }

    protected static function compileControllerStub()
    {
        return str_replace(
            '{{namespace}}',
            Container::getInstance()->getNamespace(),
            file_get_contents(__DIR__.'/stubs/Controllers/HomeController.stub')
        );
    }

}