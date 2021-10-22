<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Models\People;
use App\Models\ContestPeople;
use App\Http\Requests\CommissionRequest;
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommissionRequest $request)
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

    public function reorder(CommissionRequest $request)
    {
        $validate = $request->validated();

        $contest = Contest::findOrFail($validate['contest_id']);

        foreach($validate['ids'] as $index => $id) {
            $contest->people()->updateExistingPivot($id, [
                'posicao' => $index + 1,
            ]);
        }

        return redirect()->back();
    }
}
