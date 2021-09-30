<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ContestPeople extends Pivot
{
    const ORIGENS = ['FFLCH','EXTERNO'];
}
