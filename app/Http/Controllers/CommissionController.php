<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\People;
use App\Models\ContestPeople;
use Illuminate\Support\Facades\DB;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contest $contest)
    {
        $contest->load('people');

        return view('commissions.index', [
            'contest' => $contest,
            'origens'  => ContestPeople::ORIGENS,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Contest $contest)
    {

#        $contest->load('people');
#
#        return view('commissions.create', [
#            'contest' => $contest,
#        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contest = Contest::find($request->contest_id);
        $person = People::find($request->people_id);

        if(!$contest || !$person) return redirect()->back();

        if(!$contest->people->contains($person->id)) {
            $contest->people()->attach($person, [
                'origem' => $request->origem,
                'titulo' => $person->designation->nome,
            ]);
        }

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function show(Commission $commission)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function edit(Commission $commission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commission  $commission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commission $commission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @param  \App\Models\People   $people
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest, People $people)
    {
        $contestPeople = $contest->people()
                                 ->wherePivot('people_id', $people->id)
                                 ->get();

        foreach($contestPeople as $contestPerson){
            $origem  = $contestPerson->commissions->origem;
            $posicao = $contestPerson->commissions->posicao;
        }

        $positionCommissions = $contest->people()
                                ->wherePivot('origem', $origem)
                                ->wherePivot('posicao', '>', $posicao)
                                ->get();

        DB::transaction(function () use($contest, $people, $positionCommissions) {
            $contest->people()->detach($people->id);
            foreach($positionCommissions as $positionCommission) {
                $contest->people()->updateExistingPivot($positionCommission->id, [
                    'posicao' => $positionCommission->commissions->posicao - 1,
                ]);
            }
        });

        return redirect()->back();
    }

}
