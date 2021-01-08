<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holder;
use App\Http\Requests\HolderRequest;

class HolderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all();
        $holders = Holder::where('pertence', $filters['filter'] ?? 'CTA')
            ->with('people','designation')->paginate();
        return view('holders.index', [
            'holders' => $holders,
            'optionsFilters' => Holder::pertenceOptions(),
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
        return view('holders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HolderRequest $request)
    {
        $holder = Holder::create($request->validated());
        return redirect()->route('holders.index', $holder->id);
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
    public function edit(Holder $holder)
    {
        return view('holders.edit')->with('holder', $holder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HolderRequest $request, $id)
    {
        $validated = $request->validated();

        $holder = Holder::find($id);
        if(!$holder)
            return redirect()->back();
        $holder->update($validated);
        return redirect()->route('holders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $holder = Holder::find($id);
        if(!$holder)
            return redirect()->back();
        $holder->delete();
        return redirect()->route('holders.index');
    }
}
