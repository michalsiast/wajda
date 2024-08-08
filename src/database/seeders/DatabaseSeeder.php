<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            UserSeeder::class,
            PageSeeder::class,
//            ArticleSeeder::class,
//            FieldSeeder::class,
            SiteLangSeeder::class,
            ConfigSeeder::class,
            ConstFieldSeeder::class,
            ]);
    }
}
