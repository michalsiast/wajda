<?php

use App\Models\Page;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if(Schema::hasTable(Page::getTableName())) {
    $items = Page::with(['seo'])->active()->get();
}
else {
    $items = [];
}


Route::localized(function () use($items) {
    foreach ($items as $item) {
        if($item->seo && app()->getLocale() == $item->lang) {
            Route::get($item->seo->url, 'PageController@show')
                ->defaults('item', $item)
                ->name($item->type);
        }
    }
});
