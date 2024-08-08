<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\ArticleForm;
use App\Forms\Admin\SiteLangForm;
use App\Http\Middleware\ConfigCache;
use App\Http\Requests\Admin\ArticleRequest;
use App\Http\Requests\Admin\SiteLangRequest;
use App\Models\Article;
use App\Models\SiteLang;
use Illuminate\Support\Facades\Artisan;

class SiteLangController extends BaseController
{
    public function __construct()
    {
        parent::__construct(
            SiteLang::class,
            SiteLangForm::class,
            'site_lang',
            false
        );
    }


    // GETTERS
    public function index() {
        $items = SiteLang::with([])
            ->orderByDesc('position')
            ->get();
        return view('admin.site_lang.index', compact('items'));
    }


    public function edit(SiteLangRequest $request)
    {
        $id = $request->id;
        $post = $request->post();

        $item = SiteLang::with([])->findOrNew($id);
        $item->fill($post['site_lang']);

        if($item->default_site) {
            SiteLang::with([])->update(['default_site' => 0]);
        }
        if($item->default_admin) {
            SiteLang::with([])->update(['default_admin' => 0]);
        }

        $item->save();
        $request->id = $item->getKey();

        return parent::baseEdit($request);
    }
}
