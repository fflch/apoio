<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['sigla', 'instituicao', 'unidade', 'local'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if($filter) {
                $query->where('instituicao', 'like', "%$filter%");
            }
        })->paginate();

        return $results;
    }
}
