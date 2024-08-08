<?php


namespace App\Http\Controllers;


use App\Forms\Admin\PageForm;
use App\Helpers\Methods;
use App\Helpers\SeoHelper;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Models\PageType;
use App\Models\SiteLang;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class PageController extends Controller
{
    public function show($item) {
        $type = PageType::getByName($item->type);
        $view = 'page.show';

        if($type['module']) {
            $view = str_replace('_', '.', $item->type);
        }
        else {
            $view = 'page.'.explode('.', $item->type)[0];
        }

        $fields = (object) $item->fields->pluck('value', 'name')->toArray();
        $gallery = $item->gallery;

        SeoHelper::setSeo($item->seo);

        return view('default.'.$view, ['page' => $item, 'fields' => $fields, 'gallery' => $gallery]);
    }

}
