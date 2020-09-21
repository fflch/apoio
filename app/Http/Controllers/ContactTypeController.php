<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactType;
use App\Http\Requests\ContactTypeRequest;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact_types = ContactType::paginate();
        return view('contact_types.index', [
            'contact_types' => $contact_types,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact_types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactTypeRequest $request)
    {
        $validated = $request->validated();
        $contact_type = ContactType::create($validated);

        return redirect()->route('contact_types.index', $contact_type->id);
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
    public function edit(ContactType $contact_type)
    {
        return view('contact_types.edit')->with('contact_type', $contact_type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactTypeRequest $request, $id)
    {
        $validated = $request->validated();

        $contact_type = ContactType::find($id);
        if(!$contact_type)
            return redirect()->back();
        $contact_type->update($validated);
        return redirect()->route('contact_types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($contact_type)
    {
        $contact_type = ContactType::find($contact_type);
        if(!$contact_type){
            return redirect()->back();
        };
        $contact_type->delete();
        return redirect()->route('contact_types.index');
    }

    /**
     * Search contact_type
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $contact_type = new ContactType;
        $contact_types = $contact_type->search($request->filter);

        return view('contact_types.index', [
            'contact_types' => $contact_types,
            'filters'      => $filters,
        ]);
    }

}
