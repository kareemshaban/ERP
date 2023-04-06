<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Reward;
use App\Http\Requests\StoreRewardRequest;
use App\Http\Requests\UpdateRewardRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $rewards = Reward::query()->orderByDesc('created_at')->get();
        return view('rewards.index',compact('rewards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employers = Employer::query()->orderByDesc('created_at')->get();
        return view('rewards.create',compact('employers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Reward::create([
            'employer_id' => $request->employer_id,
            'reason' => $request->reason == null ? '' : $request->reason,
            'amount' => $request->amount,
            'date' => $request->date,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('reward.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function edit(Reward $reward)
    {
        $employers = Employer::query()->orderByDesc('created_at')->get();
        return view('rewards.update',compact('reward','employers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        $reward->update([
            'employer_id' => $request->employer_id,
            'reason' => $request->reason == null ? '' : $request->reason,
            'amount' => $request->amount,
            'date' => $request->date
        ]);

        return redirect()->route('reward.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reward::destroy($id);
    }
}
