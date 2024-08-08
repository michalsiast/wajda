<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\OfferCategoryForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\OfferCategoryRequest;
use App\Models\OfferCategory;
use App\Models\Gallery;

class OfferCategoryController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            OfferCategory::class,
            OfferCategoryForm::class,
            'offer_category',
            true
        );
    }

    public function show(int $id) {
        $item = OfferCategory::with(['seo', 'gallery'])->findOrFail($id);
        $form = new OfferCategoryForm($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.offer.category.edit', compact('item', 'form', 'formSeo'));
    }

    public function edit(OfferCategoryRequest $request)
    {
        return parent::baseEdit($request);
    }
}
