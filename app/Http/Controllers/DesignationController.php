<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationRequest;
use App\Designation;
use Illuminate\Http\Request;


class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::paginate();
        return view('designations.index', [
            'designations' => $designations,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DesignationRequest $request)
    {
        $validated = $request->validated();
        $designation = Designation::create($validated);

        return redirect()->route('designations.index', $designation->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        return view('designations.edit')->with('designation', $designation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(DesignationRequest $request, $id)
    {
        $validated = $request->validated();

        $designation = Designation::find($id);
        if(!$designation)
            return redirect()->back();
        $designation->update($validated);
        return redirect()->route('designations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy($designation)
    {
        $designation = Designation::find($designation);
        if(!$designation)
            return redirect()->back();
        $designation->delete();
        return redirect()->route('designations.index');
    }
}
