<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\OfferForm;
use App\Forms\Admin\RotatorForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\OfferRequest;
use App\Http\Requests\Admin\RotatorRequest;
use App\Models\Offer;
use App\Models\Gallery;
use App\Models\Rotator;

class RotatorController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            Rotator::class,
            RotatorForm::class,
            'rotator',
            false,
            false
        );
    }

    public function show(int $id) {
        $item = Rotator::with(['gallery'])->findOrFail($id);
        $form = new RotatorForm($item);

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.rotator.edit', compact('item', 'form'));
    }

    public function edit(RotatorRequest $request)
    {
        return parent::baseEdit($request);
    }
}
