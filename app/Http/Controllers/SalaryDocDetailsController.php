<?php

namespace App\Http\Controllers;

use App\Models\SalaryDocDetails;
use App\Http\Requests\StoreSalaryDocDetailsRequest;
use App\Http\Requests\UpdateSalaryDocDetailsRequest;

class SalaryDocDetailsController extends Controller
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
     * @param  \App\Http\Requests\StoreSalaryDocDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalaryDocDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SalaryDocDetails  $salaryDocDetails
     * @return \Illuminate\Http\Response
     */
    public function show(SalaryDocDetails $salaryDocDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SalaryDocDetails  $salaryDocDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(SalaryDocDetails $salaryDocDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaryDocDetailsRequest  $request
     * @param  \App\Models\SalaryDocDetails  $salaryDocDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSalaryDocDetailsRequest $request, SalaryDocDetails $salaryDocDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SalaryDocDetails  $salaryDocDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(SalaryDocDetails $salaryDocDetails)
    {
        //
    }
}
