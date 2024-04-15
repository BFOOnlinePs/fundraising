<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacesRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'place_name_ar' => 'required|string|max:255',
            'place_name_en' => 'required|string|max:255',
            'place_description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
//            'place_name_ar.required' => 'حقل اسم المكان (بالعربية) مطلوب.',
//            'place_name_en.required' => 'حقل اسم المكان (بالإنجليزية) مطلوب.',
//            'place_description.required' => 'حقل وصف المكان مطلوب.',

            'place_name_ar.required' => 'Place name (in Arabic) field is required.',
            'place_name_en.required' => 'Place name (in English) field is required.',
            'place_description.required' => 'Place description field is required.',

        ];
    }
}
