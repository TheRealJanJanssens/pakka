<?php

namespace TheRealJanJanssens\Pakka\Tests;

// use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

// abstract class TestCase extends BaseTestCase
// {
//     use CreatesApplication;
// }



use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Orchestra\Testbench\TestCase as Orchestra;
use TheRealJanJanssens\Pakka\PakkaServiceProvider;
use TheRealJanJanssens\Pakka\Providers\HelperServiceProvider;

class TestCase extends Orchestra
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // seed the database
        // $this->seed("TheRealJanJanssens\\Pakka\\Database\\Seeders\\DatabaseSeeder");

        // Factory::guessFactoryNamesUsing(
        //     fn (string $modelName) => 'TheRealJanJanssens\\Pakka\\Database\\Factories\\'.class_basename($modelName).'Factory'
        // );
    }

    protected function getPackageProviders($app)
    {
        return [
            PakkaServiceProvider::class,
            HelperServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        //Credentials to setup local and git action database
        // config()->set('app.key', 'base64:80bvk6/X6cFNdI5INpiNRYVgb1Vjl/XeY9GWu5BNocw=');
        // config()->set('database.connections.mysql.database', 'pakka_testing');
        // config()->set('database.connections.mysql.username', 'root');
        // config()->set('database.connections.mysql.password', 'root');
        // config()->set('database.connections.mysql.port', '8889');
        // config()->set('database.connections.mysql.strict', 'false');

        //Route middleware
        $app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware('Illuminate\Session\Middleware\StartSession');

        //import all migrations created by the package
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
