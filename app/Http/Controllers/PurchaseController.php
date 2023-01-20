<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Company;
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

        $vendorMovementController = new VendorMovementController();
        $vendorMovementController->addPurchaseMovement($purchase->id);

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


            $vendor = Company::find($data->customer_id);
            $cashier = Cashier::get()->first();

            return view('purchases.view',compact('data' , 'details','vendor','cashier'))->render();
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
        $purchase = Purchase::find($id);
        if($purchase->net < 0){
            return redirect()->back();
        }


        $siteContrller = new SystemController();
        $warehouses = $siteContrller->getAllWarehouses();
        $customers = $siteContrller->getAllVendors();

        $purchaseItems = DB::table('purchase_details')
            ->join('products','products.id','=','purchase_details.product_id')
            ->select('purchase_details.*','products.name as product_name')
            ->where('purchase_id',$id)->get();


        $zeroItems = 0;
        foreach ($purchaseItems as $purchaseItem){
            $returnedQnt = $this->getAllProductReturnForSameInvoice($id,$purchaseItem->product_id);
            $purchaseItem->quantity = $purchaseItem->quantity + $returnedQnt;

            if($purchaseItem->quantity <= 0){
                $zeroItems +=1;
            }
        }


        if($zeroItems >= count($purchaseItems)){
            return redirect()->back();
        }


        //$purchaseItems = $purchaseItems->toJson();


       // return  $purchaseItems ;
        return view('purchases.edit',compact('warehouses','customers','purchaseItems','id','purchase'));

    }

    private function getAllProductReturnForSameInvoice($invoiceId,$productId){
        $totalQnt = 0;

        $allOtherPurchaseItems = DB::table('purchase_details')
            ->join('purchases','purchases.id','=','purchase_details.purchase_id')
            ->select('purchase_details.*')
            ->where('purchases.returned_bill_id',$invoiceId)
            ->where('purchase_details.product_id',$productId)->get();

        foreach ($allOtherPurchaseItems as $item){

            $totalQnt += $item->quantity;
        }

        return $totalQnt;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePurchaseRequest  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request  $request , $billid)
    {
        $siteController = new SystemController();
        $total = 0;
        $tax = 0;
        $discount = 0;
        $net = 0;
        $lista = 0;
        $profit = 0;

        $products = array();
        $qntProducts = array();
        foreach ($request->product_id as $index=>$id){
            $productDetails = $siteController->getProductById($id);
            $product = [
                'purchase_id' => 0,
                'product_code' => $productDetails->code,
                'product_id' => $id,
                'quantity' => $request->qnt[$index] * -1,
                'cost_without_tax' => $request->price_without_tax[$index] * -1,
                'cost_with_tax' => $request->price_with_tax[$index] * -1,
                'warehouse_id' => $request->warehouse_id,
                'unit_id' => $productDetails->unit,
                'tax' => $request->tax[$index] * -1,
                'total' => $request->total[$index] * -1,
                'net' => $request->net[$index] * -1,
            ];

            $item = new Product();
            $item -> product_id = $id;
            $item -> quantity = $request->qnt[$index]  * -1;
            $item -> warehouse_id = $request->warehouse_id ;
            $qntProducts[] = $item ;

            $products[] = $product;
            $total +=$request->total[$index];
            $tax +=$request->tax[$index];
            $net +=$request->net[$index];
        }

        $sale = Purchase::create([
            'returned_bill_id' => $billid,
            'date' => $request->bill_date,
            'invoice_no' => $request-> bill_number,
            'customer_id' => $request->customer_id,
            'biller_id' => Auth::id(),
            'warehouse_id' => $request->warehouse_id,
            'note' => $request->notes ? $request->notes :'',
            'total' => $total * -1,
            'discount' => 0,
            'tax' => $tax * -1,
            'net' => $net * -1,
            'paid' => 0,
            'purchase_status' => 'completed',
            'payment_status' => 'not_paid',
            'created_by' => Auth::id()
        ]);

        foreach ($products as $product){
            $product['purchase_id'] = $sale->id;
            PurchaseDetails::create($product);
        }

        $siteController->syncQnt($qntProducts,null , false);
        $clientController = new ClientMoneyController();
        $clientController->syncMoney($request->customer_id,0,$net*-1);

        $vendorMovementController = new VendorMovementController();
        $vendorMovementController->addPurchaseMovement($sale->id);

        return redirect()->route('purchases');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase = Purchase::find($id);
        $item = new Product();
        $qntProducts = array();
        $siteController = new SystemController();
        $net = 0 ;
        if($purchase){
            $details = PurchaseDetails::where('purchase_id' , '=' , $id) -> get();
            foreach ($details as $detail){
                $item = new Product();
                $item -> product_id = $detail -> product_id;
                $item -> quantity = $detail-> quantity  * -1;
                $item -> warehouse_id = $detail->warehouse_id ;
                $qntProducts[] = $item ;
                $net +=$detail->net;
                $detail -> delete();
            }
            $returns = Purchase::where('returned_bill_id' , '=' , $id) -> get();
            foreach ($returns as $return){
                $details = PurchaseDetails::where('purchase_id' , '=' , $return -> id) -> get();
                foreach ($details as $detail){
                    $item = new Product();
                    $item -> product_id = $detail -> product_id;
                    $item -> quantity = $detail-> quantity  * -1;
                    $item -> warehouse_id = $detail->warehouse_id ;
                    $qntProducts[] = $item ;
                    $net +=$detail->net;
                    $detail -> delete();
                }
                $return -> delete();
            }

            $siteController->syncQnt($qntProducts,null , false);
            $clientController = new ClientMoneyController();
            $clientController->syncMoney($purchase->customer_id,0,$net*-1);



            $vendorMovementController = new VendorMovementController();
            $vendorMovementController->removePurchaseMovement($purchase->id);

            $paymentController = new PaymentController();
            $paymentController->deleteAllPurchasePayments($purchase->id);

            $purchase -> delete();


            return redirect()->route('purchases')->with('success' ,  __('main.deleted'));

        }
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
