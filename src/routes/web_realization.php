<?php

use App\Models\Realization;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if(Schema::hasTable(Realization::getTableName())) {
    $items = Realization::with(['seo'])->active()->get();
}
else {
    $items = [];
}


Route::localized(function () use($items) {
    foreach ($items as $item) {
        if($item->seo && app()->getLocale() == $item->lang) {
            Route::get($item->seo->url, 'RealizationController@show')
                ->defaults('item', $item)
                ->name('realization.show.'.$item->id);
        }
    }
});
