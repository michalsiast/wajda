<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\ArticleCategoryForm;
use App\Forms\Admin\NavItemForm;
use Illuminate\Foundation\Http\FormRequest;

class NavItemRequest extends FormRequest
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
        foreach (NavItemForm::FIELDS as $field) {
            $rules['nav_item.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
