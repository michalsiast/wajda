<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\PageForm;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Field;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class EditController extends Controller
{
    public function edit($view)
    {
        $page = Page::with('fields')->findOrFail($view->id);

        $pageFields = PageType::getByName($page->type)['fields'];

        $formFields = [];

        foreach ($pageFields as $name=>$value) {
            [$type, $label] = $value;

            $field = Field::with([])
                ->where('page_id', $view->id)
                ->where('name', $name)
                ->firstOrCreate([
                    'page_id' => $page->id,
                    'label' => $label,
                    'type' => $type,
                    'name' => $name,
                ]);
            $formFields[] = $field;
        }


        $view->fields = $formFields;
    }
}
