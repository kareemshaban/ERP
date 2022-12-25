<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductUnit;
use App\Models\WarehouseProducts;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = DB::table('products')
                    ->leftJoin('categories','products.category_id','=','categories.id')
                    ->leftJoin('units','products.unit','=','units.id')
                    ->leftJoin('brands','products.brand','=','brands.id')
                    ->select('products.*','units.name as unitName','brands.name as brandName',
                        'categories.name as categoryName')->get();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $systemController = new SystemController();

        $brands = $systemController->getAllBrands();
        $units = $systemController->getAllUnits();
        $categories = $systemController->getAllMainCategories();
        $taxRages = $systemController->getAllTaxRates();
        $taxTypes = $systemController->getAllTaxTypes();

        return view('products.create',compact('brands','categories','taxRages','taxTypes','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product = Product::create($request->all());

        $unitsTable = $request->product_units;
        if($unitsTable){
            foreach ($unitsTable as $row){
                ProductUnit::create([
                    'product_id' => $product->id,
                    'unit_id' => $row['unit'],
                    'price' => $row['price']
                ]);
            }
        }else{
            ProductUnit::create([
                'product_id' => $product->id,
                'unit_id' => $product->unit,
                'price' => $product->price
            ]);
        }


        $systemController = new SystemController();
        $warehouses = $systemController->getAllWarehouses();
        foreach ($warehouses as $warehouse){
            WarehouseProducts::create([
                'warehouse_id' => $warehouse->id,
                'product_id' => $product->id,
                'cost' => $product->cost,
                'quantity' => 0
            ]);
        }

        return redirect()->route('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
