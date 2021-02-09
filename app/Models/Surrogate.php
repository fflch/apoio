<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surrogate extends Model
{
    use HasFactory;

    protected $fillable = [
        'people_id',
        'holder_id',
        'departament_id',
        'pertence',
        'inicio',
        'termino',
        'observacao',
        'status',
    ];

    public function people() {
        return $this->belongsTo('App\Models\People');
    }

    public function departament() {
        return $this->belongsTo('App\Models\Departament');
    }

    public function holder() {
        return $this->belongsTo('App\Models\Holder');
    }
}
