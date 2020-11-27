<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PeopleRequest;
use App\Models\People;
use App\Models\Institution;
use App\Models\Designation;
use App\Models\Contact;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = People::with('contacts')->paginate();
        return view('people.index', [
            'peoples' => $peoples,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('people.create', [
            'institutions' => $this->institution(),
            'designations' => $this->designation(),
            'estados' => People::estadoOptions(),
            'contacts' => $this->contact(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeopleRequest $request)
    {
        $people = People::create($request->validated());
        return redirect()->route('people.edit', $people->id);
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
    public function edit(People $person)
    {
        return view('people.edit')->with([
            'people' => $person,
            'institutions' => $this->institution(),
            'designations' => $this->designation(),
            'estados' => People::estadoOptions(),
            'contacts' => $this->contact(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PeopleRequest $request, $id)
    {
        $people = People::find($id);
        if(!$people)
            return redirect()->back();
        $people->update($request->validated());
        return redirect()->route('people.edit', $people->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $people = People::find($id);
        if(!$people)
            return redirect()->back();
        $people->delete();
        return redirect()->route('people.index');
    }

    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $people = new People;
        $peoples = $people->search($request->filter);

        return view('peoples.index', [
            'peoples' => $peoples,
            'filters' => $filters,
        ]);
    }

    private function institution()
    {
        return Institution::all()->sortBy('nome')->pluck('nome', 'id')
                                 ->prepend('Selecione...', '');
    }

    private function designation()
    {
        return Designation::all()->sortBy('nome')->pluck('nome', 'id')
                                 ->prepend('Selecione...', '');
    }

    private function contact()
    {
        return Contact::all()->sortBy('nome')->pluck('nome', 'id')
                             ->prepend('Selecione...', '');
    }
}
