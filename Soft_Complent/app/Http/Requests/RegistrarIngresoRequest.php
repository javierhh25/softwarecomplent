<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarIngresoRequest extends FormRequest
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
            'Txt_placa' => ['required']
        ];
    }
	
	public function messages(){
		return [
            'Select_Vehiculo.required' => 'Se debe seleccionar un tipo de vehículo.',
            'Txt_placa.required' => 'La placa es requerida.'
		];
	}
}
