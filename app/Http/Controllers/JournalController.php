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


    public function create(){
        return view('accounts.manual');
    }

    public function store(Request $request){
        $siteController = new SystemController();

        $header =[
            'date' => date('Y-m-d').'T'.date('H:i'),
            'basedon_no' => '',
            'basedon_id' => 0,
            'baseon_text' => 'سند قيد يدوي',
            'total_credit' => 0,
            'total_debit' => 0,
            'notes' => $request->notes ? $request->notes : ''
        ];


        $details = [];
        foreach ($request->account_id as $index=>$account_id){
            $accountId = $account_id;
            $credit = $request->credit[$index];
            $debit = $request->debit[$index];
            $ledger = 0;

            $details[] = [
                'account_id' => $accountId,
                'credit' => $credit,
                'debit' => $debit,
                'ledger_id' => $ledger,
                'notes' => ''
            ];
        }

        $siteController->insertJournal($header,$details,1);
        return redirect()->route('journals');
    }

    public function delete($id){

        $header = [
            'date' => '',
            'basedon_no' => '',
            'basedon_id' => '',
            'baseon_text' => 'سند قيد يدوي رقم '.$id,
            'total_credit' => 0,
            'total_debit' => 0,
            'notes' => ''
        ];
        $siteController = new SystemController();
        $siteController->deleteJournal($header);

        return redirect()->route('journals');
    }

}
