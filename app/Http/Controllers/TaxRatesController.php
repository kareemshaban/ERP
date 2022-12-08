<?php

namespace App\Http\Controllers;

use App\Models\TaxRates;
use App\Http\Requests\StoreTaxRatesRequest;
use App\Http\Requests\UpdateTaxRatesRequest;

class TaxRatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreTaxRatesRequest $request)
    {
        //
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
    public function edit(TaxRates $taxRates)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTaxRatesRequest  $request
     * @param  \App\Models\TaxRates  $taxRates
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTaxRatesRequest $request, TaxRates $taxRates)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaxRates  $taxRates
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaxRates $taxRates)
    {
        //
    }
}
