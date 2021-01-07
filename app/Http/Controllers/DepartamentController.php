<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentRequest;
use Illuminate\Http\Request;
use App\Models\Departament;

class DepartamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departaments = Departament::paginate();
        return view('departaments.index', [
            'departaments' => $departaments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departaments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartamentRequest $request)
    {
        $validated = $request->validated();
        $departament = Departament::create($validated);

        return redirect()->route('departaments.index', $departament->id);
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
    public function edit(Departament $departament)
    {
        return view('departaments.edit')->with('departament', $departament);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartamentRequest $request, $id)
    {
        $departament = Departament::find($id);
        if(!$departament)
            return redirect()->back();
        $departament->update($request->validated());
        return redirect()->route('departaments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departament = Departament::find($id);
        if(!$departament)
            return redirect()->back();
        $departament->delete();
        return redirect()->route('departaments.index');
    }

    /**
     * Search departament
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $departament = new Departament;
        $departaments = $departament->search($request->filter);

        return view('departaments.index', [
            'departaments' => $departaments,
            'filters'      => $filters,
        ]);
    }
}
