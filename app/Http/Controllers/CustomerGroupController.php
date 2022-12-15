<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CustomerGroup;
use App\Http\Requests\StoreCustomerGroupRequest;
use App\Http\Requests\UpdateCustomerGroupRequest;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Group;

class CustomerGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = CustomerGroup::all();
        return view('ClientGroup.index', ['groups' => $groups]);
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
     * @param \App\Http\Requests\StoreCustomerGroupRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->id == 0) {
            $validated = $request->validate([
                'name' => 'required',
                'discount_percentage' => 'required',
            ]);
            try {
                CustomerGroup::create([
                    'name' => $request->name,
                    'discount_percentage' => $request->discount_percentage,
                    'sell_with_cost' => $request->has('sell_with_cost')  ? 1 : 0 ,
                    'enable_discount' => $request->has('enable_discount')  ? 1 : 0,
                ]);
                return redirect()->route('clientGroups')->with('success', __('main.created'));
            } catch (QueryException $ex) {

                return redirect()->route('clientGroups')->with('error', $ex->getMessage());
            }
        } else {
            return $this->update($request);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\CustomerGroup $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerGroup $customerGroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CustomerGroup $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $group = CustomerGroup::find($id);
        echo json_encode($group);
        exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCustomerGroupRequest $request
     * @param \App\Models\CustomerGroup $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       $group = CustomerGroup::find($request -> id);
       if($group){
           $validated = $request->validate([
               'name' => 'required',
               'discount_percentage' => 'required'
           ]);
           try {
               $group -> update([
                   'name' => $request->name,
                   'discount_percentage' => $request->discount_percentage,
                   'sell_with_cost' => $request->has('sell_with_cost')  ? 1 : 0 ,
                   'enable_discount' => $request->has('enable_discount')  ? 1 : 0,
               ]);
               return redirect()->route('clientGroups')->with('success', __('main.updated'));
           } catch (QueryException $ex) {

               return redirect()->route('clientGroups')->with('error', $ex->getMessage());
           }
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CustomerGroup $customerGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $group = Group::find($id);
        if ($group) {
            $group->delete();
            return redirect()->route('clientGroups')->with('success', __('main.deleted'));
        }

    }
}
