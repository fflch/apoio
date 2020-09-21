<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Departament;

class Area extends Model
{
    protected $fillable = ['departament_id', 'area'];

    public function departament(){
        return $this->belongsTo('App\Departament');
    }

}
