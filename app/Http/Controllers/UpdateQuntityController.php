<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SystemSettings;
use App\Models\UpdateQuntity;
use App\Models\UpdateQuntityDetails;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateQuntityController extends SystemController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = UpdateQuntity::with('user' , 'warehouse' , 'details') -> get();
        return view('UpdateQuantity.index' , ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();
        return view('UpdateQuantity.create' , ['warehouses' => $warehouses]);
    }

    public function getUpdateQntBillNo(){
        $bills = UpdateQuntity::orderBy('id', 'ASC')->get();
        if(count($bills) > 0){
            $id = $bills[count($bills) -1] -> id ;
        } else
            $id = 0 ;
        $settings = SystemSettings::all();
        $prefix = "";
        if(count($settings) > 0){
            if($settings[0] -> update_qnt_prefix)
                $prefix =     $settings[0] -> update_qnt_prefix ;
            else
                $prefix = "" ;
        } else {
            $prefix = "";
        }
        $billNo = $prefix . str_pad($id + 1, 6 , '0' , STR_PAD_LEFT);
        echo json_encode ($billNo);
        exit;
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
            'bill_date' => 'required',
            'bill_number' => 'required|unique:update_quntities',
            'warehouse_id' => 'required'
        ]);
        if( count($request -> item_id) ){
            $uuid = $this->unique_code(20);
            try {
                $id = UpdateQuntity::create([
                    'identifier' => $uuid,
                    'bill_date' => Carbon::parse($request->bill_date),
                    'bill_number' => $request->bill_number,
                    'warehouse_id' => $request->warehouse_id,
                    'user_id' => Auth::user()->id,
                    'notes' => $request->notes ? $request->notes : ''
                ])->id;
                if($id > 0){
                      $this ->storeDetails($request , $id , $uuid);
                    return  redirect()->route('update_qnt')->with('success' ,  __('main.created'));
                }
            }  catch(QueryException $ex){

                return redirect()->route('update_qnt')->with('error' ,  $ex->getMessage());
            }

        } else {
            return redirect()->route('update_qnt')->with('error' ,  __('main.nodetails'));
        }


    }

    public function storeDetails(Request $request , $id , $uuid){
        $items = array() ;
        for($i = 0 ; $i < count($request -> item_id) ; $i++ ){

            try {
                 UpdateQuntityDetails::create([
                    'identifier' => $uuid,
                    'update_qnt_id' => $id,
                    'item_id' => $request->item_id[$i],
                     'type' => $request->type[$i],
                     'qnt' => $request->qnt[$i],
                    'notes' => $request->notes ? $request->notes : ''
                ]);
                $item = new Product();
                $item -> product_id = $request->item_id[$i] ;
                $item -> quantity = $request->qnt[$i] ;
                $item -> warehouse_id = $request->warehouse_id ;
                $items[] = $item ;
            }  catch(QueryException $ex){


            }

        }

        $this -> syncQnt($items , null , false);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UpdateQuntity  $updateQuntity
     * @return \Illuminate\Http\Response
     */
    public function show(UpdateQuntity $updateQuntity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UpdateQuntity  $updateQuntity
     * @return \Illuminate\Http\Response
     */
    public function edit(UpdateQuntity $updateQuntity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UpdateQuntity  $updateQuntity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UpdateQuntity $updateQuntity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UpdateQuntity  $updateQuntity
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateQuntity $updateQuntity)
    {
        //
    }

    function unique_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}
