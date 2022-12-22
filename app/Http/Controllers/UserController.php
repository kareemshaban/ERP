<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('users.index' , ['users' => $users]);
    }

    public function store(Request $request){

    }

    public function update(Request $request){

    }
    public function destroy($id){
        $user = User::find($id);
        if($user){
            $user -> delete();
            return redirect()->route('users')->with('success' , __('main.deleted'));
        }
    }
    public function edit($id){
        $user = User::find($id);
        echo json_encode ($user);
        exit;
    }
}
