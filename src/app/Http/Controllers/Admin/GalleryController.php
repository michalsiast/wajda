<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\ArticleForm;
use App\Forms\Admin\SeoForm;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Gallery;

use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    public function getById($id) {
        $items = Gallery::with(['items'])->findOrFail($id)->items;
        foreach ($items as $key=>$item) {
            $items[$key]->url = renderImage($item->url, 50, 50, 'fit');
        }
        return response()->json(['items' => $items]);
    }

    public function store() {

    }
}
