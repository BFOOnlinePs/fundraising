<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
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
            'reference_number' => 'required|string',
            'project_name_ar' => 'required|string',
            'project_name_en' => 'required|string',
            'project_description' => 'required|string',
            'planned_start_date' => 'required|date',
            'planned_end_date' => 'required|date',
            'institution_role' => 'required|string',
            'budget' => 'required|numeric',
            'currency_id' => 'required|string',
            'beneficiary_id' => 'required|integer',
//            'call_id' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
//            'reference_number.required' => 'رقم المرجع مطلوب',
//            'project_name_ar.required' => 'اسم المشروع بالعربية مطلوب',
//            'project_name_en.required' => 'اسم المشروع بالانجليزية مطلوب',
//            'project_description.required' => 'وصف المشروع مطلوب',
//            'planned_start_date.required' => 'تاريخ البدء المخطط مطلوب',
//            'planned_end_date.required' => 'تاريخ الانتهاء المخطط مطلوب',
//            'institution_role.required' => 'الدور المؤسسي مطلوب',
//            'budget.required' => 'الميزانية مطلوبة',
//            'currency_id.required' => 'رمز العملة مطلوب',
//            'beneficiary_id.required' => 'معرف المستفيد مطلوب',
//            'call_id.required' => 'معرف الدعوة مطلوب',

            'reference_number.required' => 'Reference number is required',
            'project_name_ar.required' => 'Project name in Arabic is required',
            'project_name_en.required' => 'Project name in English is required',
            'project_description.required' => 'Project description is required',
            'planned_start_date.required' => 'Planned start date is required',
            'planned_end_date.required' => 'Planned end date is required',
            'institution_role.required' => 'Institutional role is required',
            'budget.required' => 'Budget is required',
            'currency_id.required' => 'Currency code is required',
            'beneficiary_id.required' => 'Beneficiary ID is required',
        ];
    }
}
