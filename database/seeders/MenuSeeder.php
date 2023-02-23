<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            ['menu_name_content_id' => 1, 'upper_menu_id' => 0, 'sort_order' => 0, 'url' => '/','visible' => 1,'created_user_id' => 10],
            ['menu_name_content_id' => 1, 'upper_menu_id' => 0, 'sort_order' => 1, 'url' => '/pages','visible' => 1,'created_user_id' => 10],
            ['menu_name_content_id' => 1, 'upper_menu_id' => 2, 'sort_order' => 2, 'url' => '/our-services','visible' => 1,'created_user_id' => 10],
            ['menu_name_content_id' => 1, 'upper_menu_id' => 2, 'sort_order' => 3, 'url' => '/about','visible' => 1,'created_user_id' => 10],
            ['menu_name_content_id' => 1, 'upper_menu_id' => 4, 'sort_order' => 3, 'url' => '/about-team','visible' => 0,'created_user_id' => 10],

        ];
        foreach ($menus as $menu) {
            \App\Models\Menu::Create($menu);
        }
    }
}
