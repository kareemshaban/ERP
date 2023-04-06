<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;
use App\Models\EmployerCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $employers = Employer::query()->orderByDesc('created_at')->get();
        return view('employer.index',compact('employers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = EmployerCategory::all();
        return view('employer.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $emp = Employer::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'employer_category_id' => $request->employer_category_id,
            'salary' => $request->salary,
            'additional_salary' => $request->additional_salary
        ]);




        return redirect()->route('employers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        $categories = EmployerCategory::all();

        return view('employer.update',compact('employer','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employer $employer)
    {
        $employer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'employer_category_id' => $request->employer_category_id,
            'salary' => $request->salary,
            'additional_salary' => $request->additional_salary
        ]);



        return redirect()->route('employers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        Employer::destroy($employer->id);

        return redirect()->route('employers.index');
    }
}
