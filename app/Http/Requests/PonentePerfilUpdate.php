<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PonentePerfilUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // SOLO PUEDE ACTUALIZAR SI ES PONENTE Y SI ES SU PROPIO PERFIL
        //O SI ES ADMIN
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
            'profile_avatar' => 'image|max:900',
            'perfil_descripcion' => 'required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'perfil_descripcion.required' => 'El campo semblanza no debe quedar vacio',
            'profile_avatar.max' => 'La imagen debe de ser menor de 900 kilobytes',
        ];
    }
    
}
