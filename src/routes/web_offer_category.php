<?php

use App\Models\OfferCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if(Schema::hasTable(OfferCategory::getTableName())) {
    $items = OfferCategory::with(['seo'])->active()->get();
}
else {
    $items = [];
}


Route::localized(function () use($items) {
    foreach ($items as $item) {
        if($item->seo && app()->getLocale() == $item->lang) {
            Route::get($item->seo->url, 'OfferCategoryController@show')
                ->defaults('item', $item)
                ->name('offer_category.show.'.$item->id);
        }
    }
});
