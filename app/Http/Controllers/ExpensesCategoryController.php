<?php

namespace App\Http\Controllers;

use App\Models\AccountsTree;
use App\Models\Currency;
use App\Models\ExpensesCategory;
use App\Http\Requests\StoreExpensesCategoryRequest;
use App\Http\Requests\UpdateExpensesCategoryRequest;
use http\Env\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class ExpensesCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = ExpensesCategory::with('account') -> get();
        $accounts = AccountsTree::query()->where('type','>',1)->get();
        return view('Expenses.index' , ['expenses' => $expenses , 'accounts' => $accounts]);
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
     * @param  \App\Http\Requests\StoreExpensesCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        if($request -> id == 0){
            $validated = $request->validate([
                'code' => 'required|unique:expenses_categories',
                'name' => 'required',
            ]);
            try {
                ExpensesCategory::create([
                    'code' => $request->code,
                    'name' => $request->name,
                    'account_id' => $request -> account_id
                ]);
                return redirect()->route('expenses')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('expenses')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ExpensesCategory $expensesCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = ExpensesCategory::find($id);
        echo json_encode ($expense);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpensesCategoryRequest  $request
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request)
    {
        $expense = ExpensesCategory::find($request -> id);
        if($expense ) {
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('expenses_categories')->ignore($request -> id)],
                'name' => 'required',
            ]);
            try {
                $expense -> update([
                    'code' => $request->code,
                    'name' => $request->name,
                    'account_id' => $request -> account_id
                ]);
                return redirect()->route('expenses')->with('success', __('main.updated'));
            } catch (QueryException $ex) {

                return redirect()->route('expenses')->with('error', $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expense = ExpensesCategory::find($id);
        if($expense ) {
            $expense -> delete();
            return redirect()->route('expenses')->with('success', __('main.deleted'));
        }
    }
}
