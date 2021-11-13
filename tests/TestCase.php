<?php

namespace TheRealJanJanssens\Pakka\Tests;

use Barryvdh\DomPDF\ServiceProvider;
use Collective\Html\FormFacade;
use Collective\Html\HtmlServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\ExcelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;
use TheRealJanJanssens\Pakka\PakkaServiceProvider;
use TheRealJanJanssens\Pakka\Providers\HelperServiceProvider;
use TheRealJanJanssens\Pakka\Providers\MacroServiceProvider;
use Unikent\Cache\TaggableFileCacheServiceProvider;

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

    // protected function resolveApplicationHttpKernel($app)
    // {
    //   $app->singleton('Illuminate\Contracts\Http\Kernel', 'TheRealJanJanssens\Pakka\Http\Kernel\TestKernel');
    // }

    protected function getPackageProviders($app)
    {
        return [
            //ServiceProvider::class,
            //ExcelServiceProvider::class,
            //TaggableFileCacheServiceProvider::class,
            //HtmlServiceProvider::class,
            PakkaServiceProvider::class,
            //HelperServiceProvider::class,
            //MacroServiceProvider::class,
        ];
    }

    // protected function getPackageAliases($app)
    // {
    //   return [
    //     'Form' => FormFacade::class
    //   ];
    // }

    public function getEnvironmentSetUp($app)
    {
        //Credentials to setup local and git action database
        config()->set('app.key', 'base64:80bvk6/X6cFNdI5INpiNRYVgb1Vjl/XeY9GWu5BNocw=');
        config()->set('database.connections.mysql.database', 'pakka_testing');
        config()->set('database.connections.mysql.username', 'root');
        config()->set('database.connections.mysql.password', 'root');
        config()->set('database.connections.mysql.port', '8889');

        // import all migrations created by the package
        // $migrations = PakkaServiceProvider::allMigrations();
        // foreach ($migrations as $migration) {
        //     include_once __DIR__ . '/../database/migrations/'.$migration.'.php.stub';
        //     $className = $this->dashesToCamelCase($migration);
        //     (new $className())->up();
        // }
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
