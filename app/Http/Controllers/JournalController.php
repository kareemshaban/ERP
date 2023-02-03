<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use App\Http\Requests\StoreJournalRequest;
use App\Http\Requests\UpdateJournalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    public function incoming_list(){
        $accounts = DB::table('accounts_trees')
            ->join('account_movements','accounts_trees.id','=','account_movements.account_id')
            ->select('accounts_trees.code','accounts_trees.name',
                DB::raw('sum(account_movements.credit) as credit'),
                DB::raw('sum(account_movements.debit) as debit'))
            ->groupBy('accounts_trees.id','accounts_trees.code','accounts_trees.name')
            ->where('accounts_trees.department',0)
            ->get();

        return view('Report.incoming_list_report',compact('accounts'));
    }

    public function search_incoming_list(Request $request){

    }

    public function balance_sheet(){
        $accounts = DB::table('accounts_trees')
            ->join('account_movements','accounts_trees.id','=','account_movements.account_id')
            ->select('accounts_trees.code','accounts_trees.name',
                DB::raw('sum(account_movements.credit) as credit'),
                DB::raw('sum(account_movements.debit) as debit'))
            ->groupBy('accounts_trees.id','accounts_trees.code','accounts_trees.name')
            ->where('accounts_trees.department',1)
            ->get();
        return view('Report.balance_sheet_report',compact('accounts'));
    }

    public function search_balance_sheet(Request $request){

    }
}
