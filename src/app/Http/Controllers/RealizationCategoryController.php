<?php


namespace App\Http\Controllers;


use App\Helpers\SeoHelper;
use App\Http\Requests\PageRequest;
use App\Models\Realization;
use App\Models\RealizationCategory;

class RealizationCategoryController extends Controller
{
    public function show($item) {
        SeoHelper::setSeo($item->seo);
        $items = Realization::with([])->where('realization_category_id', $item->id)->activeAndLocale()->orderByDesc('position')->get();
        return view('default.realization.category.show', compact('item', 'items'));
    }

    public function index($view) {
        $items = RealizationCategory::with([])
            ->activeAndLocale()
            ->orderByDesc('position')
            ->get();
        $view->items = $items;
    }

    public function home($view){
        $q = RealizationCategory::with([])
            ->activeAndLocale()
            ->orderByDesc('position');

        if($view->limit)
            $q->limit($view->limit);

        $items = $q->get();
        $view->items = $items;
    }
}
