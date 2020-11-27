<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter) {
            if($filter) {
                $query->where('nome', 'like', "%$filter%");
            }
        })->paginate();

        return $results;
    }

    public function people() {
        return $this->hasMany('App\Models\People');
    }

}
