<?php

use App\Models\Article;
use App\Models\Offer;
use Illuminate\Support\Facades\Route;

if(Schema::hasTable(Offer::getTableName())) {
    $items = Offer::with(['seo'])->active()->get();
}
else {
    $items = [];
}


Route::localized(function () use($items) {
    foreach ($items as $item) {
        if($item->seo && app()->getLocale() == $item->lang) {
            Route::get($item->seo->url, 'OfferController@show')
                ->defaults('item', $item)
                ->name('offer.show.'.$item->id);
        }
    }
});
