<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolYears extends FormRequest
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
            'schoolyear.*.name' => 'required',
            'schoolyear.*.years' => 'required',
            'schoolyear.*.abbr' => 'required',
//            'schoolyear.*.active' => 'required',
               ];
    }
}
