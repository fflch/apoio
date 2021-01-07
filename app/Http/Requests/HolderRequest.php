<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Designation;
use App\Models\Departament;

class HolderRequest extends FormRequest
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
            'people_id' => 'required',
            'designation_id' => [
                'required',
                Rule::in(Designation::all()->pluck('id')),
            ],
            'departament_id' => [
                'required',
                Rule::in(Departament::all()->pluck('id')),
            ],
            'pertence' => [
                'required',
                Rule::in(['CTA', 'CON']),
            ],
            'inicio' => 'required|date',
            'termino' => 'required|date|after:inicio',
            'observacao' => 'nullable',
            'ativo' => [
                'required',
                Rule::in(['S', 'N']),
            ],
        ];
    }
}
