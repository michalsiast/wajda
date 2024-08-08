<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\NavItemForm;
use App\Forms\Admin\SeoForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\NavItemRequest;
use App\Models\Gallery;
use App\Models\NavItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NavItemController extends Controller
{

    // GETTERS
    public function index($navName) {
        $items = NavItem::with([])
            ->adminLocale()
            ->where('nav_item_id', '=', null)
            ->where('nav_name', '=', $navName)
            ->orderByDesc('position')
            ->get();
        return view('admin.nav_item.index', compact('items', 'navName'));
    }

    public function show($navName, int $id)
    {
        $item = NavItem::with([])->findOrFail($id);
        $form = new NavItemForm($item);

        return view('admin.nav_item.edit', compact('item', 'form', 'navName'));
    }

    public function create($navName, $parentId = null) {
        $item = new NavItem();
        $form = new NavItemForm();

        $form->fields['nav_item_id']['value'] = $parentId;

        $data = [
            'item' => $item,
            'form' => $form,
            'navName' => $navName,
            'parentId' => $parentId,
        ];

        return view('admin.nav_item.edit', $data);
    }

    public function edit($navName, $id = null) {
        $post = request()->post();

        $item = NavItem::with([])->findOrNew($id);
        $item->nav_name = $navName;

        $parent = NavItem::with([])->find($post['nav_item']['nav_item_id'] ?? 0);
        if($parent) {
            $item->navItem()->associate($parent);
        }

        $item->fill($post['nav_item']);

        $item->save();


        if($id) {
            Log::info(__('admin.log.updated', ['model' => 'nav_item', 'id' => $item->getKey()]));
            return redirect(route('admin.nav_item.index', $navName));
        }
        Log::info(__('admin.log.created', ['model' => 'nav_item', 'id' => $item->getKey()]));
        return redirect(route('admin.nav_item.show', [$navName, $item]));
    }

    public function delete($navName, int $id) {
        $item = NavItem::with([])->findOrFail($id);

        $item->delete();
        Log::info(__('admin.log.deleted', ['model' => 'nav_item', 'id' => $id]));
        return redirect(route('admin.nav_item.index', $navName));
    }
}
