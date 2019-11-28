<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
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
            'title' => 'required',
            'price' => 'required',
            'content' => 'required',
            'size' => 'required',
            'color' => 'required',
            'images' => 'image|mimes:jpeg,bmp,png,jpg'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Title is blank',
            'price.required' => 'Price is blank',
            'content.required' => 'Content is blank',
            'size.required' => 'Size is blank',
            'color.required' => 'Color is blank',
            'images.image' => 'The image is malformed',
            'images.mimes' => 'The image is malformed',

        ];
    }
}
