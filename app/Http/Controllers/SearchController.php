<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Holder;
use App\Models\People;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{

    public function searchPeople(Request $request)
    {
        $search = $request->search;
        if ($search === null || !isset($search)) {
            abort(400);
        }
        $people = People::orderby('nome','asc')->select('id','nome','nusp')
                  ->where('nome', 'like', '%' . $search . '%')
                  ->limit(5)->get();
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

    public function searchHolder(Request $request)
    {
        $search = $request->search;
        if ($search === null || !isset($search)) {
            abort(400);
        }
        $people = DB::table('people as p')->select('p.nome as titular',
                  'h.id as holder_id', 'd.nome as designation')
                  ->join('holders as h', 'p.id', '=', 'h.people_id')
                  ->join('designations as d', 'd.id', '=', 'h.designation_id')
                  ->where('p.nome', 'like', '%' . $search . '%')
                  ->limit(5)->get();
        $response = array();
        foreach($people as $person){
            $response[] = array(
                "value" => $person->holder_id,
                "label" => $person->titular,
                "designation"  => $person->designation,
            );
        }
        return response()->json($response);
    }
}
