<?php


namespace App\Http\Controllers;


use App\Helpers\SeoHelper;
use App\Models\Article;
use App\Models\ArticleCategory;

class ArticleCategoryController extends Controller
{
    public function show($item) {
        SeoHelper::setSeo($item->seo);
        $items = Article::with([])->where('article_category_id', $item->id)->activeAndLocale()->orderByDesc('position')->get();
        return view('default.article.category.show', compact('item', 'items'));
    }

    public function index($view) {
        $items = ArticleCategory::with([])
            ->activeAndLocale()
            ->orderByDesc('position')
            ->get();
        $view->items = $items;
    }

    public function home($view){
        $q = ArticleCategory::with([])
            ->activeAndLocale()
            ->orderByDesc('position');

        if($view->limit)
            $q->limit($view->limit);

        $items = $q->get();
        $view->items = $items;
    }
}
