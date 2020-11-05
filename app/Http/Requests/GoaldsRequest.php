<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoaldsRequest extends FormRequest
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
            'gld' => 'required_without:id|mimes:jpg,jpeg,png',
            'gld.*.name' => 'required|string|max:100',
            'gld.*.text' => 'required|string|max:100',
            'gld.*.active' => 'required',
            'gld.*.abbr' => 'required',
        ];
    }
}
