<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
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
        DB::table('menus')->insert([
            'name' => 'nasi goreng',
            'id_category' => 1,
            'price' => 14000
        ]);
        DB::table('menus')->insert([
            'name' => 'nasi ayam',
            'id_category' => 1,
            'price' => 14000
        ]);
        DB::table('menus')->insert([
            'name' => 'nasi telur',
            'id_category' => 1,
            'price' => 14000
        ]);
    }
}
