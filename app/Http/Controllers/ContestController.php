<?php

namespace App\Http\Controllers;

use App\Models\Contest;
use App\Models\Departament;
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
        //
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
        return view('contests.edit')->with([
            'contest' => $contest,
            'departamentos' => $departamentos,
            'qtdeOptions' => Contest::qtdeOptions(),
        ]);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
