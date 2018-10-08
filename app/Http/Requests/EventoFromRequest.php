<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoFromRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'cliente_id'        => 'required',
            'dtevento'          => 'required',
            'qtdconvidados_id'  => 'required',
            'qtdfotos_id'       => 'required',
            'tipoeventos_id'     => 'required',
            'tipofotos_id'      => 'required',
            'valorContrato'     => 'required|min:8' ,

        ];
    }

    public function messages() {
        return [

            'cliente_id.required' => 'O campo Cliente é de preenchimento obrigatório',
            'dtevento.required' => 'O campo Data é de preenchimento obrigatório',
            'qtdconvidados_id.required' => 'O campo Qtd de convidados é de preenchimento obrigatório',
            'qtdfotos_id.required' => 'O campo Qtd de fotos é de preenchimento obrigatório',
            'tipoeventos_id.required' => 'O campo Tipo de evento é de preenchimento obrigatório',
            'tipofotos_id.required' => 'O campo Tipo de fotos é de preenchimento obrigatório',
            'valorContrato.required' => 'O campo Valor do contrato é de preenchimento obrigatório',
            'valorContrato.min' => 'O campo Valor do contrato é de preenchimento obrigatório',

        ];
    }
}
