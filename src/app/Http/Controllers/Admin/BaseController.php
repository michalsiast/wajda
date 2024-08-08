<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\SeoForm;
use App\Models\GalleryItem;
use App\Models\Seo;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class BaseController
{
    private $class = null;
    private $form = null;
    private $moduleName = '';
    private $moduleView = '';
    private $seo = false;
    private $paginateLimit = 20;
    private $hasCategoryRelation = false;

    public function __construct($class, $form, $moduleName, $seo = false, $hasCategoryRelation = false, $paginateLimit = 100)
    {
        $this->class = $class;
        $this->form = $form;
        $this->moduleName = $moduleName;
        $this->moduleView = $this->getModuleView($moduleName);
        $this->seo = $seo;
        $this->hasCategoryRelation = $hasCategoryRelation;
        $this->paginateLimit = $paginateLimit;
    }

    // GETTERS
    public function index() {
        $relations = [];

        if($this->seo)
            $relations = ['seo'];

            $q = $this->class::with($relations)
            ->adminLocale()
            ->orderBy('position', 'desc');



        if($searchId = request()->get('category')){
            $q->where($this->moduleName.'_category_id', $searchId);
        }

        $items = $q->paginate($this->paginateLimit);

        $categories = [];
        if($this->hasCategoryRelation){
            $categories = DB::table($this->moduleName.'_category')->get();
            foreach ($items->getCollection() as $item){
                $item->category = $categories->where('id', $item[$this->moduleName.'_category_id'])->first();
            }
        }
        return view('admin.'.$this->moduleView.'.index', compact('items', 'categories'));
    }


    public function create() {
        $item = new $this->class();
        $form = new $this->form();
        $formSeo = null;

        $data = [
            'item' => $item,
            'form' => $form,
        ];

        if($this->seo) {
            $formSeo = new SeoForm();
            $data['formSeo'] = $formSeo;
        }

        return view('admin.'.$this->moduleView.'.edit', $data);
    }

    public function show(int $id) {
        $item = $this->class::with(['seo'])->findOrFail($id);
        $form = new $this->form($item);
        $formSeo = null;

        if($item->seo) {
            $formSeo = new SeoForm($item->seo);
        }

        return view('admin.'.$this->moduleView.'.edit', compact('item', 'form', 'formSeo'));
    }


    // MODIFIERS
    public function baseEdit($request) {
        $id = $request->id;
        $post = $request->post();

        $item = $this->class::with(['seo'])->findOrNew($id);

        if(isset($post['seo'])) {
            $rules = [];

            foreach (SeoForm::FIELDS as $name=>$field) {
                $rules['seo.'.$name] = $field['rules'];
            }

            $seoId = null;
            if($item->seo) {
                $seoId = $item->seo->id;
            }
            $rules['seo.url'][] = Rule::unique('seo')->ignore($seoId)->where('lang', getAdminLang());

            Validator::make($post, $rules)->validate();
        }

        $item->fill($post[$this->moduleName]);

        if($item->seo) {
            $item->seo()->update($post['seo']);
        }
        elseif ($this->seo) {
            $item->seo()->associate(Seo::create($post['seo']));
        }


        $item->save();


        if($request->exists('saveandclose')){
            Log::info(__('admin.log.updated', ['model' => $this->moduleName, 'id' => $item->getKey()]));
            return redirect(route('admin.'.$this->moduleName.'.index'))->with('success', 'Pomyślnie zapisano zmiany.');
        } else {
            Log::info(__('admin.log.created', ['model' => $this->moduleName, 'id' => $item->getKey()]));
            return redirect(route('admin.'.$this->moduleName.'.show', $item))->with('success', 'Pomyślnie zapisano zmiany.');;
        }


    }

    public function delete(int $id) {
        $item = $this->class::with([])->findOrFail($id);
        if($item->seo) {
            $item->seo()->delete();
        }
        if($item->gallery) {
            $images = GalleryItem::with([])->where('gallery_id', $item->gallery_id)->get();
            foreach ($images as $gItem){
                if(Storage::exists($gItem->url)) {
                    Storage::delete($gItem->url);
                }
            }
            $filesArray = [];
            foreach (\File::allFiles('resized') as $file){
                if(str_contains(basename($file), '_public_gallery_item_'.$item->gallery_id.'_')){
                    $filesArray[] = 'resized/'.basename($file);
                }
            }
            \File::delete($filesArray);
            $item->gallery()->delete();
        }
        $item->delete();
        Log::info(__('admin.log.deleted', ['model' => $this->moduleName, 'id' => $id]));
        return redirect(route('admin.'.$this->moduleName.'.index'))->with('success', 'Pomyślnie usunięto element.');
    }



    private function getModuleView($moduleName) {
        $exceptions = ['category'];
        $arr = explode('_', $moduleName);

        foreach ($exceptions as $exception) {
            if(in_array($exception, $arr)) {
                return str_replace('_'.$exception, '.'.$exception, $moduleName);
            }
        }

        return $moduleName;
    }
}
