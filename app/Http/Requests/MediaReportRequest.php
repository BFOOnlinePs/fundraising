<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MediaReportRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'media_report_content_ar' => 'required',
            'media_report_content_en' => 'required',
//            'main_photo' => 'required|image|mimes:jpg|max:10000', // Adjusted max size to 10MB (10000 KB)
//            'images.*' => 'image|mimes:jpg,jpeg,png|max:100000',
        ];
    }

    public function messages()
    {
        return [
            'main_photo.required' => 'The profile picture is required.',
            'images.*.image' => 'One or more attached files are not valid images.',
            'images.*.mimes' => 'One or more attached files have an invalid format.',
            'images.*.max' => 'One or more attached files exceeds the maximum size limit (10MB).',
        ];
    }
}
