<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holder extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'designation_id',
        'departament_id',
        'pertence',
        'inicio',
        'termino',
        'observacao',
        'ativo',
    ];

    public function people() {
        return $this->belongsTo('App\Models\People');
    }

    public function designation() {
        return $this->belongsTo('App\Models\Designation');
     }

    public function departament() {
        return $this->belongsTo('App\Models\Departament');
    }
}
