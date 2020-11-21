<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Departament;

class Area extends Model
{
    use HasFactory;

    protected $fillable = ['departament_id', 'nome'];

    public function departament(){
        return $this->belongsTo('App\Departament');
    }

}
