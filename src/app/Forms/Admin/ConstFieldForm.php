<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Article;
use App\Models\BaseModel;
use App\Models\ConstField;
use App\Models\Page;
use App\Models\PageType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class ConstFieldForm extends Form
{

    const FIELDS = [
        'page_title' => [
            'name' => 'page_title',
            'type' => 'text',
            'label' => 'admin.const_field.page_title',
            'rules' => [],
        ],
        'company_name' => [
            'name' => 'company_name',
            'type' => 'text',
            'label' => 'admin.const_field.company_name',
            'rules' => [],
        ],
        'company_address' => [
            'name' => 'company_address',
            'type' => 'text',
            'label' => 'admin.const_field.company_address',
            'rules' => [],
        ],
        'company_city' => [
            'name' => 'company_city',
            'type' => 'text',
            'label' => 'admin.const_field.company_city',
            'rules' => [],
        ],
        'company_post_code' => [
            'name' => 'company_post_code',
            'type' => 'text',
            'label' => 'admin.const_field.company_post_code',
            'rules' => [],
        ],
        'company_country' => [
            'name' => 'company_country',
            'type' => 'text',
            'label' => 'admin.const_field.company_country',
            'rules' => [],
        ],
        'company_nip' => [
            'name' => 'company_nip',
            'type' => 'text',
            'label' => 'admin.const_field.company_nip',
            'rules' => [],
        ],
        'company_krs' => [
            'name' => 'company_krs',
            'type' => 'text',
            'label' => 'admin.const_field.company_krs',
            'rules' => [],
        ],
        'phone' => [
            'name' => 'phone',
            'type' => 'text',
            'label' => 'admin.const_field.phone',
            'rules' => [],
        ],
        'phone2' => [
            'name' => 'phone2',
            'type' => 'text',
            'label' => 'admin.const_field.phone2',
            'rules' => [],
        ],
        'email' => [
            'name' => 'email',
            'type' => 'text',
            'label' => 'admin.const_field.email',
            'rules' => [],
        ],
        'email2' => [
            'name' => 'email2',
            'type' => 'text',
            'label' => 'admin.const_field.email2',
            'rules' => [],
        ],
        'contact_form_email' => [
            'name' => 'contact_form_email',
            'type' => 'text',
            'label' => 'admin.const_field.contact_form_email',
            'rules' => [],
        ],
        'google_map' => [
            'name' => 'google_map',
            'type' => 'text',
            'label' => 'admin.const_field.google_maps',
            'rules' => [],
        ],
        'google_map_iframe' => [
            'name' => 'google_map_iframe',
            'type' => 'text',
            'label' => 'admin.const_field.google_maps_iframe',
            'rules' => [],
        ],
        'facebook' => [
            'name' => 'facebook',
            'type' => 'text',
            'label' => 'Facebook',
            'rules' => [],
        ],
        'instagram' => [
            'name' => 'instagram',
            'type' => 'text',
            'label' => 'Instagram',
            'rules' => [],
        ],

        'contact_form_rule' => [
            'name' => 'contact_form_rule',
            'type' => 'textarea',
            'label' => 'admin.const_field.contact_form_rule',
            'rules' => [],
            'row' => 5,
            'class' => 'ckeditorStandard',
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, ConstField::class);
    }
}
