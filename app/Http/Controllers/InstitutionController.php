<?php

namespace App\Http\Controllers;

use App\Http\Requests\InstitutionRequest;
use Illuminate\Http\Request;
use App\Models\Institution;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $institutions = Institution::paginate();
        return view('institutions.index', [
            'institutions' => $institutions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('institutions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\InstitutionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InstitutionRequest $request)
    {
        $validated = $request->validated();
        $institution = Institution::create($validated);

        return redirect()->route('institutions.index', $institution->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Institution $institution)
    {
        return view('institutions.edit')->with('institution', $institution);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InstitutionRequest $request, $id)
    {
        $institution = Institution::find($id);

        if(!$institution)
            return redirect()->back();
        $institution->update($request->validate());
        return redirect()->route('institutions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institution = Institution::find($id);
        if(!$institution)
            return redirect()->back();
        $institution->delete();
        return redirect()->route('institutions.index');
    }

    /**
     * Search institution
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $institution = new Institution;
        $institutions = $institution->search($request->filter);

        return view('institutions.index', [
            'institutions' => $institutions,
            'filters'      => $filters,
        ]);
    }
}
