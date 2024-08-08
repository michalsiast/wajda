<?php


namespace App\Forms\Admin;


use App\Helpers\Form;
use App\Models\Config;


class SmtpSettingsForm extends Form
{

    const FIELDS = [
        'smtp_host' => [
            'name' => 'smtp_host',
            'type' => 'text',
            'label' => 'admin.smtp_settings.host',
            'rules' => [],
        ],
        'smtp_port' => [
            'name' => 'smtp_port',
            'type' => 'text',
            'label' => 'admin.smtp_settings.port',
            'rules' => [],
        ],
        'smtp_username' => [
            'name' => 'smtp_username',
            'type' => 'text',
            'label' => 'admin.smtp_settings.username',
            'rules' => [],
        ],
        'smtp_password' => [
            'name' => 'smtp_password',
            'type' => 'text',
            'label' => 'admin.smtp_settings.password',
            'rules' => [],
        ],
        'smtp_encryption' => [
            'name' => 'smtp_encryption',
            'type' => 'text',
            'label' => 'admin.smtp_settings.encryption',
            'rules' => [],
        ],
        'smtp_from_address' => [
            'name' => 'smtp_from_address',
            'type' => 'text',
            'label' => 'admin.smtp_settings.from_address',
            'rules' => [],
        ],
        'smtp_from_name' => [
            'name' => 'smtp_from_name',
            'type' => 'text',
            'label' => 'admin.smtp_settings.from_name',
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
