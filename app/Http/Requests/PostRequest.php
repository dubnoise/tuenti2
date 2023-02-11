<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => 'required|max:100',
        ];
    }
    public function messages()
    {
        return [
            'content.required' => 'El campo está vacío.',
            'content.max' => 'El estado tiene más de 100 carácteres.',
        ];
    }
}
