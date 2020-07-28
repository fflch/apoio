<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = ['sigla', 'nome', 'unidade', 'local'];
}
