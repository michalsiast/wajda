<?php


namespace App\Http\Controllers;


use App\Http\Requests\PageRequest;
use App\Models\SiteLang;

class IndexController extends Controller
{
    public function show($view) {
    }

    public function langNav($view) {
        $view->items = SiteLang::with([])
            ->active()
            ->get();
    }
}
