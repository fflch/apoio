<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SurrogateRequest extends FormRequest
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
            'people_id' => [
                'required',
                Rule::in(People::all()->pluck('id')),
            ],
            'departament_id' => [
                'required',
                Rule::in(Departament::all()->pluck('id')),
            ],
            'pertence' => [
                'required',
                Rule::in(array_keys(Holder::pertenceOptions())),
            ],
            'inicio' => 'required|date',
            'termino' => 'required|date|after:inicio',
            'observacao' => 'nullable',
            'status' => [
                'required',
                Rule::in(array_keys(Holder::statusOptions())),
            ],
        ];
    }
}
