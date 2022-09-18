<?php

namespace App\Http\Requests\Entradas\ContratoAbierto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEntradaFondoOficinaDocumentoRequest extends FormRequest
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
            'numero_o_folio_del_documento' => 'required',
            'monto_subtotal' => 'required|numeric',
            'monto_de_impuesto' => 'required|numeric',
            'monto_total' => 'required|numeric',
            'tipo_de_documento' => 'required'
        ];
    }
}
