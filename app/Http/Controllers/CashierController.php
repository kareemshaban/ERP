<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cashiers = Cashier::all();
        return view('cashier.index', ['cashiers' => $cashiers]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request -> id == 0){
            $validated = $request->validate([
                'company' => 'required',
                'name' => 'required'
            ]);
            try {
                Cashier::create([
                    'company' => $request -> company,
                    'license' => '',
                    'name' => $request->name,
                    'address' => $request-> address ,
                    'email' => $request -> email,
                    'phone' => $request -> phone ,
                    'commercial_register' =>$request -> commercial_register,
                    'tax_number' =>$request -> tax_number,
                    'bill_holder1' =>$request -> bill_holder1,
                    'bill_holder2' =>$request -> bill_holder2,
                ]);
                return redirect()->route('cashiers' , $request -> type)->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('cashiers' , $request -> type)->with('error' ,  $ex->getMessage());
            }
        } else {
            return   $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function show(Cashier $cashier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cashier = Cashier::find($id);
        echo json_encode ($cashier);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $cashier = Cashier::find($request -> id);
        if($cashier){
            $validated = $request->validate([
                'company' => 'required',
                'name' => 'required'
            ]);
            try {
                $cashier -> update([
                    'company' => $request -> company,
                    'license' => '',
                    'name' => $request->name,
                    'address' => $request-> address ,
                    'email' => $request -> email,
                    'phone' => $request -> phone ,
                    'commercial_register' =>$request -> commercial_register,
                    'tax_number' =>$request -> tax_number,
                    'bill_holder1' =>$request -> bill_holder1,
                    'bill_holder2' =>$request -> bill_holder2,
                ]);
                return redirect()->route('cashiers' , $request -> type)->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('cashiers' , $request -> type)->with('error' ,  $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cashier  $cashier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cashier $cashier)
    {
        //
    }
}
