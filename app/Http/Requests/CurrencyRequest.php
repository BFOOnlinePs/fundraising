<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Str;

class CurrencyRequest extends FormRequest
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
            'currency_name_ar' => 'required|string',
            'currency_name_en' => 'required|string',
            'currency_abbreviation' => 'nullable|string',
            'currency_symbol' => 'required|string',
            'currency_flag' => 'nullable|image|mimes:jpeg,jpg,png',
        ];
    }

    public function messages()
    {
        return [
            'currency_name_ar.required' => 'حقل اسم العملة باللغة العربية مطلوب.',
            'currency_name_ar.string' => 'حقل اسم العملة باللغة العربية يجب أن يكون نصًا.',

            'currency_name_en.required' => 'حقل اسم العملة باللغة الإنجليزية مطلوب.',
            'currency_name_en.string' => 'حقل اسم العملة باللغة الإنجليزية يجب أن يكون نصًا.',

            'currency_abbreviation.string' => 'حقل اختصار العملة يجب أن يكون نصًا.',

            'currency_symbol.required' => 'حقل رمز العملة مطلوب.',
            'currency_symbol.string' => 'حقل رمز العملة يجب أن يكون نصًا.',

            'currency_flag.url' => 'الرجاء إدخال عنوان URL صحيح لصورة العلم.',
            'currency_flag.regex' => 'صيغة الصورة غير صحيحة. يجب أن تكون الصورة من النوع: jpg, jpeg, png, gif, أو svg.'
        ];
    }
}
