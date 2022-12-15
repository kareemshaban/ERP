<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\TaxRates;
use App\Http\Requests\StoreTaxRatesRequest;
use App\Http\Requests\UpdateTaxRatesRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class TaxRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taxes = TaxRates::all();
        return view('TaxRates.index' , ['taxes' => $taxes]);
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
     * @param  \App\Http\Requests\StoreTaxRatesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request -> id == 0){
            $validated = $request->validate([
                'code' => 'required|unique:tax_rates',
                'name' => 'required',
                'rate' => 'required',
                'type' => 'required'
            ]);
            try {
                TaxRates::create([
                    'code' => $request->code,
                    'name' => $request->name,
                    'rate' => $request->rate,
                    'type' => $request->type,
                ]);
                return redirect()->route('taxRates')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('taxRates')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TaxRates  $taxRates
     * @return \Illuminate\Http\Response
     */
    public function show(TaxRates $taxRates)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TaxRates  $taxRates
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tax = TaxRates::find( $id);
        echo json_encode ($tax);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxRatesRequest  $request
     * @param  \App\Models\TaxRates  $taxRates
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $tax = TaxRates::find($request -> id);
        if($tax){
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('tax_rates')->ignore($request -> id)],
                'name' => 'required',
                'rate' => 'required',
                'type' => 'required'
            ]);
            try {
                $tax -> update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'rate' => $request->rate,
                    'type' => $request->type,
                ]);
                return redirect()->route('taxRates')->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('taxRates')->with('error' ,  $ex->getMessage());
            }


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxRates  $taxRates
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tax = TaxRates::find( $id);
        if($tax){
            $tax -> delete();
            return redirect()->route('taxRates')->with('success' , __('main.deleted'));
        }
    }
}
