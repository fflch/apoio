<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'contest_id',
        'people_id',
        'processo',
        'nota',
        'conceito',
        'sim',
        'nao',
    ];

    public function contest()
    {
        return $this->belongsTo('App\Models\Contest');
    }

    public function people()
    {
        return $this->belongsTo('App\Models\People');
    }

}
