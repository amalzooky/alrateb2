<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
            'news' => 'required_without:id|mimes:jpg,jpeg,png',
            'news.*.name' => 'required|string|max:100',
            'news.*.text' => 'required|string|max:100',
            'news.*.active' => 'required',
            'news.*.abbr' => 'required',
        ];
    }
}
