<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Departament;
use Illuminate\Validation\Rule;

class ContestRequest extends FormRequest
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
            'inicio' => 'required|date_format:"d/m/Y"',
            'termino' => 'required|date_format:"d/m/Y"|after:inicio',
            'departament_id' => [
                'required',
                Rule::in(Departament::where('id', $this->departament_id)->pluck('id')
                                            ->toArray()),
            ],
            'titularidade' => 'required',
            'descricao' => 'required',
            'area' => 'nullable',
            'disciplina' => 'nullable',
            'edital' => 'required',
            'inicio_prova' => 'nullable',
            'termino_prova' => 'nullable',
            'data_publicacao' => 'required',
            'processo' => 'required',
            'livro' => 'nullable',
            'qtde_fflch' => 'required',
            'qtde_externo' => 'required',
            'observacao' => 'nullable',
        ];
    }
}
