<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Departament;
use App\Models\Area;
//use App\Models\Commission;
use Illuminate\Http\Request;
use App\Http\Requests\ContestRequest;

class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all();
        $contests = Contest::where('status', $filters['filter'] ?? 'C')->paginate();
        return view('contests.index', [
            'contests' => $contests,
            'optionsFilters' => Contest::statusOptions(),
            'filters' => $filters,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departament::all()->sortBy('nome')
            ->pluck('nome', 'id')->prepend('Selecione...', '');
        $contest = New Contest;
        return view('contests.create')->with([
            'contest' => $contest,
            'departamentos' => $departamentos,
            'areas' => array(),
            'qtdeOptions' => Contest::qtdeOptions(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContestRequest $request)
    {
        $contest = Contest::create($request->validated());
        return redirect()->route('contests.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        $commission = $contest->load('people');
            dd($commission);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        $departamentos = Departament::all()->sortBy('nome')
                                           ->pluck('nome', 'id');
        #$areas = Area::all()->sortBy('nome')->pluck('nome', 'id');
        $areas = Area::where('departament_id', $contest->departament_id)
                       ->orderby('nome','asc')->pluck('nome','id')
                       ->prepend('Selecione a Área', '');
        return view('contests.edit')->with([
            'contest' => $contest,
            'departamentos' => $departamentos,
            'areas' => $areas,
            'qtdeOptions' => Contest::qtdeOptions(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ContestRequest  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(ContestRequest $request, $id)
    {
        $contest = Contest::find($id);
        if(!$contest)
            return redirect()->back();
        $contest->update($request->validated());
        return redirect()->route('contests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    //public function destroy(Contest $contest)
    public function destroy($id)
    {
        $contest = Contest::find($id);
        if(!$contest)
            return redirect()->back();
        $contest->delete();
        return redirect()->route('contests.index');
    }

    public function getarea(Request $request)
    {
        if($request->has('search')) {
            $areas = Area::where('departament_id', $request->search)
                      ->orderby('nome','asc')->get();
        }
        $response = array();
        foreach($areas as $area){
            $response[] = array(
                "nome" => $area->nome,
            );
        }
        return response()->json($response);
    }
}
