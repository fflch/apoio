<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = ['area'];

    public function departament(){
        return $this->belongsTo('App\Departament');
    }
}
