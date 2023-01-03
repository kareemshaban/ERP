<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $units = Unit::all();
        if($type == 0)
        return view ('Units.index' , ['units' => $units] );
        else
            return view ('Units.index2' , ['units' => $units] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUnitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request -> id == 0){
            $validated = $request->validate([
                'code' => 'required|unique:brands',
                'name' => 'required',
            ]);
            try {
                Unit::create([
                    'code' => $request->code,
                    'name' => $request->name,
                    'isGold' => $request -> isGold,
                    'transformFactor' => $request -> transformFactor
                ]);
                return redirect()->route('units' , $request -> isGold)->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('units' , $request -> isGold)->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        echo json_encode ($unit);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUnitRequest  $request
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $unit = Unit::find($request -> id);
        if($unit ) {
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('units')->ignore($request -> id)],
                'name' => 'required',
            ]);
            try {
                $unit -> update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'isGold' => $request -> isGold,
                    'transformFactor' => $request -> transformFactor
                ]);
                return redirect()->route('units' , $request -> isGold)->with('success', __('main.updated'));
            } catch (QueryException $ex) {

                return redirect()->route('units' , $request -> isGold)->with('error', $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $unit = Unit::find($id);
        if($unit){
            $unit -> delete();
            return redirect()->route('units' , $unit -> isGold)->with('success', __('main.deleted'));
        }
    }
}
