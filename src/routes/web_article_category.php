<?php

use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;

if(Schema::hasTable(ArticleCategory::getTableName())) {
    $items = ArticleCategory::with(['seo'])->active()->get();
}
else {
    $items = [];
}


Route::localized(function () use($items) {
    foreach ($items as $item) {
        if($item->seo && app()->getLocale() == $item->lang) {
            Route::get($item->seo->url, 'ArticleCategoryController@show')
                ->defaults('item', $item)
                ->name('article_category.show.'.$item->id);
        }
    }
});
