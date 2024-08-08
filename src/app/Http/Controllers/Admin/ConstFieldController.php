<?php


namespace App\Http\Controllers\Admin;

use App\Forms\Admin\ConstFieldForm;
use App\Http\Controllers\Controller;
use App\Models\ConstField;

class ConstFieldController extends Controller
{

    public function index() {
        $constFields = ConstField::with([])->adminLocale()->pluck('value', 'name')->toArray();
        $form = new ConstFieldForm();

        foreach ($form->fields as $key=>$field) {
            $form->fields[$key]['value'] = $constFields[$field['name']] ?? '';
        }

        return view('admin.const_field.edit', compact('form'));
    }

    public function edit()
    {
        $constFields = request()->post()['const_field'];

        foreach ($constFields as $name=>$value) {
            $field = ConstField::with([])->where('name', '=', $name)->adminLocale()->first();
            if(!$field) {
                $field = new ConstField();
                $field->name = $name;
                $field->lang = session()->get('app_locale', 'pl');
            }

            $field->value = $value;

            $field->save();
        }

        return redirect()->route('admin.const_field.index');
    }
}
