<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contest extends Model
{
    use HasFactory;

    public function departament() {
        return $this->belongsTo('App\Models\Departament');
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

    public function setInicioProvaAttribute($value) {
        $this->attributes['inicio_prova'] = Carbon::createFromFormat('d/m/Y', $value)
             ->format('Y-m-d');
    }

    public function getInicioProvaAttribute($value) {
        if(empty($value)) {
            return $this->attributes['inicio_prova'] = null;
        }
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function setTerminoProvaAttribute($value) {
        $this->attributes['termino_prova'] = Carbon::createFromFormat('d/m/Y', $value)
             ->format('Y-m-d');
    }

    public function getTerminoProvaAttribute($value) {
        if(empty($value)) {
            return $this->attributes['termino_prova'] = null;
        }
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

    public function setDataPublicacaoAttribute($value) {
        $this->attributes['data_publicacao'] = Carbon::createFromFormat('d/m/Y', $value)
             ->format('Y-m-d');
    }

    public function getDataPublicacaoAttribute($value) {
        if(empty($value)) {
            return $this->attributes['data_publicacao'] = null;
        }
        return Carbon::createFromFormat('Y-m-d', $value)->format('d/m/Y');
    }

}
