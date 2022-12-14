<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('Brand.index' , ['brands' => $brands]);
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
     * @param  \App\Http\Requests\StoreBrandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            if($request -> id == 0){
                $validated = $request->validate([
                    'code' => 'required|unique:brands',
                    'name' => 'required',
                ]);
                try {
                    Brand::create([
                        'code' => $request->code,
                        'name' => $request->name,
                    ]);
                    return redirect()->route('brands')->with('success' , __('main.created'));
                } catch(QueryException $ex){

                    return redirect()->route('brands')->with('error' ,  $ex->getMessage());
                }
            } else {
              return  $this -> update($request);
            }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        echo json_encode ($brand);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBrandRequest  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $brand = Brand::find($request -> id);
        if($brand ) {
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('brands')->ignore($request -> id)],
                'name' => 'required',
            ]);
            try {
                $brand -> update([
                    'code' => $request->code,
                    'name' => $request->name,
                ]);
                return redirect()->route('brands')->with('success', __('main.updated'));
            } catch (QueryException $ex) {

                return redirect()->route('brands')->with('error', $ex->getMessage());
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::find($id);
        if($brand){
            $brand -> delete();
        }
        return redirect()->route('brands')->with('success' , __('main.deleted'));
    }
}
