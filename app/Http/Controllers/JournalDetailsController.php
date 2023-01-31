<?php

namespace App\Http\Controllers;

use App\Models\JournalDetails;
use App\Http\Requests\StoreJournalDetailsRequest;
use App\Http\Requests\UpdateJournalDetailsRequest;

class JournalDetailsController extends Controller
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
     * @param  \App\Http\Requests\StoreJournalDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJournalDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JournalDetails  $journalDetails
     * @return \Illuminate\Http\Response
     */
    public function show(JournalDetails $journalDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JournalDetails  $journalDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(JournalDetails $journalDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJournalDetailsRequest  $request
     * @param  \App\Models\JournalDetails  $journalDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJournalDetailsRequest $request, JournalDetails $journalDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JournalDetails  $journalDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(JournalDetails $journalDetails)
    {
        //
    }
}
