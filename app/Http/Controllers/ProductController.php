<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\ProductUnit;
use App\Models\PurchaseDetails;
use App\Models\SaleDetails;
use App\Models\UpdateQuntityDetails;
use App\Models\WarehouseProducts;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|unique:products',
            'name' => 'required|unique:products',
            'unit' => 'required',
            'cost' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'tax_rate' => 'required',
            'tax_method' => 'required',
            'type' => 'required',
            'brand' => 'required',
            'slug' => 'required',
        ]);
        try {
            $product = Product::create([
                'code' => $request->code,
                'name' => $request->name,
                'unit' => $request->unit,
                'cost' => $request->cost,
                'price' => $request->price,
                'lista' => $request->lista ?? 0,
                'alert_quantity' => $request->alert_quantity ?? 0,
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id ?? 0,
                'quantity' => $request->quantity ?? 0,
                'tax_rate' => $request->tax_rate,
                'track_quantity' => $request->track_quantity ?? 0,
                'tax_method' => $request->tax_method,
                'type' => $request->type,
                'brand' => $request->brand,
                'slug' => $request->slug,
                'featured' => $request->featured ?? 0,
                'active' => $request->active ?? 1,
                'city_tax' => $request->city_tax ?? 0,
                'max_order' => $request->max_order ?? 0,
            ]);
            if($product){

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
        } catch(QueryException $ex){

            return redirect()->route('products')->with('error' ,  $ex->getMessage());
        }


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
    public function edit($id)
    {
        $product = Product::find($id);
        if($product){
            $systemController = new SystemController();

            $brands = $systemController->getAllBrands();
            $units = $systemController->getAllUnits();
            $categories = $systemController->getAllMainCategories();
            $taxRages = $systemController->getAllTaxRates();
            $taxTypes = $systemController->getAllTaxTypes();



            return view('products.update',compact('product','brands','categories','taxRages','taxTypes','units'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($product){
            $validated = $request->validate([
                'code' => ['required' , Rule::unique('products')->ignore($id)],
                'name' => ['required' , Rule::unique('products')->ignore($id)],
                'unit' => 'required',
                'cost' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'tax_rate' => 'required',
                'tax_method' => 'required',
                'type' => 'required',
                'brand' => 'required',
                'slug' => 'required',
            ]);
            try {
                $product -> update ([
                    'code' => $request->code,
                    'name' => $request->name,
                    'unit' => $request->unit,
                    'cost' => $request->cost,
                    'price' => $request->price,
                    'lista' => $request->lista ?? 0,
                    'alert_quantity' => $request->alert_quantity ?? 0,
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id ?? 0,
                    'quantity' => $request->quantity ?? 0,
                    'tax_rate' => $request->tax_rate,
                    'track_quantity' => $request->track_quantity ?? 0,
                    'tax_method' => $request->tax_method,
                    'type' => $request->type,
                    'brand' => $request->brand,
                    'slug' => $request->slug,
                    'featured' => $request->featured ?? 0,
                    'active' => $request->active ?? 1,
                    'city_tax' => $request->city_tax ?? 0,
                    'max_order' => $request->max_order ?? 0,
                ]);

                $units = ProductUnit::where('product_id' , '=' , $product -> id) -> get();
                foreach ($units as $unit){
                    $unit -> delete();
                }
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


//                $systemController = new SystemController();
//                $warehouses = $systemController->getAllWarehouses();
//                foreach ($warehouses as $warehouse){
//                    WarehouseProducts::create([
//                        'warehouse_id' => $warehouse->id,
//                        'product_id' => $product->id,
//                        'cost' => $product->cost,
//                        'quantity' => 0
//                    ]);
//                }
                return redirect()->route('products')->with('success' ,  __('main.updated'));
            }catch(QueryException $ex){

                return redirect()->route('products')->with('error' ,  $ex->getMessage());
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id) ;
        if($product) {
            $sales = SaleDetails::where('product_id', '=', $id)->get();
            $purchases = PurchaseDetails::where('product_id', '=', $id)->get();
            $updateQnt = UpdateQuntityDetails::where('item_id', '=', $id)->get();
            if (count($sales) == 0 && count($purchases) == 0 && count($updateQnt) == 0) {
                $unites = ProductUnit::where('product_id', '=', $id)->get();
                $warehouseProducts = WarehouseProducts::where('product_id', '=', $id)->get();
                foreach ($unites as $unit){
                    $unit -> delete();
                }
                foreach ($warehouseProducts as $wpro){
                    $wpro -> delete();
                }
                $product -> delete();
                return redirect()->route('products')->with('success', __('main.deleted'));

        } else {
                // can not delete
                return redirect()->route('products')->with('success', __('main.can_not_delete'));
            }
        }

    }
    public function getProduct($code)
    {
        $single = $this->getSingleProduct($code);

        if($single){
            echo response()->json([$single]);
            exit;
        }else{
            $product = Product::where('code' , 'like' , '%'.$code.'%')
                ->orWhere('name','like' , '%'.$code.'%')
                ->limit(5)
                -> get();
            echo json_encode ($product);
            exit;
        }

    }

    private function getSingleProduct($code){
        return Product::where('code' , '=' , $code)
            ->orWhere('name','=' , $code)
            -> get()->first();
    }

}
