<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['cargo'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if($filter) {
                $query->where('cargo', 'like', "%$filter%");
            }
        })->paginate();

        return $results;
    }
}
