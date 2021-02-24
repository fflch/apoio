<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function setInicioAttribute($value) {
        $this->attributes['inicio'] = Carbon::createFromFormat('d/m/Y', $value)
             ->format('Y-m-d');
    }

    public function getInicioAttribute($value) {
        if(empty($value)) {
            return $this->attributes['inicio'] = null;
        }
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function setTerminoAttribute($value) {
        $this->attributes['termino'] = Carbon::createFromFormat('d/m/Y', $value)
             ->format('Y-m-d');
    }

    public function getTerminoAttribute($value) {
        if(empty($value)) {
            return $this->attributes['termino'] = null;
        }
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }
}
