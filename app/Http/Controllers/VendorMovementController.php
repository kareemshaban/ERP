<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Purchase;
use App\Models\Sales;
use App\Models\VendorMovement;
use App\Http\Requests\StoreVendorMovementRequest;
use App\Http\Requests\UpdateVendorMovementRequest;

class VendorMovementController extends Controller
{
    public function addSaleMovement($id){
        $sale = Sales::find($id);
        VendorMovement::create([
            'vendor_id' => $sale->customer_id,
            'paid' => 0,
            'credit' => $sale->net,
            'debit' => 0,
            'date' => $sale->date,
            'invoice_type' => 'Sales',
            'invoice_id' => $id,
            'invoice_no' => $sale->invoice_no,
            'paid_by' => ''
        ]);
    }

    public function addSalePaymentMovement($id){
        $payment = Payment::find($id);
        $sale = Sales::find($payment->sale_id);

        VendorMovement::create([
            'vendor_id' => $sale->customer_id,
            'paid' => 0,
            'credit' => 0,
            'debit' => $payment->amount,
            'date' => $payment->date,
            'invoice_type' => 'Sale_Payment',
            'invoice_id' => $id,
            'invoice_no' => $sale->invoice_no,
            'paid_by' => $payment->paid_by
        ]);
    }

    public function removeSalePaymentMovement($id){
        $vendorMovementId = VendorMovement::query()->where('invoice_id',$id)->get()->first();
        VendorMovement::destroy($vendorMovementId);
    }

    public function addPurchaseMovement($id){
        $sale = Purchase::find($id);
        VendorMovement::create([
            'vendor_id' => $sale->customer_id,
            'paid' => 0,
            'debit' => $sale->net,
            'credit' => 0,
            'date' => $sale->date,
            'invoice_type' => 'Purchases',
            'invoice_id' => $id,
            'invoice_no' => $sale->invoice_no,
            'paid_by' => ''
        ]);
    }

    public function removePurchaseMovement($id){
        $purchase = Purchase::find($id);



        $vendorMovementId = VendorMovement::query()->where('invoice_id',$id)->get()->first();
        VendorMovement::destroy($vendorMovementId);
    }

    public function addPurchasePaymentMovement($id){
        $payment = Payment::find($id);
        $sale = Purchase::find($payment->purchase_id);

        VendorMovement::create([
            'vendor_id' => $sale->customer_id,
            'paid' => 0,
            'debit' => 0,
            'credit' => $payment->amount,
            'date' => $payment->date,
            'invoice_type' => 'Purchase_Payment',
            'invoice_id' => $id,
            'invoice_no' => $sale->invoice_no,
            'paid_by' => $payment->paid_by
        ]);
    }

    public function removePurchasePaymentMovement($id){
        $vendorMovementId = VendorMovement::query()->where('invoice_id',$id)->get()->first();
        VendorMovement::destroy($vendorMovementId);
    }

}
