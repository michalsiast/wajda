<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\OfferForm;
use App\Forms\Admin\RotatorForm;
use Illuminate\Foundation\Http\FormRequest;

class RotatorRequest extends FormRequest
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
        foreach (RotatorForm::FIELDS as $field) {
            $rules['rotator.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
