<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\RealizationForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\Admin\RealizationRequest;
use App\Models\Realization;
use App\Models\Gallery;
use App\Models\Seo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $id = $request->id;
        $post = $request->post();
        $item = Realization::with(['seo'])->findOrNew($id);


        if ($request->hasFile('realization.video_path')) {

            $pdfFile = $request->file('realization.video_path');

            $path = Storage::disk('public')->put('video_item', $pdfFile);

            $post['realization']['video_path'] = $path;
        }
        if (isset($post['seo'])) {
            $rules = [];

            foreach (SeoForm::FIELDS as $name => $field) {
                $rules['seo.' . $name] = $field['rules'];
            }

            $seoId = null;
            if ($item->seo) {
                $seoId = $item->seo->id;
            }
            $rules['seo.url'][] = Rule::unique('seo')->ignore($seoId)->where('lang', getAdminLang());

            Validator::make($post, $rules)->validate();
        }
        $item->fill($post['realization']);

        if ($item->seo) {
            $item->seo()->update($post['seo']);
        } else {
            $item->seo()->associate(Seo::create($post['seo']));
        }
        $item->save();


        if ($request->exists('saveandclose')) {
            Log::info(__('admin.log.updated', ['model' => 'realization', 'id' => $item->getKey()]));
            return redirect(route('admin.realization.index'))->with('success', 'Pomyślnie zapisano zmiany.');
        } else {
            Log::info(__('admin.log.created', ['model' => 'realization', 'id' => $item->getKey()]));
            return redirect(route('admin.realization.show', $item))->with('success', 'Pomyślnie zapisano zmiany.');;
        }
    }
}
