<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Representative;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class RepresentativeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $representatives = Representative::all();
        return view('representatives.index' , compact('representatives'));
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

        if ($request -> id == 0) {
            $validated = $request->validate([
                'code' => 'required',
                'name' => 'required',
                'user_name' => 'required|unique:representatives',
                'password' => 'required'
            ]);
            try {
                Representative::create([
                    'code' => $request -> code,
                    'name' => $request -> name,
                    'user_name' => $request -> user_name,
                    'password' => $request -> password,
                    'notes' => '',
                    'active' => 1,
                ]);
                return redirect()->route('representatives')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('representatives')->with('error' ,  $ex->getMessage());
            }
        } else {
            return  $this -> update($request);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $clients = Company::all();
        echo json_encode($clients);
        exit();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Representative::find($request -> id);
        if($user){
            $validated = $request->validate([
                'code' => 'required',
                'name' => 'required',
                'user_name' => ['required' , Rule::unique('representatives')->ignore($request -> id)],
                'password' => 'required'
            ]);
            try {
                $user -> update([
                    'code' => $request -> code,
                    'name' => $request -> name,
                    'user_name' => $request -> user_name,
                    'password' => $request -> password,
                    'notes' => '',
                    'active' => 1,
                ]);
                return redirect()->route('representatives')->with('success' , __('main.created'));
            } catch(QueryException $ex){

                return redirect()->route('representatives')->with('error' ,  $ex->getMessage());
            }


        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Representative::find($id);
        echo json_encode($user);
        exit();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Representative  $representative
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rep = Representative::find($id);
        if($rep) {
            $clients = Company::where('representative_id_', '=', $id)->get();
            foreach ($clients as $client) {
                $client->representative_id_ = 0;
                $client->update();
            }
            $rep -> delete();
            return redirect()->route('representatives')->with('success' , __('main.deleted'));
        }



    }
    public function connect_to_client(Request  $request){
        $client = Company::find($request -> client);
        $rep = Representative::find($request -> rep);
        if($client && $rep){
            $client -> representative_id_ =  $rep -> id ;
            $client -> update();
            return redirect()->route('representatives')->with('success' , __('main.done'));
        }
    }
    public function disconnectClientRep($id){
        $client = Company::find($id);
        if($client){
            $client -> representative_id_ =  0 ;
            $client -> update();
            return redirect()->route('representatives')->with('success' , __('main.done'));
        }
    }
}
