<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\BaseModel;
use App\Models\Page;
use App\Models\PageType;
use App\Models\SiteLang;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class UserForm extends Form
{

    const FIELDS = [
        'name' => [
            'name' => 'name',
            'type' => 'text',
            'label' => 'admin.user.name',
            'rules' => ['max:255', 'min:2', 'required'],
        ],
        'email' => [
            'name' => 'email',
            'type' => 'email',
            'label' => 'admin.user.email',
            'rules' => ['max:255', 'min:2', 'email', 'required'],
        ],
        'password' => [
            'name' => 'password',
            'type' => 'password',
            'label' => 'admin.user.password',
            'rules' => ['max:255'],
        ],
        'password_repeat' => [
            'name' => 'password_repeat',
            'type' => 'password',
            'label' => 'admin.user.password_repeat',
            'rules' => ['same:users.password'],
        ],
        'theme' => [
            'name' => 'theme',
            'type' => 'select',
            'label' => 'admin.user.theme',
            'rules' => ['required'],
            'options' => [
                'light' => 'Light',
                'dark' => 'Dark',
            ],
        ],
        'lang' => [
            'name' => 'lang',
            'type' => 'select',
            'label' => 'admin.user.lang',
            'rules' => ['required'],
            'options' => [
                'en' => 'English',
                'pl' => 'Polish',
            ],
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        $langs = SiteLang::with([])->active()->get();
        foreach ($langs as $lang) {
            $this->modelFields['lang']['options'][$lang->name] = $lang->full_name;
        }

        parent::__construct($model, User::class);
    }
}
