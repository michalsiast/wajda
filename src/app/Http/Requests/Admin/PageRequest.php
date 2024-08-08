<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\PageForm;
use App\Forms\Admin\SeoForm;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach (PageForm::FIELDS as $field) {
            $rules['page.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
