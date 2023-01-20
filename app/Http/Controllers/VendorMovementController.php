<?php

namespace App\Http\Controllers;

use App\Models\VendorMovement;
use App\Http\Requests\StoreVendorMovementRequest;
use App\Http\Requests\UpdateVendorMovementRequest;

class VendorMovementController extends Controller
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
     * @param  \App\Http\Requests\StoreVendorMovementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVendorMovementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\VendorMovement  $vendorMovement
     * @return \Illuminate\Http\Response
     */
    public function show(VendorMovement $vendorMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VendorMovement  $vendorMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(VendorMovement $vendorMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorMovementRequest  $request
     * @param  \App\Models\VendorMovement  $vendorMovement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVendorMovementRequest $request, VendorMovement $vendorMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VendorMovement  $vendorMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(VendorMovement $vendorMovement)
    {
        //
    }
}
