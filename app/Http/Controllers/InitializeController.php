<?php

namespace App\Http\Controllers;

use App\Models\SystemSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InitializeController extends Controller
{
    public function getIntialize(){
        $settings = SystemSettings::all()->first();

        $html = view('initialize.index',compact('settings'))->render();
        return $html;
    }

    public function subscribeData(){
        $settings = SystemSettings::all()->first();

        $validTo = $settings->valid_to;
        $new_format = str_replace('/', '-', $validTo);
        $timestamp = strtotime($new_format);
        $currentDate = time();
        $datediff = $timestamp - $currentDate;
        $remaining_days = round($datediff / (60 * 60 * 24));

        $html = view('initialize.subscribe_data',compact('settings','remaining_days'))->render();
        return $html;
    }

    public function storeInitialize(Request $request){

        $id = SystemSettings::all()->first()->id;

        DB::table('system_settings')
            ->where('id',$id)
            ->update([
                 'max_users' => $request->max_users,
                'max_branches' => $request->max_branches,
                'valid_to' => $request->valid_to,
                'contact_phone' => $request->contact_phone,
                'enable_accounting' => $request->enable_accounting ? 1 : 0,
                'enable_inventory' => $request->enable_inventory ? 1 : 0
                ]);

        return redirect()->route('home');
    }
}
