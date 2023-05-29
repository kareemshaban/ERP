<?php

namespace App\Http\Controllers;

use App\Models\EmployerCategory;
use App\Http\Requests\StoreEmployerCategoryRequest;
use App\Http\Requests\UpdateEmployerCategoryRequest;
use Illuminate\Http\Request;

class EmployerCategoryController extends Controller
{
    public function index()
    {
        $categories = EmployerCategory::query()->orderByDesc('created_at')->get();
        return view('employer.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastObj = EmployerCategory::latest()->first();
        $code = 1;
        if($lastObj != null){
            $code = intval($lastObj->code)+1;
        }
        ////$code = sprintf("%04d", $code);
        return view('employer.category.create',compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $lastObj = EmployerCategory::latest()->first();
        $code = 1;
        if($lastObj != null){
            $code = intval($lastObj->code)+1;
        }

        EmployerCategory::create([
            'code' => $code,
            'name' => $request->name
        ]);
        return redirect()->route('employer.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EmployerCategory  $employerCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EmployerCategory $employerCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EmployerCategory  $employerCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employerCategory = EmployerCategory::find($id);
        return view('employer.category.update',compact('employerCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EmployerCategory  $employerCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployerCategory $employerCategory)
    {
        $employerCategory->update([
            'code' => $request->code,
            'name' => $request->name
        ]);
        return redirect()->route('employer.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EmployerCategory  $employerCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployerCategory $employerCategory)
    {
        EmployerCategory::destroy($employerCategory->id);
        return redirect()->route('employer.categories.index');
    }
}
