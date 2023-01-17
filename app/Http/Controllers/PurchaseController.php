<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\PurchaseDetails;
use App\Models\SystemSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('purchases')
            ->join('warehouses','purchases.warehouse_id','=','warehouses.id')
            ->join('companies','purchases.customer_id','=','companies.id')
            ->select('purchases.*','warehouses.name as warehouse_name','companies.name as customer_name')
            ->get();

        return view('purchases.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siteContrller = new SystemController();
        $warehouses = $siteContrller->getAllWarehouses();
        $customers = $siteContrller->getAllVendors();

        return view('purchases.create',compact('warehouses','customers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchaseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siteController = new SystemController();
        $total = 0;
        $tax = 0;
        $net = 0;

        $products = array();
        $qntProducts = array();
        foreach ($request->product_id as $index=>$id){
            $productDetails = $siteController->getProductById($id);
            $product = [
                'purchase_id' => 0,
                'product_code' => $productDetails->code,
                'product_id' => $id,
                'quantity' => $request->qnt[$index],
                'cost_without_tax' => $request->price_without_tax[$index],
                'cost_with_tax' => $request->price_with_tax[$index],
                'warehouse_id' => $request->warehouse_id,
                'unit_id' => $productDetails->unit,
                'tax' => $request->tax[$index],
                'total' => $request->total[$index],
                'net' => $request->net[$index]
            ];

            $item = new Product();
            $item -> product_id = $id;
            $item -> quantity = $request->qnt[$index] ;
            $item -> warehouse_id = $request->warehouse_id ;
            $qntProducts[] = $item ;

            $products[] = $product;
            $total +=$request->total[$index];
            $tax +=$request->tax[$index];
            $net +=$request->net[$index];

        }

      //  return $products ;
        $purchase = Purchase::create([
            'date' => $request->bill_date,
            'invoice_no' => $request-> bill_number,
            'customer_id' => $request->customer_id,
            'biller_id' => Auth::id(),
            'warehouse_id' => $request->warehouse_id,
            'note' => $request->notes ?? '' ,
            'total' => $total,
            'discount' => 0,
            'tax' => $tax,
            'net' => $net,
            'paid' => 0,
            'purchase_status' => 'completed',
            'payment_status' => 'not_paid',
            'created_by' => Auth::id()
        ]);

        foreach ($products as $product){
            $product['purchase_id'] = $purchase->id;
            PurchaseDetails::create($product);
        }


        $siteController->syncQnt($qntProducts,null , false);
        $clientController = new ClientMoneyController();
        $clientController->syncMoney($request->customer_id,0,$net);

        return redirect()->route('purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $datas = DB::table('purchases')
            ->join('warehouses','purchases.warehouse_id','=','warehouses.id')
            ->join('companies','purchases.customer_id','=','companies.id')
            ->select('purchases.*','warehouses.name as warehouse_name','companies.name as customer_name' )
            ->where('purchases.id' , '=' , $id) -> get();
        if(count($datas)){
            $data = $datas[0];
            $details = DB::table('purchase_details')
                -> join('products' , 'purchase_details.product_id' , '=' , 'products.id')
                -> select('purchase_details.*' , 'products.code' , 'products.name')
                ->where('purchase_details.purchase_id' , '=' , $id)-> get();
            // return  $details ;

            return view('purchases.view',compact('data' , 'details'));
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datas = DB::table('purchases')
            ->join('warehouses','purchases.warehouse_id','=','warehouses.id')
            ->join('companies','purchases.customer_id','=','companies.id')
            ->select('purchases.*','warehouses.name as warehouse_name','companies.name as customer_name' )
            ->where('purchases.id' , '=' , $id) -> get();
        if(count($datas)){
            $data = $datas[0];
            $details = DB::table('purchase_details')
                -> join('products' , 'purchase_details.product_id' , '=' , 'products.id')
                -> select('purchase_details.*' , 'products.code' , 'products.name')
                ->where('purchase_details.purchase_id' , '=' , $id)-> get();
            // return  $details ;

            return view('purchases.edit',compact('data' , 'details'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request)
    {
        $siteController = new SystemController();
        $total = 0;
        $tax = 0;
        $net = 0;

        $products = array();
        $qntProducts = array();
        foreach ($request->product_id as $index=>$id){
            $productDetails = $siteController->getProductById($id);
            $product = [
                'purchase_id' => 0,
                'product_code' => $productDetails->code,
                'product_id' => $id,
                'quantity' => -1 * $request->qnt[$index],
                'cost_without_tax' => -1 * $request->price_without_tax[$index],
                'cost_with_tax' => -1 * $request->price_with_tax[$index],
                'warehouse_id' => $request->warehouse_id,
                'unit_id' => $productDetails->unit,
                'tax' => -1 * $request->tax[$index],
                'total' => -1 * $request->total[$index],
                'net' => -1 * $request->net[$index],
                'returned_qnt' => $request -> returned_qnt[$index]
            ];

            $item = new Product();
            $item -> product_id = $id;
            $item -> quantity = -1 * $request->qnt[$index] ;
            $item -> warehouse_id = $request->warehouse_id ;
            $qntProducts[] = $item ;

            $products[] = $product;
            $total +=$request->total[$index];
            $tax +=$request->tax[$index];
            $net +=$request->net[$index];

        }

        //  return $products ;
        $purchase = Purchase::create([
            'date' => $request->bill_date,
            'invoice_no' => $request-> bill_number,
            'customer_id' => $request->customer_id,
            'biller_id' => Auth::id(),
            'warehouse_id' => $request->warehouse_id,
            'note' => $request->notes ?? '' ,
            'total' => -1 * $total,
            'discount' => 0,
            'tax' => $tax,
            'net' => $net,
            'paid' => 0,
            'purchase_status' => 'completed',
            'payment_status' => 'not_paid',
            'created_by' => Auth::id()
        ]);

        foreach ($products as $product){
            $product['purchase_id'] = $purchase->id;
            PurchaseDetails::create($product);
        }


        $siteController->syncQnt($qntProducts,null , false);
        $clientController = new ClientMoneyController();
        $clientController->syncMoney($request->customer_id,0,$net);

        return redirect()->route('purchases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }

    public function getNo(){
        $bills = Purchase::orderBy('id', 'ASC')->get();
        if(count($bills) > 0){
            $id = $bills[count($bills) -1] -> id ;
        } else
            $id = 0 ;
        $settings = SystemSettings::all();
        $prefix = "";
        if(count($settings) > 0){
            if($settings[0] -> purchase_prefix)
                $prefix =     $settings[0] -> purchase_prefix ;
            else
                $prefix = "" ;
        } else {
            $prefix = "";
        }
        $no = json_encode($prefix . str_pad($id + 1, 6 , '0' , STR_PAD_LEFT)) ;
        echo $no ;
        exit;
    }
    public function getNoR(){
        $bills = Purchase::orderBy('id', 'ASC')->get();
        if(count($bills) > 0){
            $id = $bills[count($bills) -1] -> id ;
        } else
            $id = 0 ;
        $settings = SystemSettings::all();
        $prefix = "";
        if(count($settings) > 0){
            if($settings[0] -> purchase_return_prefix)
                $prefix =     $settings[0] -> purchase_return_prefix ;
            else
                $prefix = "" ;
        } else {
            $prefix = "";
        }
        $no = json_encode($prefix . str_pad($id + 1, 6 , '0' , STR_PAD_LEFT)) ;
        echo $no ;
        exit;
    }

}
