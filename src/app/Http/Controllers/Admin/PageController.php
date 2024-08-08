<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\PageForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Field;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Rotator;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PageController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            Page::class,
            PageForm::class,
            'page',
            true,
        );
    }


    public function show(int $id) {
        $item = Page::with(['seo', 'gallery'])->findOrFail($id);
        $form = new PageForm($item);
        $formSeo = null;

        $rotators = Rotator::with([])
            ->adminLocale()
            ->orderBy('position', 'desc')
            ->get();

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        if(!$item->gallery) {
            $item->gallery()->associate(Gallery::create());
            $item->save();
        }

        return view('admin.page.edit', compact('item', 'form', 'formSeo', 'rotators'));
    }


    public function edit(PageRequest $request)
    {
        $fields = $request->post('field');

        if($fields) {
            foreach ($fields as $key=>$value) {
                Field::with([])
                    ->where('page_id', $request->id)
                    ->where('name', $key)
                    ->update([
                        'value' => $value
                    ]);
            }
        }

        return parent::baseEdit($request);
    }
}
