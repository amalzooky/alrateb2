<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'slid.*.name' => 'required|string|max:100',
            'slid.*.text' => 'required|string|max:100',
        
            'slid.*.abbr' => 'required',


            // 'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            // 'name' => 'required|string|max:100',
            // 'text' =>'required|string|max:100',

        ];
    }
}
