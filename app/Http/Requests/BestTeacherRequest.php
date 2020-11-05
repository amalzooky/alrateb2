<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BestTeacherRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'btech.*.name' => 'required|string|max:100',
            'btech.*.text' => 'required|string|max:100',
            'btech.*.active' => 'required',
            'btech.*.abbr' => 'required',
        ];
    }
}
