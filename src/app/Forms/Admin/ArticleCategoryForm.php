<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\ArticleCategory;
use App\Models\BaseModel;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ArticleCategoryForm extends Form
{

    const FIELDS = [
        'title' => [
            'name' => 'title',
            'type' => 'text',
            'label' => 'admin.article_category.title',
            'rules' => ['max:255', 'min:2', 'required'],
            'attrs' => [
                'seoUrl' => true,
                'seoTitle' => true,
            ]
        ],
        'lead' => [
            'name' => 'lead',
            'type' => 'textarea',
            'label' => 'admin.article_category.lead',
            'class' => 'ckeditorStandard',
            'rules' => [],
            'options' => [],
        ],
        'text' => [
            'name' => 'text',
            'type' => 'textarea',
            'label' => 'admin.article_category.text',
            'class' => 'ckeditorStandard',
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

        parent::__construct($model, ArticleCategory::class);
    }
}
