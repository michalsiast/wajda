<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\OfferForm;
use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
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
        foreach (OfferForm::FIELDS as $field) {
            $rules['offer.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
