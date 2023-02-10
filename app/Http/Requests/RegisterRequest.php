<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:25'],
            'surname' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', Rules\Password::defaults()],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'birthdate' => ['required', 'date'],
        ];
    }
    public function messages(){
        return [
            'name.required' => 'El nombre es obligatorio',
            'surname.required' => 'El apellido es obligatorio',
            'email.required' => 'El email es obligatorio',
            'password.required' => 'La contraseña es obligatoria',
            'country.required' => 'El país es obligatorio',
            'city.required' => 'La ciudad es obligatoria',
            'birthdate.required' => 'La fecha de nacimiento es obligatoria',
        ];
    }
}
