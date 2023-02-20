<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Warehouse;
use App\Http\Requests\StoreWarehouseRequest;
use App\Http\Requests\UpdateWarehouseRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        return view('warehouse.index' , ['warehouses' => $warehouses]);
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
     * @param  \App\Http\Requests\StoreWarehouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usersCount = DB::table('users')->get()->count();
        $maxUsers = DB::table('system_settings')->select('max_branches')->get()->first()->max_branches;

        if($usersCount >= $maxUsers && $request -> id == 0){
            return redirect()->back()->with('error',__('main.max_warehouse'));
        }


        if($request -> id == 0){
            $validated = $request->validate([
                'code' => 'required|unique:warehouses',
                'name' => 'required',
            ]);
            try {
                Warehouse::create([
                    'code' => $request->code,
                    'name' => $request->name,
                    'phone' => $request->phone ? $request->phone : ' ' ,
                    'email' => $request->email ? $request->email : ' ',
                    'address' => $request->address ? $request->address : ' ',
                    'tax_number' => $request->tax_number ?? ' ',
                    'commercial_registration' => $request->commercial_registration ??  ' ',
                    'serial_prefix' => $request->serial_prefix ?? ' ',
                ]);
                return redirect()->route('warehouses')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('warehouses')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::find($id );
        echo json_encode ($warehouse);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseRequest  $request
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $warehouse = Warehouse::find($request -> id);
        if($warehouse){
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('warehouses')->ignore($request -> id)],
                'name' => 'required',
            ]);
            try {
            $warehouse -> update([
                'code' => $request->code,
                'name' => $request->name,
                'phone' => $request->phone ? $request->phone : ' ' ,
                'email' => $request->email ? $request->email : ' ',
                'address' => $request->address ? $request->address : ' ',
                'tax_number' => $request->tax_number ?? ' ',
                'commercial_registration' => $request->commercial_registration ??  ' ',
                'serial_prefix' => $request->serial_prefix ?? ' ',
            ]);
                return redirect()->route('warehouses')->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('warehouses')->with('error' ,  $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id );
        if($warehouse){
            $warehouse -> delete();
            return redirect()->route('warehouses')->with('success' , __('main.deleted'));
        }
    }
}
