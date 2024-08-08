<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageType;
use App\Models\Seo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        foreach (['pl', 'en'] as $lang) {
//            $seo = \App\Models\Seo::create([
//                'url' => '/',
//                'title' => 'Home '.$lang,
//                'description' => 'Home description '.$lang,
//                'lang' => $lang,
//            ]);
//
//            \App\Models\Page::create([
//                'seo_id' => $seo->getKey(),
//                'name' => 'Home '.$lang,
//                'type' => \App\Models\PageType::INDEX_SHOW['name'],
//                'lang' => $lang,
//                'active' => true,
//            ]);
//        }


//        factory(\App\Models\Page::class, 3)->create();
//        Page::factory()
//            ->times(3)
//            ->create();

//        $items = \App\Models\Page::with([])
//            ->get();
//
//        foreach ($items as $item) {
//            $item->position = $item->getKey();
//            $item->save();
//        }

        $pages = [
            [
                'name' => 'Strona główna',
                'title' => 'Strona główna',
                'type' => 'index.show',
                'lang' => 'pl',
            ],
//            [
//                'name' => 'Artykuły',
//                'title' => 'Artykuły',
//                'type' => 'article.index',
//                'lang' => 'pl',
//            ],
//            [
//                'name' => 'O nas',
//                'title' => 'O nas',
//                'type' => 'about-us.show',
//                'lang' => 'pl',
//            ],
            [
                'name' => 'Home',
                'title' => 'Home',
                'type' => 'index.show',
                'lang' => 'en',
            ],
//            [
//                'name' => 'Artykuły',
//                'title' => 'Artykuły',
//                'type' => 'article.index',
//                'lang' => 'en',
//            ],
//            [
//                'name' => 'About us',
//                'title' => 'About us',
//                'type' => 'about-us.show',
//                'lang' => 'en',
//            ],
        ];

        foreach ($pages as $page) {
            $url = $page['type'] == 'index.show' ? '/' : '/'.Str::slug($page['name']);
            $seo = Seo::create([
                'url' => $url,
                'title' => $page['title'],
                'lang' => $page['lang'],
            ]);

            $page = Page::create([
                'seo_id' => $seo->getKey(),
                'name' => $page['name'],
                'type' => $page['type'],
                'lang' => $page['lang'],
                'active' => true,
            ]);

            $page->position = $page->getKey();
            $page->save();
        }
    }
}
