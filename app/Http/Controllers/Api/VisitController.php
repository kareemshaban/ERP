<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\visit;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    //
    public function createVisit(Request $request){
        $validated = $request->validate([
            'rep_id' => 'required',
            'client_id' => 'required',
            'type' => 'required',
            'date' => 'required',
        ]);
        try {
            visit::create([
                'rep_id' => $request -> rep_id,
                'client_id' => $request -> client_id,
                'type' => $request -> type,
                'date' => $request -> date,
                'state' => 0,
                'notes' => '',
            ]);
            return response(['msg' => 'success'], 200);
        } catch (QueryException $ex){
            return response(['error' => $ex -> getMessage()], 500);
        }

    }
}
