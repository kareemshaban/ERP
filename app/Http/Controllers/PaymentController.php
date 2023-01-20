<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Purchase;
use App\Models\Sales;
use Illuminate\Support\Facades\Auth;


class PaymentController extends Controller
{
    public function getSalesPayments($id){
        $payments = Payment::where('sale_id',$id)
            ->where('sale_id','<>',null)->get();
        $html = view('sales.payments',compact('payments'))->render();
        return $html;
    }

    public function addSalePayment($id){
        $sale = Sales::find($id);

        if($sale->net < 0){
            $sale->net = $sale->net*-1;
            $sale->paid = $sale->paid*-1;
        }

        $remain = $sale->net - $sale->paid;

        $html = view('sales.add_payment',compact('remain','id'))->render();
        return $html;
    }

    public function storeSalePayment(StorePaymentRequest $request, $id){

        $sale = Sales::find($id);
        $amount = $request->amount;
        $net = $sale->net;

        if($sale->net < 0){
            $amount = $amount*-1;
            $net = $net*-1;
        }

        Payment::create([
            'date' => $request->date,
            'purchase_id' => null,
            'sale_id' => $id,
            'company_id' => $sale->customer_id,
            'amount' => $amount,
            'paid_by' => $request->paid_by,
            'remain' => $net - $request->amount,
            'user_id' => Auth::user() ? Auth::id() : 0
        ]);


        $paid = $sale->paid + $amount;
        $sale->update([
            'paid' => $paid
        ]);

        $clientController = new ClientMoneyController();
        $clientController->syncMoney($sale->customer_id,0,$request->amount);

        return redirect()->route('sales');
    }

    public function deleteSalePayment($id){
        $payment = Payment::find($id);
        $sale = Sales::find($payment->sale_id);

        Payment::destroy($id);

        $paid = $sale->paid - $payment->amount;

        $sale->update([
            'paid' => $paid
        ]);

        $clientController = new ClientMoneyController();
        $clientController->syncMoney($sale->customer_id,0,$payment->amount * -1);


        return redirect()->route('sales');
    }


    public function getPurchasesPayments($id){
        $payments = Payment::where('purchase_id',$id)
            ->where('purchase_id','<>',null)->get();
        $html = view('purchases.payments',compact('payments'))->render();
        return $html;
    }

    public function addPurchasesPayment($id){
        $sale = Purchase::find($id);

        if($sale->net < 0){
            $sale->net = $sale->net*-1;
            $sale->paid = $sale->paid*-1;
        }

        $remain = $sale->net - $sale->paid;

        $html = view('purchases.add_payment',compact('remain','id'))->render();
        return $html;
    }

    public function storePurchasesPayment(StorePaymentRequest $request, $id){

        $sale = Purchase::find($id);
        $amount = $request->amount;
        $net = $sale->net;

        if($sale->net < 0){
            $amount = $amount*-1;
            $net = $net*-1;
        }

        Payment::create([
            'date' => $request->date,
            'sale_id' => null,
            'purchase_id' => $id,
            'company_id' => $sale->customer_id,
            'amount' => $amount,
            'paid_by' => $request->paid_by,
            'remain' => $net - $request->amount,
            'user_id' => Auth::user() ? Auth::id() : 0
        ]);


        $paid = $sale->paid + $amount;
        $sale->update([
            'paid' => $paid
        ]);

        $clientController = new ClientMoneyController();
        $clientController->syncMoney($sale->customer_id,0,$request->amount);

        return redirect()->route('purchases');
    }

    public function deletePurchasesPayment($id){
        $payment = Payment::find($id);
        $sale = Purchase::find($payment->sale_id);

        Payment::destroy($id);

        $paid = $sale->paid - $payment->amount;

        $sale->update([
            'paid' => $paid
        ]);

        $clientController = new ClientMoneyController();
        $clientController->syncMoney($sale->customer_id,0,$payment->amount * -1);


        return redirect()->route('purchases');
    }
}
