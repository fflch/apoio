<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;

    protected $fillable = [
        'contests_id',
        'people_id',
        'origem',
        'titulo',
        'voto',
        'posicao',
    ];
}
