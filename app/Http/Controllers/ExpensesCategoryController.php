<?php

namespace App\Http\Controllers;

use App\Models\ExpensesCategory;
use App\Http\Requests\StoreExpensesCategoryRequest;
use App\Http\Requests\UpdateExpensesCategoryRequest;

class ExpensesCategoryController extends Controller
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
     * @param  \App\Http\Requests\StoreExpensesCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExpensesCategoryRequest $request)
    {
        //
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
    public function edit(ExpensesCategory $expensesCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateExpensesCategoryRequest  $request
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExpensesCategoryRequest $request, ExpensesCategory $expensesCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExpensesCategory  $expensesCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpensesCategory $expensesCategory)
    {
        //
    }
}
