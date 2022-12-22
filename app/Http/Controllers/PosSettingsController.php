<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\CustomerGroup;
use App\Models\PosSettings;
use App\Models\SystemSettings;
use App\Models\Warehouse;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PosSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $settings = PosSettings::all();
        $categories = Category::all();
        $companies = Company::all();
        $cashiers = Cashier::all() ;
        return view('settings.pos' , ['setting' => count($settings) > 0 ? $settings[0]  : null,
            'categories' => $categories , 'companies' => $companies , 'cashiers' => $cashiers]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request -> id == 0){

            if($request -> header_img){
                $imageName = time().'.'.$request->header_img->extension();
                $request->header_img->move(('images/header'), $imageName);
            } else {
                $imageName = '' ;
            }

            try {
                PosSettings::create([
                    'show_items' => $request -> show_items, //
                    'default_category' => $request -> default_category, //
                    'cashier_id' => $request -> cashier_id, //
                    'client_id' => $request -> client_id,//
                    'show_time' => $request -> show_time,//
                    'item_search' => $request -> item_search,//
                    'add_new_item' => $request -> add_new_item,//
                    'insert_client' => $request -> insert_client,//
                    'add_client' => $request -> add_client,//
                    'category_toggle' => $request -> category_toggle,//
                    'subCategory_toggle' => $request -> subCategory_toggle,//
                    'brand_toggle' => $request -> brand_toggle,//
                    'cancel_sell' => $request -> cancel_sell,//
                    'pend_sell' => $request -> pend_sell,//
                    'printed_material' => $request -> printed_material,//
                    'finish_bill' => $request -> finish_bill,//
                    'daily_sales' => $request -> daily_sales,//
                    'opening_pending_sales' => $request -> opening_pending_sales,//
                    'close_shift' => $request -> close_shift,//
                    'qr_print' => $request -> qr_print,//
                    'header_print' => $request -> header_print,//
                    'header_img' => $imageName ,
                    'seller_buyer' => $request -> seller_buyer

                ]);
                return redirect()->route('pos_settings')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('pos_settings')->with('error' ,  $ex->getMessage());
            }
        } else {
            return   $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PosSettings  $posSettings
     * @return \Illuminate\Http\Response
     */
    public function show(PosSettings $posSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PosSettings  $posSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(PosSettings $posSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PosSettings  $posSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $setting = PosSettings::find($request -> id);
        if($setting){
            if($request -> header_img){
                $imageName = time().'.'.$request->header_img->extension();
                $request->header_img->move(('images/header'), $imageName);
            } else {
                $imageName = $setting -> header_img ;
            }
            try {
                $setting -> update([
                    'show_items' => $request -> show_items, //
                    'default_category' => $request -> default_category, //
                    'cashier_id' => $request -> cashier_id, //
                    'client_id' => $request -> client_id,//
                    'show_time' => $request -> show_time,//
                    'item_search' => $request -> item_search,//
                    'add_new_item' => $request -> add_new_item,//
                    'insert_client' => $request -> insert_client,//
                    'add_client' => $request -> add_client,//
                    'category_toggle' => $request -> category_toggle,//
                    'subCategory_toggle' => $request -> subCategory_toggle,//
                    'brand_toggle' => $request -> brand_toggle,//
                    'cancel_sell' => $request -> cancel_sell,//
                    'pend_sell' => $request -> pend_sell,//
                    'printed_material' => $request -> printed_material,//
                    'finish_bill' => $request -> finish_bill,//
                    'daily_sales' => $request -> daily_sales,//
                    'opening_pending_sales' => $request -> opening_pending_sales,//
                    'close_shift' => $request -> close_shift,//
                    'qr_print' => $request -> qr_print,//
                    'header_print' => $request -> header_print,//
                    'header_img' => $imageName ,
                    'seller_buyer' => $request -> seller_buyer

                ]);
                return redirect()->route('pos_settings')->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('pos_settings')->with('error' ,  $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PosSettings  $posSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(PosSettings $posSettings)
    {
        //
    }
}
