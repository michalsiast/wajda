<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Field::class, 10)->create();

        $items = \App\Models\Field::with([])
            ->get();

        foreach ($items as $item) {
            $item->position = $item->getKey();
            $item->save();
        }
    }
}
