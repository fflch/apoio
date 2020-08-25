<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
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
}