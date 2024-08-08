<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\RealizationForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\RealizationRequest;
use App\Models\Realization;
use App\Models\Gallery;

class RealizationController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            Realization::class,
            RealizationForm::class,
            'realization',
            true,
            true
        );
    }

    public function show(int $id) {
        $item = Realization::with(['seo', 'gallery'])->findOrFail($id);
        $form = new RealizationForm($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.realization.edit', compact('item', 'form', 'formSeo'));
    }

    public function edit(RealizationRequest $request)
    {
        return parent::baseEdit($request);
    }
}
