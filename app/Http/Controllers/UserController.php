<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserGroup;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index(){
        $users = User::with('groups')
            ->where('email' , '<>' , 'admin@gmail.com')-> get();
        $groups = UserGroup::all() ;
        return view('users.index' , ['users' => $users , 'groups' => $groups]);
    }

    public function store(Request $request){

        $usersCount = DB::table('users')->get()->count();
        $maxUsers = DB::table('system_settings')->select('max_users')->get()->first()->max_users;

        if($usersCount >= $maxUsers){
            return redirect()->back()->with('error',__('main.Max Users Reached'));
        }

        if ($request -> id == 0) {
            $validated = $request->validate([
                'name' => 'required',
                'last_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required'
            ]);
            try {
                User::create([
                    'name' => $request -> name,
                    'last_name' => $request -> last_name,
                    'gender' => $request -> gender,
                    'company' => $request -> company,
                    'phone' => $request -> phone,
                    'email' => $request -> email,
                    'password' =>  Hash::make($request -> password) ,
                    'status' => $request -> status,
                    'group' => $request -> group,
                    'original_password' => $request -> password,
                ]);
                return redirect()->route('users')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('users')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }
    }

    public function update(Request $request){
      $user = User::find($request -> id);
      if($user){
          $validated = $request->validate([
              'name' => 'required',
              'last_name' => 'required',
              'email' => ['required' , Rule::unique('users')->ignore($request -> id)],
              'password' => 'required'
          ]);
          try {
              $user -> update([
                  'name' => $request -> name,
                  'last_name' => $request -> last_name,
                  'gender' => $request -> gender,
                  'company' => $request -> company,
                  'phone' => $request -> phone,
                  'email' => $request -> email,
                  'password' =>  Hash::make($request -> password) ,
                  'status' => $request -> status,
                  'group' => $request -> group,
                  'original_password' => $request -> password,
              ]);
              return redirect()->route('users')->with('success' , __('main.created'));
          } catch(QueryException $ex){

              return redirect()->route('users')->with('error' ,  $ex->getMessage());
          }


      }

    }
    public function reset_password(Request $request){
        $validated = $request->validate([
            'original_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required',
            'id' => 'required'
        ]);
        $user = User::find($request ->  id);
        if($user){
            if($user -> original_password == $request ->original_password ){
                if($request -> password == $request ->  confirm_password){
                    $user -> password = Hash::make($request -> password) ;
                    $user -> original_password = ($request -> password) ;
                    $user -> update();
                    Auth::logout();
                    return redirect()->route('login')->with('success' , __('main.password_changes'));
                } else {
                    return redirect()->route('users')->with('error' ,  __('main.passwords_not_match'));
                }
            } else {
                return redirect()->route('users')->with('error' ,  __('main.wrong_password'));
            }
        }
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
