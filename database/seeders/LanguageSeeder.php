<?php

namespace TheRealJanJanssens\Pakka\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('languages')->insert([
            array("id" => 1, "language_code" => "nl", "name" => "Nederlands")
        ]);
    }
}
