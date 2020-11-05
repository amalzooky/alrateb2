<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            // 'username' => 'required|alpha_dash|max:50'.$this->get('id'),
            'password' => 'required',
            // 'password' => 'required',
            // 'username' => 'required|unique:admins,username,'.$this->id,
            // 'email' => 'required|unique:admins,email,'.$this->id,
            
              ];
    }

    public function messages()
    {
        return [
            'email.required' => 'البريد الإلكتروني مطلوب.',
            // 'email.email' => 'ادخل عنوان بريد إلكتروني صالح.',
            'username.username' => 'ادخل أسم المستخدم الصحيحح.',
            'password.required' => 'كلمة المرور مطلوبة.'
        ];
    }
}
