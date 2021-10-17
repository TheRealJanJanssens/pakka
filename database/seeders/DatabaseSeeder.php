<?php

namespace TheRealJanJanssens\Pakka\Database\Seeders;

use Illuminate\Database\Seeder;
use TheRealJanJanssens\Pakka\Database\Seeders\MenuSeeder;
use TheRealJanJanssens\Pakka\Database\Seeders\LanguageSeeder;
use TheRealJanJanssens\Pakka\Database\Seeders\SectionItemSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            LanguageSeeder::class,
            MenuSeeder::class,
            SectionItemSeeder::class
        ]);
    }
}
