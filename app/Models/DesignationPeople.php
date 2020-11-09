<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationPeople extends Model
{
    use HasFactory;

    protected $fillable = ['designation_id', 'people_id',  'ativo'];
}
