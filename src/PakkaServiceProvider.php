<?php

namespace TheRealJanJanssens\Pakka;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TheRealJanJanssens\Pakka\Commands\ShowTextCommand;

class PakkaServiceProvider extends PackageServiceProvider
{
    public function bootingPackage()
    {
        // Load the helpers in app/Http/helpers.php
        if (file_exists($file = __DIR__.'/helpers.php')) {
            require $file;
        }

        if (file_exists($file = __DIR__.'/Macros/form.php')) {
            require $file;
        }

        $this->publishes([
            // Config
            __DIR__.'/../config/database.php' => config_path('database.php'),
            __DIR__.'/../config/pakka.php' => config_path('pakka.php'),

            // NPM json
            __DIR__.'/../resources/dev/package.json' => base_path('package.json'),

            // Webpack Mix
             __DIR__.'/../resources/dev/webpack.mix.js' => public_path('../webpack.mix.js'),

            // Middleware
            __DIR__.'/../src/Http/Middleware' => app_path('Http/Middleware'),

            // Kernel
            __DIR__.'/../src/Http/Kernel/Kernel.php' => app_path('Http/Kernel.php'),

            // Storage Assets
            __DIR__.'/../storage/analytics' => storage_path('app/analytics'),
            __DIR__.'/../storage/fonts' => storage_path('fonts'),

            // Public Assets
            __DIR__.'/../resources/dist/css' => public_path('vendor/css'),
            __DIR__.'/../resources/dist/js' => public_path('vendor/js'),
            __DIR__.'/../resources/dist/images' => public_path('vendor/images'),
            __DIR__.'/../resources/dist/fonts' => public_path('vendor/fonts'),
        ], 'pakka');

        // $this->publishes([
        //     // Composer.json for pakka dev
        //     __DIR__.'/../resources/dev/composer.json' =>  public_path('../composer.json'),
            
        //     // Webpack Mix
        //     __DIR__.'/../resources/dev/webpack.mix.js' => public_path('../webpack.mix.js'),

        //     // Dev Assets
        //     __DIR__.'/../resources/js' => resource_path('pakka/js'),
        //     __DIR__.'/../resources/sass' => resource_path('pakka/sass'),

        // ], 'pakka-dev');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pakka')
            ->hasViews()
            ->hasConfigFile()
            ->hasTranslations()
            ->hasRoute('web')
            //->hasMigration('create_pakka_table')
            ->hasCommands([
                ShowTextCommand::class,
            ]);
    }
}
