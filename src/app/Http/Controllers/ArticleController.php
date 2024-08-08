<?php


namespace App\Http\Controllers;


use App\Helpers\SeoHelper;
use App\Models\Article;

class ArticleController extends Controller
{
    public function show($item) {
        SeoHelper::setSeo($item->seo);

        return view('default.article.show', compact('item'));
    }

    public function index($view) {
        $items = Article::with([])
            ->activeAndLocale()
            ->orderByDesc('position')
            ->get();
        $view->items = $items;
    }

    public function home($view){
        $q = Article::with([])
            ->activeAndLocale()
            ->orderByDesc('position');

        if($view->limit)
            $q->limit($view->limit);

        $items = $q->get();
        $view->items = $items;
    }
}
