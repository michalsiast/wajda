<?php

namespace Database\Seeders;

use App\Models\SiteLang;
use Illuminate\Database\Seeder;

class SiteLangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteLang::create([
            'name' => 'en',
            'full_name' => 'English',
        ]);
        SiteLang::create([
            'name' => 'pl',
            'full_name' => 'Polish',
            'active' => true,
            'default_site' => true,
            'default_admin' => true,
        ]);

        $items = SiteLang::with([])
            ->get();

        foreach ($items as $item) {
            $item->position = $item->getKey();
            $item->save();
        }
    }
}
