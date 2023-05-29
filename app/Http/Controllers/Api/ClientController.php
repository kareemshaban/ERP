<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VendorMovement;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function client_balance_report($id){
        try {
            $data = VendorMovement::query()->where('vendor_id', $id)->get();

                return response(['data' => $data], 200);

        } catch (QueryException $ex){
            return response(['error' => $ex -> getMessage()], 500);
        }
    }
}
