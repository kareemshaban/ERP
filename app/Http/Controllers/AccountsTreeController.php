<?php

namespace App\Http\Controllers;

use App\Models\AccountsTree;
use App\Http\Requests\StoreAccountsTreeRequest;
use App\Http\Requests\UpdateAccountsTreeRequest;
use App\Models\Journal;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccountsTreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = AccountsTree::all();
        return view('accounts.index',compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $accounts = AccountsTree::all();
        return view('accounts.create',compact('accounts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAccountsTreeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountsTreeRequest $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:accounts_trees',
            'name' => 'required|unique:accounts_trees',
        ]);

        if(!$request->has('parent_id')){
            $request->parent_id = 0;
        }

        $parentId = $request->parent_id;
        $parentCode = '';
        if($parentId > 0){
            $parentCode = AccountsTree::find($parentId)->code;
        }


        AccountsTree::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'parent_id' => $parentId,
            'parent_code' => $parentCode,
            'level' => $request->level,
            'list' => $request->list,
            'department' => $request->department,
            'side' => $request->side
        ]);

        return redirect()->route('accounts_list');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AccountsTree  $accountsTree
     * @return \Illuminate\Http\Response
     */
    public function show(AccountsTree $accountsTree)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AccountsTree  $accountsTree
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accounts = AccountsTree::all();
        $account = AccountsTree::find($id);
        return view('accounts.update',compact('accounts','account'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAccountsTreeRequest  $request
     * @param  \App\Models\AccountsTree  $accountsTree
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountsTreeRequest $request, $id)
    {
        $validated = $request->validate([
            'code' => ['required' , Rule::unique('accounts_trees')->ignore($id)],
            'name' => ['required' , Rule::unique('accounts_trees')->ignore($id)],
        ]);

        if(!$request->has('parent_id')){
            $request->parent_id = 0;
        }

        $parentId = $request->parent_id;
        $parentCode = '';
        if($parentId > 0){
            $parentCode = AccountsTree::find($parentId)->code;
        }


        $account =AccountsTree::find($id);
            $account->update([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'parent_id' => $parentId,
            'parent_code' => $parentCode,
            'level' => $request->level,
            'list' => $request->list,
            'department' => $request->department,
            'side' => $request->side
        ]);

        return redirect()->route('accounts_list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AccountsTree  $accountsTree
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountsTree $accountsTree)
    {
        //
    }

    public function getLevel($parent){
        $account = AccountsTree::find($parent);
        return response()->json(['account' => $account]);
    }


    public function journals(){
        $journals = DB::table('journals')
            ->join('journal_details','journals.id','=','journal_details.journal_id')
            ->select('journals.id','journals.date','journals.basedon_no',
                'journals.basedon_id',
                'journals.baseon_text',
                DB::raw("sum(journal_details.credit) as credit_total"),
                DB::raw("sum(journal_details.debit) as debit_total")
                )
            ->groupBy('journals.id','journals.date','journals.basedon_no',
                'journals.basedon_id',
                'journals.baseon_text')
            ->orderByDesc('journals.id')->get();
        return view('accounts.journals',compact('journals'));
    }


    public function previewJournal($id){
        $payments = DB::table('journal_details')
            ->join('accounts_trees','journal_details.account_id','=','accounts_trees.id')
            ->leftJoin('companies','companies.id','=','journal_details.ledger_id')
            ->select('accounts_trees.code','accounts_trees.name','journal_details.credit','journal_details.debit',
                'companies.name as ledger_name')
            ->where('journal_details.journal_id','=',$id)
            ->get();
        $html = view('accounts.preview_journal',compact('payments'))->render();
        return $html;
    }

    public function getAccount($code)
    {
        $single = $this->getSingleAccount($code);

        if($single){
            echo response()->json([$single]);
            exit;
        }else{
            $product = AccountsTree::where('code' , 'like' , '%'.$code.'%')
                ->orWhere('name','like' , '%'.$code.'%')
                ->limit(5)
                -> get();
            echo json_encode ($product);
            exit;
        }

    }

    private function getSingleAccount($code){
        return AccountsTree::where('code' , '=' , $code)
            ->orWhere('name','=' , $code)
            -> get()->first();
    }
}
