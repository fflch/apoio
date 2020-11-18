<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'nusp',
        'nome',
        'unidade',
        'endereco',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'instituicao',
        'identidade',
        'pispasep',
        'cpf',
        'passaport',
        'observacao',
    ];

    public function designations() {
        return $this->belongsToMany('App\Models\Designation')
                        ->withTimestamps()
                        ->withPivot(['ativo']);
    }

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if($filter) {
                $query->where('people', 'like', "%$filter%");
            }
        })->paginate();

        return $results;
    }

}
