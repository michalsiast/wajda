<?php


namespace App\Http\Controllers;


use App\Helpers\SeoHelper;
use App\Models\Realization;

class RealizationController extends Controller
{
    public function show($item) {
        SeoHelper::setSeo($item->seo);

        return view('default.realization.show', compact('item'));
    }

    public function index($view) {
        $items = Realization::with([])
            ->activeAndLocale()
            ->orderByDesc('position')
            ->get();
        $view->items = $items;
    }

    public function home($view){
        $q = Realization::with([])
            ->activeAndLocale()
            ->orderByDesc('position');

        if($view->limit)
            $q->limit($view->limit);

        $items = $q->get();
        $view->items = $items;
    }
}
