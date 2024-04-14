<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectActivityRequest extends FormRequest
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
            'project_id' => 'required|integer',
            'activity_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'معرف المشروع مطلوب',
            'project_id.integer' => 'معرف المشروع يجب أن يكون عددًا صحيحًا',
            'activity_id.required' => 'معرف النشاط مطلوب',
            'activity_id.integer' => 'معرف النشاط يجب أن يكون عددًا صحيحًا',
        ];
    }
}
