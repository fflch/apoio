<?php

namespace App\Observers;

use App\Models\ContestPeople;
use App\Models\Contest;

class ContestPeopleObserver
{
    /**
     * Handle the ContestPeople "created" event.
     *
     * @param  \App\Models\ContestPeople  $contestPeople
     * @return void
     */
    public function creating(ContestPeople $contestPeople)
    {
        $contest = Contest::find($contestPeople->contest_id);
        $contestPeople->posicao = $contest->people()
                                      ->wherePivot('origem', $contestPeople->origem)
                                      ->get()
                                      ->max('commissions.posicao') + 1;
    }

    /**
     * Handle the ContestPeople "updated" event.
     *
     * @param  \App\Models\ContestPeople  $contestPeople
     * @return void
     */
    public function updating(ContestPeople $contestPeople)
    {
        //
    }

}
