<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarUsuarioRequest extends FormRequest
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
            'Txt_Nombre' => ['required'],
            'Txt_Apellido' => ['required'],
            'Select_TipoDocumento' => ['required'],
            'Txt_Documento' => ['required', 'numeric', 'digits_between:5,11'],
            'Txt_Telefono' => ['required'],
            'Txt_Direccion' => ['required'],
            'Select_Rol' => ['required'],
            'Txt_UsuarioLogin' => ['required'],
            'Txt_Password' => ['required'],
        ];
    }
	
	public function messages(){
		return [
			'Txt_Nombre.required' => 'El nombre es requerido.',
			'Txt_Apellido.required' => 'El apellido es requerido.',
            'Select_TipoDocumento.required' => 'El tipo de documento es requerido.',
            'Txt_Documento.numeric' => 'El valor debe ser númerico.',
            'Txt_Documento.digits_between' => 'El número del documento debe estar entre 5 y 11 digitos.',
            'Txt_Documento.required' => 'El número de documento es requerido.',
            'Txt_Telefono.required' => 'El teléfono es requerido.',
            'Txt_Direccion.required' => 'La dirección es requerida.',
            'Select_Rol.required' => 'El rol es requerido.',
            'Txt_UsuarioLogin.required' => 'El usuario es requerido.',
            'Txt_Password.required' => 'La contraseña es requerida.'
		];
	}
}
