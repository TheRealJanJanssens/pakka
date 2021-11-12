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

        // import all migrations created by the package
        $migrations = PakkaServiceProvider::allMigrations();
        foreach ($migrations as $migration) {
            include_once __DIR__ . '/../database/migrations/'.$migration.'.php.stub';
            $className = $this->dashesToCamelCase($migration);
            (new $className())->up();
        }
    }

    public function dashesToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace(' ', '', ucwords(str_replace('_', ' ', $string)));

        if (! $capitalizeFirstCharacter) {
            $str[0] = strtolower($str[0]);
        }

        return $str;
    }
}
