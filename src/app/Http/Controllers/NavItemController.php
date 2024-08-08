<?php


namespace App\Http\Controllers;


use App\Forms\Admin\PageForm;
use App\Http\Requests\PageRequest;
use App\Models\Article;
use App\Models\NavItem;
use App\Models\Page;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class NavItemController extends Controller
{
    public function partial($view) {
        $view->items = NavItem::with(['navItems'])
            ->activeAndLocale()
            ->where('nav_item_id', '=', null)
            ->where('nav_name', '=', $view->name)
            ->orderByDesc('position')
            ->get();
    }
}
