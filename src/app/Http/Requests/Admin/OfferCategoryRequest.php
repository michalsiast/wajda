<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\OfferCategoryForm;
use Illuminate\Foundation\Http\FormRequest;

class OfferCategoryRequest extends FormRequest
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
        foreach (OfferCategoryForm::FIELDS as $field) {
            $rules['offer_category.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
