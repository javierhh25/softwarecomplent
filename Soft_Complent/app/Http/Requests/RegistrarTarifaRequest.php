<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarTarifaRequest extends FormRequest
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
            'Select_Vehiculo' => ['required'],
            'Select_NivelServicio' => ['required'],
            'Txt_Valor' => ['required', 'numeric']
        ];
    }
	
	public function messages(){
		return [
			'Select_Vehiculo.required' => 'Se debe seleccionar un tipo de vehículo.',
			'Select_NivelServicio.required' => 'Se debe seleccionar un nivel de servicio.',
            'Txt_Valor.required' => 'Se debe especificar un valor.',
            'Txt_Valor.numeric' => 'El valor debe ser númerico.'
		];
	}
}
