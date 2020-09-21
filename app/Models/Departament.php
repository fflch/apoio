<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    use HasFactory;

    protected $fillable = ['sigla', 'departamento'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if($filter) {
                $query->where('departamento', 'like', "%$filter%");
            }
        })->paginate();

        return $results;
    }

    public function areas(){
        return $this->hasMany('App\Area');
    }
}
