<?php

namespace App\Http\Requests\Backend\Blog;

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
            'title' => ['required', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable'],
            'featured_image' => ['required', 'image', 'mimes:jpg,jpeg,png'],
            'header_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
            'category' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'date' => ['nullable'],
            'description' => ['required'],
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
            'title.required' => 'There is some thing wrong with title',
            'feature_image.required' => 'There is some thing wrong with feature image',
        ];
    }
}
