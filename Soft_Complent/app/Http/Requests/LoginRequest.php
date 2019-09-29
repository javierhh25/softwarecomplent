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
            'Txt_usuario' => ['required'],
			'Txt_clave' => ['required']
        ];
    }
	
	public function messages(){
		return [
			'Txt_usuario.required' => 'El usuario es requerido para continuar.',
			'Txt_clave.required' => 'La contraseña es requerida para continuar.'
		];
	}
}
