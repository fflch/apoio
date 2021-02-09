<?php

namespace App\Http\Controllers;

use App\Models\Surrogate;
use App\Models\Holder;
use App\Models\People;
use App\Models\Departament;
use Illuminate\Http\Request;

class SurrogateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filters = $request->all();
        $surrogates = Surrogate::where('pertence', $filters['filter'] ?? 'CTA')
            ->with('people','holder')->paginate();
        return view('surrogates.index', [
            'surrogates' => $surrogates,
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
        $departamentos = Departament::all()->sortBy('nome')->pluck('nome', 'id');
        $surrogate = new Surrogate();
        return view('surrogates.create')->with([
            'surrogate' => $surrogate,
            'departamentos' => $departamentos,
            'pertenceOptions' => Holder::pertenceOptions(),
            'statusOptions' => Holder::statusOptions(),
            'readyonly' => false,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SurrogateRequest $request)
    {
        $surrogate = Surrogate::create($request->validated());
        return redirect()->route('surrogates.index', $surrogate->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Surrogate  $surrogate
     * @return \Illuminate\Http\Response
     */
    public function show(Surrogate $surrogate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Surrogate  $surrogate
     * @return \Illuminate\Http\Response
     */
    public function edit(Surrogate $surrogate)
    {
        $departamentos = Departament::all()->sortBy('nome')->pluck('nome', 'id');
        return view('surrogates.edit')->with([
            'surrogate' => $surrogate,
            'departamentos' => $departamentos,
            'pertenceOptions' => Holder::pertenceOptions(),
            'statusOptions' => Holder::statusOptions(),
            'readyonly' => true,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Surrogate  $surrogate
     * @return \Illuminate\Http\Response
     */
    public function update(SurrogateRequest $request, $surrogate)
    {
        $surrogate = Surrogate::find($surrogate);
        if(!$surrogate)
            return redirect()->back();
        $surrogate->update($request->validated());
        return redirect()->route('surrogates.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Surrogate  $surrogate
     * @return \Illuminate\Http\Response
     */
    public function destroy($surrogate)
    {
        $surrogate = Surrogate::find($surrogate);
        if(!$surrogate)
            return redirect()->back();
        $surrogate->delete();
        return redirect()->route('surrogates.index');
    }

    public function getPeople(Request $request)
    {
        if($request->has('search')) {
            $people = People::orderby('nome','asc')->select('id','nome','nusp')
                      ->where('nome', 'like', '%' . $request->search . '%')
                      ->limit(5)->get();
        }
        $response = array();
        foreach($people as $person){
            $response[] = array(
                "value" => $person->id,
                "label" => $person->nome,
                "nusp"  => $person->nusp
            );
        }
        return response()->json($response);
    }
}
