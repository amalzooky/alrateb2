<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OnlineRequest extends FormRequest
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
            'onl' => 'required_without:id|mimes:jpg,jpeg,png',
            'onl.*.name' => 'required|string|max:100',
            'onl.*.text' => 'required|string|max:100',
            'onl.*.active' => 'required',
            'onl.*.abbr' => 'required',
        ];
    }
}
