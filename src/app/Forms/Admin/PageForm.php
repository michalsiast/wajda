<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\BaseModel;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class PageForm extends Form
{

    const FIELDS = [
        'name' => [
            'name' => 'name',
            'type' => 'text',
            'label' => 'admin.page.name',
            'rules' => ['max:255', 'min:2', 'required'],
            'attrs' => [
                'seoUrl' => true,
                'seoTitle' => true,
            ]
        ],
        'type' => [
            'name' => 'type',
            'type' => 'select',
            'label' => 'admin.page.type',
            'rules' => ['required'],
            'options' => [],
        ],
        'active' => [
            'name' => 'active',
            'type' => 'checkbox',
            'label' => 'admin.active',
            'rules' => [],
            'options' => [],
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        $activePageTypes = Page::with([])->activeAndLocale()
            ->get()
            ->pluck('type')
            ->toArray();

        $typeOptions = [];
        foreach (PageType::getNames() as $value) {
            if(!in_array($value, $activePageTypes) || $value == PageType::PAGE_SHOW['name'] || ($model && $value == $model->type)) {
                $typeOptions[$value] = __('admin.page.type.'.$value);
            }
        }
        $this->modelFields['type'] = array_merge(self::FIELDS['type'], ['options' => $typeOptions]);

        parent::__construct($model, Page::class);
    }
}
