<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\ArticleForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\ArticleRequest;
use App\Models\Article;
use App\Models\Gallery;

class ArticleController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            Article::class,
            ArticleForm::class,
            'article',
            true,
            true
        );
    }

    public function show(int $id) {
        $item = Article::with(['seo', 'gallery'])->findOrFail($id);
        $form = new ArticleForm($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.article.edit', compact('item', 'form', 'formSeo'));
    }

    public function edit(ArticleRequest $request)
    {
        return parent::baseEdit($request);
    }
}
