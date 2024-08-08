<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Config;


class GoogleAppSettingsForm extends Form
{

    const FIELDS = [
        'google_app_recaptcha2_site_key' => [
            'name' => 'google_app_recaptcha2_site_key',
            'type' => 'text',
            'label' => 'admin.google_app_settings.site_key',
            'rules' => [],
        ],
        'google_app_recaptcha2_secret_key' => [
            'name' => 'google_app_recaptcha2_secret_key',
            'type' => 'text',
            'label' => 'admin.google_app_settings.secret_key',
            'rules' => [],
        ],
    ];

    public function __construct($model = null)
    {
        foreach (self::FIELDS as $name => $field) {
            $this->modelFields[$name] = $field;
        }

        parent::__construct($model, Config::class);
    }
}
