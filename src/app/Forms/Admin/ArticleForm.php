<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\BaseModel;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ArticleForm extends Form
{

    const FIELDS = [
        'article_category_id' => [
            'name' => 'article_category_id',
            'type' => 'select',
            'label' => 'admin.article_category.singular',
            'rules' => [],
            'options' => [],
        ],
        'title' => [
            'name' => 'title',
            'type' => 'text',
            'label' => 'admin.article.title',
            'rules' => ['max:255', 'min:2', 'required'],
            'attrs' => [
                'seoUrl' => true,
                'seoTitle' => true,
            ]
        ],
        'lead' => [
            'name' => 'lead',
            'type' => 'textarea',
            'label' => 'admin.article.lead',
            'class' => 'ckeditorStandard',
            'rules' => [],
            'options' => [],
        ],
        'text' => [
            'name' => 'text',
            'type' => 'textarea',
            'label' => 'admin.article.text',
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
        $categories = ArticleCategory::with([])->adminLocale()->get();
        foreach ($categories as $category) {
            $this->modelFields['article_category_id']['options'][$category->id] = $category->title;
        }
        parent::__construct($model, Article::class);
    }
}
