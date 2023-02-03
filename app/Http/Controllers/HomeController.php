<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\Purchase;
use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sales = Sales::where('sale_id' , '=' , 0 ) -> get();
        $purchases = Purchase::where('returned_bill_id' , '=' , 0 ) -> get();
        $expenses = Expenses::all();
        $sales_total = 0 ;
        $sales_tax = 0 ;
        $purchase_total = 0 ;
        $total_expenses = 0 ;
       foreach ($sales as $bill){
           if(Carbon::parse($bill -> date) -> format('d-m-y') == Carbon::now() -> format('d-m-y') ) {
               $sales_total += $bill->net;
               $sales_tax += $bill->tax;
           }
       }
        foreach ($purchases as $bill){
            if(Carbon::parse($bill -> date) -> format('d-m-y') == Carbon::now() -> format('d-m-y') ) {
                $purchase_total += $bill->net;
            }
        }
        foreach ($expenses as $bill){
            if(Carbon::parse($bill -> date) -> format('d-m-y') == Carbon::now() -> format('d-m-y') ){
                $total_expenses += $bill -> amount ;
            }

        }




        return view('home' , compact('sales_total' , 'sales_tax' , 'purchase_total' , 'total_expenses'));
    }
}
