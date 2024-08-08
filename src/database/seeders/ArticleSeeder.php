<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Article::class, 25)->create();

        $items = \App\Models\Article::with([])
            ->get();

        foreach ($items as $item) {
            $item->position = $item->getKey();
            $item->save();
        }
    }
}
