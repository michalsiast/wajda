<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Article;
use App\Models\BaseModel;
use App\Models\Page;
use App\Models\PageType;
use App\Models\Seo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;

class SeoForm extends Form
{

    const FIELDS = [
        'url' => [
            'name' => 'url',
            'type' => 'text',
            'label' => 'admin.seo.url',
            'rules' => ['max:255', 'required'],
        ],
        'title' => [
            'name' => 'title',
            'type' => 'text',
            'label' => 'admin.seo.title',
            'rules' => ['max:255', 'required'],
        ],
        'description' => [
            'name' => 'description',
            'type' => 'textarea',
            'label' => 'admin.seo.description',
            'rules' => [],
            'options' => [],
            'attrs' => [
                'rows' => 5
            ]
        ],
        'tags' => [
            'name' => 'tags',
            'type' => 'text',
            'label' => 'admin.seo.tags',
            'rules' => [],
            'options' => [],
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

//        if($model) {
//            $this->modelFields['url']['rules'][] = Rule::unique('seo')->ignore($model->id);
//        }

//        dd($this->modelFields);

        parent::__construct($model, Seo::class);
    }


    public static function getRules($model) {
        $rules = SeoForm::FIELDS;
        $rules['url']['rules'][] = Rule::unique('seo')->ignore($model->id)->where('lang', $model->lang);
        return $rules;
    }
}
