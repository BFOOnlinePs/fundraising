<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityRequest extends FormRequest
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
            'activity_name_ar' => 'required|string',
            'activity_name_en' => 'required|string',
            'activity_description_ar' => 'required|string',
            'activity_description_en' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
//            'activity_name_ar.required' => 'حقل اسم النشاط بالعربية مطلوب',
//            'activity_name_en.required' => 'حقل اسم النشاط بالإنجليزية مطلوب',
//            'activity_description_ar.required' => 'حقل وصف النشاط بالعربية مطلوب',
//            'activity_description_en.required' => 'حقل وصف النشاط بالإنجليزية مطلوب',

            'activity_name_ar.required' => 'Activity name in Arabic field is required',
            'activity_name_en.required' => 'Activity name in English field is required',
            'activity_description_ar.required' => 'Activity description in Arabic field is required',
            'activity_description_en.required' => 'Activity description in English field is required',

        ];
    }
}
