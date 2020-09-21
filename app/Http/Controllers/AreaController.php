<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Http\Requests\AreaRequest;
use App\Departament;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::paginate();
        return view('areas.index', [
            'areas' => $areas,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departamentos = Departament::all()->sortBy('departamento')
            ->pluck('departamento', 'id')->prepend('Selecione...', '');
        $area = New Area;
        return view('areas.create')->with([
            'area' => $area,
            'departamentos' => $departamentos
        ]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AreaRequest $request)
    {
        //$validated = $request->validated();
        $area = Area::create($request->only('departament_id','area'));

        return redirect()->route('areas.index', $area->id);
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
    public function edit(Area $area)
    {
        $departamentos = Departament::all()->sortBy('departamento')
            ->pluck('departamento', 'id')->prepend('Selecione...', '');
        return view('areas.edit')->with([
            'area' => $area,
            'departamentos' => $departamentos,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AreaRequest $request, $id)
    {
        $area = Area::find($id);
        if(!$area)
            return redirect()->back();
        $area->update($request->only('departament_id', 'area'));
        return redirect()->route('areas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $area = Departament::find($id);
        if(!$area)
            return redirect()->back();
        $area->delete();
        return redirect()->route('areas.index');
    }

    /**
     * Search area
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $area = new Area;
        $areas = $area->search($request->filter);

        return view('departaments.index', [
            'areas' => $areas,
            'filters'      => $filters,
        ]);
    }
}
