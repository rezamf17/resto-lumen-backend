<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\MenuSeeder;
use Database\Seeders\ImageSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ImageSeeder::class);
        DB::table('users')->insert([
            [
            'name' => 'reza pangestu gaming',
            'email' => 'reza@gmail.com',
            'level' => 'super-admin',
            'id_image' => 1,
            'password' => Hash::make('123'),
            ],
            [
                'name' => 'z',
                'email' => 'z@gmail.com',
                'level' => 'admin',
                'id_image' => 1,
                'password' => Hash::make('123'),
            ]
        ]);
        $this->call(CategorySeeder::class);
        $this->call(MenuSeeder::class);
    }
}
