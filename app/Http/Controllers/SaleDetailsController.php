<?php

namespace App\Http\Controllers;

use App\Models\SaleDetails;
use App\Http\Requests\StoreSaleDetailsRequest;
use App\Http\Requests\UpdateSaleDetailsRequest;

class SaleDetailsController extends Controller
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
     * @param  \App\Http\Requests\StoreSaleDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSaleDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function show(SaleDetails $saleDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(SaleDetails $saleDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSaleDetailsRequest  $request
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSaleDetailsRequest $request, SaleDetails $saleDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleDetails  $saleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleDetails $saleDetails)
    {
        //
    }
}
