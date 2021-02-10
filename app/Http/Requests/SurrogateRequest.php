<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\People;
use App\Models\Departament;
use App\Models\Holder;

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
                Rule::in(People::where('id', $this->people_id)->pluck('id')
                                                  ->toArray()),
            ],
            'departament_id' => [
                'required',
                Rule::in(Departament::where('id', $this->departament_id)
                                            ->pluck('id')->toArray()),
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
