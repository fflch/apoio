<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeopleRequest extends FormRequest
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
            'nusp' => 'required|unique:App\Models\People',
            'nome' => 'required',
            'unidade' => '',
            'endereco' => '',
            'complemento' => '',
            'cidade' => '',
            'estado' => '',
            'cep' => '',
            'instituicao' => '',
            'identidade' => '',
            'pispasep' => '',
            'cpf' => '',
            'passaport' => '',
            'observacao' => '',
        ];
    }
}