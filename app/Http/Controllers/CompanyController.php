<?php

namespace App\Http\Controllers;

use App\Models\AccountsTree;
use App\Models\Company;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\CustomerGroup;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $companies = Company::with('group') -> get();
        $groups = CustomerGroup::all();
        $accounts = AccountsTree::query()->where('type','>',1)->get();
        return view('company.index' , ['type' => $type , 'companies' =>
            $companies , 'groups' => $groups , 'accounts' => $accounts] );
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
     * @param  \App\Http\Requests\StoreCompanyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request -> id == 0){
            $validated = $request->validate([
                'company' => 'required',
                'name' => 'required',
                'opening_balance' => 'required',
                'type' => 'required',
                'account_id' => 'required'
            ]);
            try {
                Company::create([
                    'group_id' => $request -> type,
                    'group_name' => '',
                    'customer_group_id' => $request -> customer_group_id ? $request -> customer_group_id : 0 ,
                    'customer_group_name' => '',
                    'name' => $request->name,
                    'company' => $request->company,
                    'vat_no' => $request->vat_no ? $request->vat_no : '',
                    'address' => $request-> address ? $request-> address: '',
                    'city' => '' ,
                    'state' => '',
                    'postal_code' => '',
                    'country' => '',
                    'email' => $request -> email ? $request -> email : '',
                    'phone' => $request -> phone ? $request -> phone : '',
                    'invoice_footer' => '',
                    'logo' => '',
                    'award_points' => 0 ,
                    'deposit_amount' => 0 ,
                    'opening_balance' =>$request -> opening_balance? $request -> opening_balance: 0 ,
                    'credit_amount' =>$request -> has('credit_amount')? $request -> credit_amount: 0 ,
                    'stop_sale' =>$request -> has('stop_sale')? 1: 0 ,
                    'account_id' => $request->account_id

                ]);
                return redirect()->route('clients' , $request -> type)->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('clients' , $request -> type)->with('error' ,  $ex->getMessage());
            }
        } else {
         return   $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        echo json_encode ($company);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request)
    {
        $company = Company::find($request -> id);
        if($company){
            $validated = $request->validate([
                'company' => 'required',
                'name' => 'required',
                'opening_balance' => 'required',
                'type' => 'required'
            ]);
            try {
                $company -> update([
                    'group_id' => $request -> type,
                    'group_name' => '',
                    'customer_group_id' => $request -> customer_group_id ? $request -> customer_group_id : $company -> customer_group_id,
                    'customer_group_name' => '',
                    'name' => $request->name,
                    'company' => $request->company,
                    'vat_no' => $request->vat_no ? $company->vat_no : '',
                    'address' => $request-> address ? $company-> address: '',
                    'city' => '' ,
                    'state' => '',
                    'postal_code' => '',
                    'country' => '',
                    'email' => $request -> email ? $request -> email : '',
                    'phone' => $request -> phone ? $request -> phone : '',
                    'invoice_footer' => '',
                    'logo' => '',
                    'award_points' => 0 ,
                    'deposit_amount' => 0 ,
                    'opening_balance' =>$request -> opening_balance? $request -> opening_balance: $company ->  opening_balance,
                    'credit_amount' =>$request -> has('credit_amount')? $request -> credit_amount: $company -> credit_amount ,
                    'stop_sale' =>$request -> has('stop_sale')? 1: $company -> stop_sale ,

                ]);
                return redirect()->route('clients' , $request -> type)->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('clients' , $request -> type)->with('error' ,  $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $company = Company::find($id);
        if($company){
            $company -> delete();
            return redirect()->route('clients' , $request -> type)->with('success' , __('main.deleted'));
        }
    }
}
