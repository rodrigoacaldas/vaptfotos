<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrcamentoFromRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [


            'followup'          => 'required',
            'meiocontato_id'    => 'required',

        ];
    }

    public function messages() {
        return [

            
            'followup.required' => 'O campo FollowUP é de preenchimento obrigatório',
            'meiocontato_id.required' => 'O campo Meio de contato é de preenchimento obrigatório',

        ];
    }
}
