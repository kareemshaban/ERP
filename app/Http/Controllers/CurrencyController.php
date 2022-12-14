<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Currency;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currencies = Currency::all();
        return view('currency.index' , ['currencies' => $currencies]);
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
     * @param  \App\Http\Requests\StoreCurrencyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request -> id == 0){
            $validated = $request->validate([
                'code' => 'required|unique:currencies',
                'name' => 'required',
                'symbol' => 'required|unique:currencies',
            ]);
            try {
                Currency::create([
                    'code' => $request->code,
                    'name' => $request->name,
                    'symbol' => $request -> symbol
                ]);
                return redirect()->route('currency')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('currency')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency = Currency::find($id);
        echo json_encode ($currency);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCurrencyRequest  $request
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $currency = Currency::find($request -> id);
        if($currency ) {
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('currencies')->ignore($request -> id)],
                'symbol' => ['required' , Rule::unique('currencies')->ignore($request -> id)],
                'name' => 'required',
            ]);
            try {
                $currency -> update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'symbol' => $request -> symbol
                ]);
                return redirect()->route('currency')->with('success', __('main.updated'));
            } catch (QueryException $ex) {

                return redirect()->route('currency')->with('error', $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $currency = Currency::find($id);
        if($currency){
            $currency -> delete();
            return redirect()->route('currency')->with('success', __('main.deleted'));
        }

    }
}
