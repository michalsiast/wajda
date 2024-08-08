<?php


namespace App\Http\Controllers;


use App\Forms\Admin\Admin\PageForm;
use App\Helpers\SeoHelper;
use App\Http\Requests\PageRequest;
use App\Models\Offer;
use App\Models\OfferCategory;

class OfferCategoryController extends Controller
{
    public function show($item) {
        SeoHelper::setSeo($item->seo);
        $items = Offer::with([])->where('offer_category_id', $item->id)->activeAndLocale()->orderByDesc('position')->get();
        return view('default.offer.category.show', compact('item', 'items'));
    }

    public function index($view) {
        $items = OfferCategory::with([])
            ->activeAndLocale()
            ->orderByDesc('position')
            ->get();
        $view->items = $items;
    }

    public function home($view){
        $q = OfferCategory::with([])
            ->activeAndLocale()
            ->orderByDesc('position');

        if($view->limit)
            $q->limit($view->limit);

        $items = $q->get();
        $view->items = $items;
    }
}
