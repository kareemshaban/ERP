<?php

namespace App\Http\Controllers;

use App\Models\AccountMovement;
use App\Http\Requests\StoreAccountMovementRequest;
use App\Http\Requests\UpdateAccountMovementRequest;

class AccountMovementController extends Controller
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
     * @param  \App\Http\Requests\StoreAccountMovementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountMovementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountMovement  $accountMovement
     * @return \Illuminate\Http\Response
     */
    public function show(AccountMovement $accountMovement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountMovement  $accountMovement
     * @return \Illuminate\Http\Response
     */
    public function edit(AccountMovement $accountMovement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountMovementRequest  $request
     * @param  \App\Models\AccountMovement  $accountMovement
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountMovementRequest $request, AccountMovement $accountMovement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountMovement  $accountMovement
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountMovement $accountMovement)
    {
        //
    }
}
