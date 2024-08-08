<?php

use App\Models\RealizationCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if(Schema::hasTable(RealizationCategory::getTableName())) {
    $items = RealizationCategory::with(['seo'])->active()->get();
}
else {
    $items = [];
}


Route::localized(function () use($items) {
    foreach ($items as $item) {
        if($item->seo && app()->getLocale() == $item->lang) {
            Route::get($item->seo->url, 'RealizationCategoryController@show')
                ->defaults('item', $item)
                ->name('realization_category.show.'.$item->id);
        }
    }
});
