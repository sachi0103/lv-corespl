<?php

namespace App\Http\Requests\Backend\Shop\Category;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
        ];
    }

    /**
     * Get the error messages for the defined message.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'There is some thing wrong with name',

        ];
    }
}
