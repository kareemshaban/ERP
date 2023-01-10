<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetails;
use App\Http\Requests\StorePurchaseDetailsRequest;
use App\Http\Requests\UpdatePurchaseDetailsRequest;

class PurchaseDetailsController extends Controller
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
     * @param  \App\Http\Requests\StorePurchaseDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseDetails  $purchaseDetails
     * @return \Illuminate\Http\Response
     */
    public function show(PurchaseDetails $purchaseDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseDetails  $purchaseDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetails $purchaseDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseDetailsRequest  $request
     * @param  \App\Models\PurchaseDetails  $purchaseDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePurchaseDetailsRequest $request, PurchaseDetails $purchaseDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseDetails  $purchaseDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseDetails $purchaseDetails)
    {
        //
    }
}
