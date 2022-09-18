<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            
            'txtrfcManual' => 'required|string|size:13|unique:personas,rfc',
            'txtCurpManual' => 'required|string|size:18|unique:personas,curp',
            'txtnombre_manual' => 'required|max:60|regex:/^[\pL\s\-]+$/u',
            'txtapaterno_manual' => 'required|alpha|max:60',
            'txtamaterno_manual' => 'required|alpha|max:60',
            'emailManual' => 'required|string|email|max:255|unique:personas,email',
            'emailconfirmManual' => 'required|string|email|max:255',
            'telefono' => 'nullable||integer',
            'telefono_confirmation' => 'nullable||integer',
            'entes_llenados' => 'required',
            'tipo_contratacion_manual' => 'required',
            'areas_llenados' => 'required',
            'puesto_manual' => 'required',
            'txtpuestomanual' => 'nullable',
            //'dependencia'=>'required'


        ];
    }

    public function messages(){
        return [
            'txtrfcManual.unique' => "El :attribute ya está en uso ",
            'txtrfcManual.required' => 'El :attribute es obligatorio',
            'txtrfcManual.size' => 'El :attribute debe contener maximo 13 carcateres',


            'entes_llenados' => 'Debe seleccionar un :attribute',
            'areas_llenados' => 'Debe seleccionar un :attribute',
            'puesto_manual' => 'Debe seleccionar un :attribute',

            'txtCurpManual.required' => 'El :attribute es obligatorio',
            'txtCurpManual.size' => 'El :attribute debe contener maximo 18 carcateres',
            'txtCurpManual.unique' => 'El :attribute ya está en uso',

            'txtnombre_manual' => 'El :attribute es obligatorio',
            'txtnombre_manual' => 'El :attribute debe contener solo letras',
            'txtnombre_manual' => 'El :attribute debe contener maximo 60 carcateres',

            'txtapaterno_manual' => 'El :attribute es obligatorio',
            'txtapaterno_manual' => 'El :attribute debe contener letras',
            'txtapaterno_manual' => 'El :attribute debe contener maximo 60 carcateres',

            'txtamaterno_manual' => 'El :attribute es obligatorio',
            'txtamaterno_manual' => 'El :attribute debe contener letras',
            'txtamaterno_manual' => 'El :attribute debe contener maximo 60 carcateres',

            'emailManual.required' => 'El :attribute es obligatorio',
            'emailManual.email' => 'El email debe ser un correo valido',
            'email' => 'El :attribute debe coincidir',
            'emailManual.unique'=> "El email ya está en uso",


            'email_confirmation' => 'El :attribute es obligatorio',
            'email_confirmation' => 'El :attribute debe ser un correo valido',

            'telefono' => 'El :attribute es obligatorio',
            'telefono' => 'El :attribute debe ser númerico',
            'telefono' => 'El :attribute debe tener 10 digitos',


            'telefono_confirmation' => 'El :attribute es obligatorio',
            'telefono_confirmation' => 'El :attribute debe tener 10 digitos',
            'telefono_confirmation' => 'El :attribute debe ser númerico',

            'txtpuestomanual' => 'El :attribute es obligatorio',

            
        ];
    }

    public function attributes(){
        return [

            'entes_llenados' => 'Ente público',
            'areas_llenados' => 'Area',
            'tipo_contratacion_manual' => 'Tipo de contratación',
            'puesto_manual' => 'Puesto',

            'rfc' => 'RFC',
            'txtrfcManual'=>'RFC',
            'txtCurpManual' => 'CURP',
            'txtnombre_manual' => 'Nombre',
            'txtapaterno_manual' => 'Apellido paterno',
            'txtamaterno_manual' => 'Apellido materno',
            
            'email' => 'Confirmación de correo electrónico',
            'email_confirmation' => 'Correo electrónico',

            'telefono' => 'Confirmación de número Telefónico',
            'telefono_confirmation' => 'Número Telefónico',

            'txtpuestomanual' => 'Otro puesto',

        ];
    }
}
