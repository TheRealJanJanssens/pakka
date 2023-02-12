<?php

namespace TheRealJanJanssens\Pakka\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use TheRealJanJanssens\Pakka\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(Menu::count() == 0) {
            $defaultLocale = env('APP_LOCALE', 'nl');
            Menu::create([
                'id' => 1,
                'name' => 'Beheerpaneel',
            ]);

            $menuItems = [
                0 => [
                    'menu' => 1,
                    'position' => 1,
                    'icon' => 'ti-home',
                    'name' => 'genmen01',
                    'link' => 'dashboard',
                    'permission' => 5,
                    'translation' => [
                        'input_name' => 'name',
                        'translation_id' => 'genmen01',
                        'text' => 'Dashboard',
                        'language_code' => $defaultLocale,
                    ],
                ],
                1 => [
                    'menu' => 1,
                    'position' => 2,
                    'icon' => 'ti-user',
                    'name' => 'genmen02',
                    'link' => 'users',
                    'permission' => 10,
                    'translation' => [
                        'input_name' => 'name',
                        'translation_id' => 'genmen02',
                        'text' => 'Gebruikers',
                        'language_code' => $defaultLocale,
                    ],
                ],
                2 => [
                    'menu' => 1,
                    'position' => 3,
                    'icon' => 'ti-menu',
                    'name' => 'genmen03',
                    'link' => 'menu',
                    'permission' => 10,
                    'translation' => [
                        'input_name' => 'name',
                        'translation_id' => 'genmen03',
                        'text' => 'Menu',
                        'language_code' => $defaultLocale,
                    ],
                ],
                3 => [
                    'menu' => 1,
                    'position' => 4,
                    'icon' => 'ti-pencil-alt',
                    'name' => "genmen04",
                    'link' => 'content',
                    'permission' => 5,
                    'translation' => [
                        'input_name' => 'name',
                        'translation_id' => 'genmen04',
                        'text' => "Pagina's",
                        'language_code' => $defaultLocale,
                    ],
                ],
            ];

            foreach ($menuItems as $menuItem) {
                DB::table('translations')->insert($menuItem['translation']);
                unset($menuItem['translation']);
                DB::table('menu_items')->insert($menuItem);
            }
        }
    }
}
