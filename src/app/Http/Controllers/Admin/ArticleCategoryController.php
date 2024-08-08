<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\ArticleCategoryForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\ArticleCategoryRequest;
use App\Models\ArticleCategory;
use App\Models\Gallery;

class ArticleCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            ArticleCategory::class,
            ArticleCategoryForm::class,
            'article_category',
            true,
        );
    }

    public function show(int $id) {
        $item = ArticleCategory::with(['seo', 'gallery'])->findOrFail($id);
        $form = new ArticleCategoryForm($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.article.category.edit', compact('item', 'form', 'formSeo'));
    }

    public function edit(ArticleCategoryRequest $request)
    {
        return parent::baseEdit($request);
    }
}
