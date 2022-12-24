<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = UserGroup::all();
        return view('UserGroup.index' ,[ 'groups' => $groups]);
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
            $validated = $request->validate([
                'name' => 'required',
            ]);
            try {
                UserGroup::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                return redirect()->route('user_groups')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('user_groups')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function show(UserGroup $userGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = UserGroup::find($id);
        echo json_encode ($group);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $group = UserGroup::find($request -> id);
        if($group){
            $validated = $request->validate([
                'name' => 'required',
            ]);
            try {
                $group -> update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
                return redirect()->route('user_groups')->with('success' , __('main.updated'));
            } catch(QueryException $ex){

                return redirect()->route('user_groups')->with('error' ,  $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = UserGroup::find($id);
        if($group){
            $group -> delete();
            return redirect()->route('user_groups')->with('success' , __('main.deleted'));
        }
    }
}
