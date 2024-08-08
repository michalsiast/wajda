<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Article;
use App\Models\BaseModel;
use App\Models\Page;
use App\Models\PageType;
use App\Models\SiteLang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class SiteLangForm extends Form
{

    const FIELDS = [
        'name' => [
            'name' => 'name',
            'type' => 'text',
            'label' => 'admin.site_lang.name',
            'rules' => ['max:255', 'min:2', 'required'],
        ],
        'full_name' => [
            'name' => 'full_name',
            'type' => 'text',
            'label' => 'admin.site_lang.full_name',
            'rules' => ['max:255', 'min:2', 'required'],
        ],
        'default_site' => [
            'name' => 'default_site',
            'type' => 'checkbox',
            'label' => 'admin.site_lang.default_site',
            'rules' => [],
            'options' => [],
        ],
        'default_admin' => [
            'name' => 'default_admin',
            'type' => 'checkbox',
            'label' => 'admin.site_lang.default_admin',
            'rules' => [],
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

        parent::__construct($model, SiteLang::class);
    }
}
