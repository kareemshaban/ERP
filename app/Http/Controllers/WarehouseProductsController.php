<?php

namespace App\Http\Controllers;

use App\Models\WarehouseProducts;
use App\Http\Requests\StoreWarehouseProductsRequest;
use App\Http\Requests\UpdateWarehouseProductsRequest;

class WarehouseProductsController extends Controller
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
     * @param  \App\Http\Requests\StoreWarehouseProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWarehouseProductsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WarehouseProducts  $warehouseProducts
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseProducts $warehouseProducts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WarehouseProducts  $warehouseProducts
     * @return \Illuminate\Http\Response
     */
    public function edit(WarehouseProducts $warehouseProducts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWarehouseProductsRequest  $request
     * @param  \App\Models\WarehouseProducts  $warehouseProducts
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWarehouseProductsRequest $request, WarehouseProducts $warehouseProducts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WarehouseProducts  $warehouseProducts
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseProducts $warehouseProducts)
    {
        //
    }
}
