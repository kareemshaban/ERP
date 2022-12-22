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

class SystemSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = SystemSettings::all();
        $currencies = Currency::all();
        $groups = CustomerGroup::all();
        $branches = Warehouse::all();
        $cashiers = Cashier::all() ;
        return view('settings.index' , ['setting' => count($settings) > 0 ? $settings[0]  : null,
            'currencies' => $currencies , 'groups' => $groups , 'branches' => $branches , 'cashiers' => $cashiers]);

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
            try {
                SystemSettings::create([
                    'company_name' => $request -> company_name,
                    'currency_id' => $request -> currency_id,
                    'email' => $request -> email,
                    'client_group_id' => $request -> client_group_id,
                    'nom_of_days_to_edit_bill' => $request -> nom_of_days_to_edit_bill,
                    'branch_id' => $request -> branch_id,
                    'cashier_id' => $request -> cashier_id,
                    'item_tax' => $request -> item_tax,
                    'item_expired' => $request -> item_expired,
                    'img_width' => $request -> img_width,
                    'img_height' => $request -> img_height,
                    'small_img_width' => $request -> small_img_width,
                    'small_img_height' => $request -> small_img_height,
                    'barcode_break' => $request -> barcode_break,
                    'sell_without_stock' => $request -> sell_without_stock,
                    'customize_refNumber' => $request -> customize_refNumber,
                    'item_serial' => $request -> item_serial,
                    'adding_item_method' => $request -> adding_item_method,
                    'payment_method' => $request -> payment_method,
                    'sales_prefix' => $request -> sales_prefix,
                    'sales_return_prefix' => $request -> sales_return_prefix,
                    'payment_prefix' => $request -> payment_prefix,
                    'purchase_payment_prefix' => $request -> purchase_payment_prefix,
                    'deliver_prefix' => $request -> deliver_prefix,
                    'purchase_prefix' => $request -> purchase_prefix,
                    'purchase_return_prefix' => $request -> purchase_return_prefix,
                    'transaction_prefix' => $request -> transaction_prefix,
                    'expenses_prefix' => $request -> expenses_prefix,
                    'store_prefix' => $request -> store_prefix,
                    'fraction_number' => $request -> fraction_number,
                    'qnt_decimal_point' => $request -> qnt_decimal_point,
                    'decimal_type' => $request -> decimal_type,
                    'thousand_type' => $request -> thousand_type,
                    'show_currency' => $request -> show_currency,
                    'currency_label' => $request -> currency_label,
                    'a4_decimal_point' => $request -> a4_decimal_point,
                    'barcode_type' => $request -> barcode_type,
                    'barcode_length' => $request -> barcode_length,
                    'flag_character' => $request -> flag_character,
                    'barcode_start' => $request -> barcode_start,
                    'code_length' => $request -> code_length,
                    'weight_start' => $request -> weight_start,
                    'weight_length' => $request -> weight_length,
                    'weight_divider' => $request -> weight_divider,
                    'email_protocol' => $request -> email_protocol,
                    'email_host' => $request -> email_host,
                    'email_user' => $request -> email_user,
                    'email_password' => $request -> email_password,
                    'email_port' => $request -> email_port,
                    'email_encrypt' => $request -> email_encrypt,
                    'client_value' => $request -> client_value,
                    'client_points' => $request -> client_points,
                    'employee_value' => $request -> employee_value,
                    'employee_points' => $request -> employee_points,
                    'is_tobacco' => $request -> has('is_tobacco')? 1: 0  ,
                    'tobacco_tax' => $request -> tobacco_tax,

                ]);
                return redirect()->route('system_settings')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('system_settings')->with('error' ,  $ex->getMessage());
            }
        } else {
            return   $this -> update($request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function show(SystemSettings $systemSettings)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function edit(SystemSettings $systemSettings)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $setting = SystemSettings::find($request -> id);
        if($setting){
            try {
                $setting -> update([
                    'company_name' => $request -> company_name,
                    'currency_id' => $request -> currency_id,
                    'email' => $request -> email,
                    'client_group_id' => $request -> client_group_id,
                    'nom_of_days_to_edit_bill' => $request -> nom_of_days_to_edit_bill,
                    'branch_id' => $request -> branch_id,
                    'cashier_id' => $request -> cashier_id,
                    'item_tax' => $request -> item_tax,
                    'item_expired' => $request -> item_expired,
                    'img_width' => $request -> img_width,
                    'img_height' => $request -> img_height,
                    'small_img_width' => $request -> small_img_width,
                    'small_img_height' => $request -> small_img_height,
                    'barcode_break' => $request -> barcode_break,
                    'sell_without_stock' => $request -> sell_without_stock,
                    'customize_refNumber' => $request -> customize_refNumber,
                    'item_serial' => $request -> item_serial,
                    'adding_item_method' => $request -> adding_item_method,
                    'payment_method' => $request -> payment_method,
                    'sales_prefix' => $request -> sales_prefix,
                    'sales_return_prefix' => $request -> sales_return_prefix,
                    'payment_prefix' => $request -> payment_prefix,
                    'purchase_payment_prefix' => $request -> purchase_payment_prefix,
                    'deliver_prefix' => $request -> deliver_prefix,
                    'purchase_prefix' => $request -> purchase_prefix,
                    'purchase_return_prefix' => $request -> purchase_return_prefix,
                    'transaction_prefix' => $request -> transaction_prefix,
                    'expenses_prefix' => $request -> expenses_prefix,
                    'store_prefix' => $request -> store_prefix,
                    'fraction_number' => $request -> fraction_number,
                    'qnt_decimal_point' => $request -> qnt_decimal_point,
                    'decimal_type' => $request -> decimal_type,
                    'thousand_type' => $request -> thousand_type,
                    'show_currency' => $request -> show_currency,
                    'currency_label' => $request -> currency_label,
                    'a4_decimal_point' => $request -> a4_decimal_point,
                    'barcode_type' => $request -> barcode_type,
                    'barcode_length' => $request -> barcode_length,
                    'flag_character' => $request -> flag_character,
                    'barcode_start' => $request -> barcode_start,
                    'code_length' => $request -> code_length,
                    'weight_start' => $request -> weight_start,
                    'weight_length' => $request -> weight_length,
                    'weight_divider' => $request -> weight_divider,
                    'email_protocol' => $request -> email_protocol,
                    'email_host' => $request -> email_host,
                    'email_user' => $request -> email_user,
                    'email_password' => $request -> email_password,
                    'email_port' => $request -> email_port,
                    'email_encrypt' => $request -> email_encrypt,
                    'client_value' => $request -> client_value,
                    'client_points' => $request -> client_points,
                    'employee_value' => $request -> employee_value,
                    'employee_points' => $request -> employee_points,
                    'is_tobacco' => $request -> has('is_tobacco')? 1: 0  ,
                    'tobacco_tax' => $request -> tobacco_tax,

                ]);
                return redirect()->route('system_settings')->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('system_settings')->with('error' ,  $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SystemSettings  $systemSettings
     * @return \Illuminate\Http\Response
     */
    public function destroy(SystemSettings $systemSettings)
    {
        //
    }
}
