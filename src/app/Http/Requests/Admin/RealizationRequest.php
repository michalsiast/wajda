<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\RealizationForm;
use Illuminate\Foundation\Http\FormRequest;

class RealizationRequest extends FormRequest
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
        foreach (RealizationForm::FIELDS as $field) {
            $rules['realization.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
