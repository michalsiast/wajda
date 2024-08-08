<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\ArticleForm;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $rules = [];
        foreach (ArticleForm::FIELDS as $field) {
            $rules['article.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
