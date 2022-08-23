<?php

namespace App\Http\Requests\Backend\Package;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'unique:packages'],
            'price' => ['required', 'string', 'max:255'],
            'is_published' => ['required'],
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
            'is_published.required' => 'There is some thing wrong with status'
        ];
    }
}
