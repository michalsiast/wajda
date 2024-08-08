<?php


namespace App\Http\Controllers;


use App\Helpers\SeoHelper;
use App\Models\Offer;

class OfferController extends Controller
{
    public function show($item) {
        SeoHelper::setSeo($item->seo);

        return view('default.offer.show', compact('item'));
    }

    public function index($view) {
        $items = Offer::with([])
            ->activeAndLocale()
            ->orderByDesc('position')
            ->get();
        $view->items = $items;
    }

    public function home($view){
        $q = Offer::with([])
            ->activeAndLocale()
            ->orderByDesc('position');

        if($view->limit)
            $q->limit($view->limit);

        $items = $q->get();
        $view->items = $items;
    }

}
