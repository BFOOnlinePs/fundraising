<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CitesRequest extends FormRequest
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
            'city_name_ar' => 'required|string|max:255',
            'city_name_en' => 'required|string|max:255',
            'city_description' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
//            'city_name_ar.required' => 'حقل اسم المدينة (بالعربية) مطلوب.',
//            'city_name_en.required' => 'حقل اسم المدينة (بالإنجليزية) مطلوب.',
//            'city_description.required' => 'حقل وصف المدينة (بالإنجليزية) مطلوب.',

            'city_name_ar.required' => 'City name (in Arabic) field is required.',
            'city_name_en.required' => 'City name (in English) field is required.',
            'city_description.required' => 'City description (in English) field is required.',

        ];
    }
}
