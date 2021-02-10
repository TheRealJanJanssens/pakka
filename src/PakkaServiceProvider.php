<?php

namespace TheRealJanJanssens\Pakka;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use TheRealJanJanssens\Pakka\Commands\PakkaCommand;

class PakkaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('pakka')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_pakka_table')
            ->hasCommand(PakkaCommand::class);
    }
}
