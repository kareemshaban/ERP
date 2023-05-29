<?php

namespace App\Http\Controllers;

use App\Models\Deduction;
use App\Http\Requests\StoreDeductionRequest;
use App\Http\Requests\UpdateDeductionRequest;
use App\Models\Employer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $deductions = Deduction::orderByDesc('created_at')->get();
        return view('deductions.index',compact('deductions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $employers = Employer::query()->orderByDesc('created_at')->get();
        return view('deductions.create',compact('employers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Deduction::create([
            'employer_id' => $request->employer_id,
            'reason' => $request->reason == null ? '' : $request->reason,
            'amount' => $request->amount,
            'date' => $request->date,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('deduction.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function show(Deduction $deduction)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function edit(Deduction $deduction)
    {
        $employers = Employer::query()->orderByDesc('created_at')->get();
        return view('deductions.update',compact('deduction','employers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deduction $deduction)
    {
        $deduction->update([
            'employer_id' => $request->employer_id,
            'reason' => $request->reason == null ? '' : $request->reason,
            'amount' => $request->amount,
            'date' => $request->date
        ]);

        return redirect()->route('deduction.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Deduction  $deduction
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Deduction::destroy($id);

    }
}
