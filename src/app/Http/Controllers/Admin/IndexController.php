<?php


namespace App\Http\Controllers\Admin;


use App\Models\SiteLang;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class IndexController
{

    public function index() {
        return view('admin.index.index');
    }

    public function nav($view) {
        $view->navSections = config('admin_nav');
    }

    public function langs($view) {
        $langs = SiteLang::with([])
            ->active()
            ->get();
        $view->items = $langs;
    }

    public function changeLang() {
        if (request()->method() == 'POST') {
           $lang = request()->admin_lang;
           session()->put('app_locale', $lang);
           return redirect()->back();
        }
    }

    public function changeOrder($table) {
        $items = request()->post('items');

        foreach ($items as $item) {
            try {
                DB::table($table)->where('id', '=', $item['id'])
                    ->update(['position' => $item['position']]);
            }
            catch (Exception $e) {
                return response()->json(['success' => 500, 'message' => $e->getMessage()]);
            }
        }

        return response()->json(['success' => 200, 'message' => 'Updated!']);
    }
}

