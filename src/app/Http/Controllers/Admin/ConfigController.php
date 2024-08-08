<?php


namespace App\Http\Controllers\Admin;


use App\Forms\Admin\GoogleAppSettingsForm;
use App\Forms\Admin\SmtpSettingsForm;
use App\Http\Controllers\Controller;
use App\Models\Config;
use http\Client\Request;

class ConfigController extends Controller
{

    public function smtpSettingsIndex() {
        $constFields = Config::with([])->pluck('value', 'name')->toArray();
        $form = new SmtpSettingsForm();

        foreach ($form->fields as $key=>$field) {
            $form->fields[$key]['value'] = $constFields[$field['name']] ?? '';
        }

        return view('admin.smtp_settings.edit', compact('form'));
    }

    public function smtpSettingsEdit()
    {
        $constFields = request()->post()['config'];

        foreach ($constFields as $name=>$value) {
            $field = Config::with([])->where('name', '=', $name)->first();
            if(!$field) {
                $field = new Config();
                $field->name = $name;
            }

            $field->value = $value;

            $field->save();
        }

        return redirect()->route('admin.smtp_settings.index');
    }


    public function googleAppSettingsIndex() {
        $constFields = Config::with([])->pluck('value', 'name')->toArray();
        $form = new GoogleAppSettingsForm();

        foreach ($form->fields as $key=>$field) {
            $form->fields[$key]['value'] = $constFields[$field['name']] ?? '';
        }

        return view('admin.google_app_settings.edit', compact('form'));
    }

    public function googleAppSettingsEdit()
    {
        $constFields = request()->post()['config'];

        foreach ($constFields as $name=>$value) {
            $field = Config::with([])->where('name', '=', $name)->first();
            if(!$field) {
                $field = new Config();
                $field->name = $name;
            }

            $field->value = $value;

            $field->save();
        }

        return redirect()->route('admin.google_app_settings.index');
    }


}
