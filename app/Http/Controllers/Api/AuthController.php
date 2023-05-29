<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Representative;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function getAuthUser($id){
        try {
            $rep = Representative::with('clients') -> find($id);
            if($rep){
                return response(['rep' => $rep], 200);
            } else {
                return response(['rep' => null], 404);
            }
        } catch (QueryException $ex){
            return response(['error' => $ex -> getMessage()], 500);
        }

    }
    public function LoginUser(Request $request){
        try {
            $rep = Representative::with('clients')->where('user_name' , '=' , $request -> user_name)
            -> where('password' , '=' , $request -> password) -> get();
            if($rep){
                return response(['rep' => $rep], 200);
            } else{
                return response(['rep' => null], 404);
            }
        }catch (QueryException $ex){
            return response(['error' => $ex -> getMessage()], 500);
        }
    }
}
