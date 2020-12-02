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
        'institution_id',
        'designation_id',
        'endereco',
        'complemento',
        'cidade',
        'estado',
        'cep',
        'identidade',
        'pispasep',
        'cpf',
        'passaport',
        'observacao',
    ];

    public function designations() {
        return $this->belongsTo('App\Models\Designation');
    }

    public function contacts()
    {
        return $this->belongsToMany('App\Models\Contact')
                        ->withTimestamps()
                        ->withPivot(['contato']);
    }

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if($filter) {
                $query->where('nome', 'like', "%$filter%");
            }
        })->paginate();

        return $results;
    }

    public static function estadoOptions()
    {
        return [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins'
        ];
    }

}
