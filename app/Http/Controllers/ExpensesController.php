<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use App\Models\ExpensesCategory;
use App\Models\SystemSettings;
use App\Models\Warehouse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills = DB::table('expenses')
            -> join('warehouses' , 'expenses.warehouse_id' , '=' , 'warehouses.id')
            -> join('expenses_categories' , 'expenses.expenses_category' , '=' , 'expenses_categories.id')
            -> join('users' , 'expenses.user_created' , '=' , 'users.id')
            -> select('expenses.*' , 'warehouses.name as warehouse_name' , 'expenses_categories.name as category_name' , 'users.name as user_name')
            -> get();

        return view('ExpensesBill.index' , compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenses = ExpensesCategory::all();
        $warehouses = Warehouse::all();
        $bill_number = $this -> getNo() ;
        return view('ExpensesBill.create',compact('expenses' , 'warehouses','bill_number'))->render();

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bill_number' => 'required|unique:expenses',
            'expenses_category' => 'required',
            'warehouse_id' => 'required',
            'amount' => 'required',
            'payment_type' => 'required'
        ]);
        try {
            Expenses::create([
                'date' => $request -> date,
                'bill_number' => $request -> bill_number,
                'expenses_category' => $request -> expenses_category,
                'warehouse_id' => $request -> warehouse_id,
                'amount' => $request -> amount,
                'payment_type' => $request -> payment_type,
                'notes' => $request -> notes ?? '',
                'user_created' => Auth::user() -> id
            ]);
            return redirect()->route('box_expenses_list') -> with('success' , __('main.created'));
        } catch (QueryException $ex){
            return redirect()->route('box_expenses_list')->with('error' ,  $ex->getMessage());
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bill = Expenses::find($id);
        $expenses = ExpensesCategory::all();
        $warehouses = Warehouse::all();
        return view('ExpensesBill.view',compact('expenses' , 'warehouses','bill'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }

    public function getNo(){
        $bills = Expenses::orderBy('id', 'ASC')->get();
        if(count($bills) > 0){
            $id = $bills[count($bills) -1] -> id ;
        } else
            $id = 0 ;
        $settings = SystemSettings::all();
        $prefix = "";
        if(count($settings) > 0){
            if($settings[0] -> expenses_prefix)
                $prefix =     $settings[0] -> expenses_prefix ;
            else
                $prefix = "" ;
        } else {
            $prefix = "";
        }
        $no = $prefix . str_pad($id + 1, 6 , '0' , STR_PAD_LEFT) ;

        return $no ;
    }

}
