<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\RealizationCategoryForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\RealizationCategoryRequest;
use App\Models\RealizationCategory;
use App\Models\Gallery;

class RealizationCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            RealizationCategory::class,
            RealizationCategoryForm::class,
            'realization_category',
            true
        );
    }

    public function show(int $id) {
        $item = RealizationCategory::with(['seo', 'gallery'])->findOrFail($id);
        $form = new RealizationCategoryForm($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.realization.category.edit', compact('item', 'form', 'formSeo'));
    }

    public function edit(RealizationCategoryRequest $request)
    {
        return parent::baseEdit($request);
    }
}
