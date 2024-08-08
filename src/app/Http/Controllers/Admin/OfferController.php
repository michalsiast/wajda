<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\OfferForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\OfferRequest;
use App\Models\Offer;
use App\Models\Gallery;

class OfferController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            Offer::class,
            OfferForm::class,
            'offer',
            true,
            true
        );
    }

    public function show(int $id) {
        $item = Offer::with(['seo', 'gallery'])->findOrFail($id);
        $form = new OfferForm($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.offer.edit', compact('item', 'form', 'formSeo'));
    }

    public function edit(OfferRequest $request)
    {
        return parent::baseEdit($request);
    }
}
