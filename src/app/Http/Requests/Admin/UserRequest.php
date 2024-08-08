<?php

namespace App\Http\Requests\Admin;

use App\Forms\Admin\UserForm;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [];
        foreach (UserForm::FIELDS as $field) {
            $rules['users.'.$field['name']] = $field['rules'];
        }

        return $rules;
    }
}
