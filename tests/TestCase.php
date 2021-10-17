<?php

namespace TheRealJanJanssens\Pakka\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use TheRealJanJanssens\Pakka\PakkaServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // seed the database
        $this->seed("TheRealJanJanssens\\Pakka\\Database\\Seeders\\DatabaseSeeder");

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'TheRealJanJanssens\\Pakka\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );

        //Simulate pakka installation
        //$this->artisan("pakka-install");
    }

    protected function getPackageProviders($app)
    {
        return [
            PakkaServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'sqlite');
        config()->set('database.connections.sqlite.database', ':memory:');

        /*
        include_once __DIR__.'/../database/migrations/create_pakka_table.php.stub';
        (new \CreatePackageTable())->up();
        */
    }
}
