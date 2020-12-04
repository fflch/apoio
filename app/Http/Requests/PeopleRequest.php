<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\People;
use App\Models\Designation;
use App\Models\Institution;

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
        $rules = [
            'nusp' => "required|integer",
            'nome' => 'required',
            'designation_id' => [
                'nullable',
                Rule::in(Designation::all()->pluck('id')),
            ],
            'instituicao' => [
                'nullable',
                Rule::in(Institution::all()->pluck('id')),
            ],
            'unidade' => 'nullable',
            'endereco' => 'nullable',
            'complemento' => 'nullable',
            'cidade' => 'nullable',
            'estado' => [
                'nullable',
                Rule::in(array_keys(People::estadoOptions()))
            ],
            'cep' => 'nullable',
            'cpf' => 'nullable',
            'identidade' => 'nullable',
            'passaport' => 'nullable',
            'pispasep' => 'nullable',
            'observacao' => 'nullable',
        ];

        if($this->method() == 'POST') {
            $rules['nusp'] .= "|unique:people";
        }

        return $rules;
    }
}
