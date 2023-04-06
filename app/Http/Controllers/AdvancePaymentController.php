<?php

namespace App\Http\Controllers;

use App\Models\AdvancePayment;
use App\Http\Requests\StoreAdvancePaymentRequest;
use App\Http\Requests\UpdateAdvancePaymentRequest;
use App\Models\AdvancePaymentMonth;
use App\Models\Employer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvancePaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $payments = AdvancePayment::query()->orderByDesc('created_at')->get();

        return view('advance_payment.index',compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employers = Employer::query()->orderByDesc('created_at')->get();
        return view('advance_payment.create',compact('employers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {



        $payment = AdvancePayment::create([
            'employer_id' => $request->employer_id,
            'date' => $request->date,
            'amount' => $request->amount,
            'advance_amount' => $request->advance_amount,
            'remain' => $request->amount,
            'user_id' => Auth::user()->id
        ]);

        $monthCount = $payment->remain / $payment->advance_amount;

        $today = Carbon::createFromFormat('Y-m-d', $payment->date );

        $remain = $payment->remain;
        $j = 0;
        for ($i=0;$i < $monthCount ; $i++){
            AdvancePaymentMonth::create([
                'advance_payment_id' => $payment->id,
                'amount' => $remain >  $payment->advance_amount ? $payment->advance_amount : $remain,
                'state' => 0,
                'month' => $today->addMonths($j)
            ]);
            $j = 1;
            $remain = $remain - $payment->advance_amount;
        }

        return redirect()->route('advance_payments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $catchReceipt = AdvancePayment::find($id);
        return view('advance_payment.show',compact('catchReceipt'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advancePayment = AdvancePayment::find($id);
        $employers = Employer::query()->orderByDesc('created_at')->get();

        return view('advance_payment.update',compact('advancePayment','employers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $advancePayment = AdvancePayment::find($id);
        $count = AdvancePaymentMonth::query()
            ->where('advance_payment_id',$advancePayment->id)
            ->where('state',1)
            ->get()
            ->count();

        if($count > 0){
            return redirect()->back()->withErrors('لا يمكن تعديل سند تم عمل له اصدار راتب');
        }


        $advancePayment->update([
            'employer_id' => $request->employer_id,
            'date' => $request->date,
            'amount' => $request->amount,
            'advance_amount' => $request->advance_amount,
            'remain' => $request->amount,
            'type' => $request->type,
            'bank_id' => $request->bank_id,
            'section_id' => $request->section_id
        ]);


        AdvancePaymentMonth::destroy(AdvancePaymentMonth::query()->where('advance_payment_id',$advancePayment->id)
            ->get()->pluck('id','id'));

        $monthCount = $advancePayment->remain / $advancePayment->advance_amount;
        $today = Carbon::createFromFormat('Y-m-d', $advancePayment->date );
        $remain= $advancePayment->remain;
        $j = 0;
        for ($i=0;$i < $monthCount ; $i++){
            AdvancePaymentMonth::create([
                'advance_payment_id' => $advancePayment->id,
                'amount' => $remain > $advancePayment->advance_amount ? $advancePayment->advance_amount : $remain,
                'state' => 0,
                'month' => $today->addMonths($j)
            ]);
            $j = 1;
            $remain = $remain - $advancePayment->advance_amount;
        }

        return redirect()->route('advance_payments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdvancePayment  $advancePayment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdvancePayment::destroy($id);
    }


}
