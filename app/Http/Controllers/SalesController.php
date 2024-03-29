<?php

namespace App\Http\Controllers;

use App\Models\Cashier;
use App\Models\Company;
use App\Models\Payment;
use App\Models\Product;
use App\Models\SaleDetails;
use App\Models\Sales;
use App\Http\Requests\StoreSalesRequest;
use App\Http\Requests\UpdateSalesRequest;
use App\Models\SystemSettings;
use App\Models\Warehouse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('sales')
            ->join('warehouses','sales.warehouse_id','=','warehouses.id')
            ->join('companies','sales.customer_id','=','companies.id')
            ->select('sales.*','warehouses.name as warehouse_name','companies.name as customer_name')
            ->orderByDesc('id')
            ->get();

        return view('sales.index',compact('data'));
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
        $customers = $siteContrller->getAllClients();
        $settings = SystemSettings::with('currency') -> get() -> first();

        return view('sales.create',compact('warehouses','customers' , 'settings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSalesRequest $request)
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
                'sale_id' => 0,
                'product_code' => $productDetails->code,
                'product_id' => $id,
                'quantity' => $request->qnt[$index],
                'price_without_tax' => $request->price_without_tax[$index],
                'price_with_tax' => $request->price_with_tax[$index],
                'warehouse_id' => $request->warehouse_id,
                'unit_id' => $productDetails->unit,
                'tax' => $request->tax[$index],
                'total' => $request->total[$index],
                'lista' => 0,
                'profit'=> ($request->price_without_tax[$index] - $productDetails->cost) * $request->qnt[$index]
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
            $profit +=($request->price_without_tax[$index] - $productDetails->cost) * $request->qnt[$index];
        }

        $net += $request -> additional_service ?? 0 ;

        $sale = Sales::create([
            'date' => $request->bill_date,
            'invoice_no' => $request-> bill_number,
            'customer_id' => $request->customer_id,
            'biller_id' => Auth::id(),
            'warehouse_id' => $request->warehouse_id,
            'note' => $request->notes ? $request->notes :'',
            'total' => $total,
            'discount' => 0,
            'tax' => $tax,
            'net' => $net ,
            'paid' => 0,
            'sale_status' => 'completed',
            'payment_status' => 'not_paid',
            'created_by' => Auth::id(),
            'pos' => $request -> has('POS') ? $request ->POS :   0,
            'lista' => $lista,
            'profit'=> $profit,
            'additional_service' => $request -> additional_service ?? 0
        ]);

        foreach ($products as $product){
            $product['sale_id'] = $sale->id;
            SaleDetails::create($product);
        }

        $siteController->syncQnt($qntProducts,null);
        $clientController = new ClientMoneyController();
        $clientController->syncMoney($request->customer_id,0,$net*-1);

        $vendorMovementController = new VendorMovementController();
        $vendorMovementController->addSaleMovement($sale->id);

        $siteController->saleJournals($sale->id);

        if(!$request ->POS){
            return redirect()->route('sales');
        } else {
            return redirect()->route('pos');
        }

    }

    public function returnSale($id)
    {
        $sale = Sales::find($id);
        if($sale->net < 0){
            return redirect()->back();
        }


        $siteContrller = new SystemController();
        $warehouses = $siteContrller->getAllWarehouses();
        $customers = $siteContrller->getAllClients();

        $saleItems = DB::table('sale_details')
        ->join('products','products.id','=','sale_details.product_id')
        ->select('sale_details.*','products.name as product_name')
            ->where('sale_id',$id)->get();


        $zeroItems = 0;
        foreach ($saleItems as $saleItem){
            $returnedQnt = $this->getAllProductReturnForSameInvoice($id,$saleItem->product_id);
            $saleItem->quantity = $saleItem->quantity + $returnedQnt;

            if($saleItem->quantity <= 0){
                $zeroItems +=1;
            }
        }


        if($zeroItems >= count($saleItems)){
            return redirect()->back();
        }


        $saleItems = $saleItems->toJson();


        return view('sales.return',compact('warehouses','customers','saleItems','id','sale'));
    }


    private function getAllProductReturnForSameInvoice($invoiceId,$productId){
        $totalQnt = 0;

        $allOtherSaleItems = DB::table('sale_details')
            ->join('sales','sales.id','=','sale_details.sale_id')
            ->select('sale_details.*')
            ->where('sales.sale_id',$invoiceId)
            ->where('sale_details.product_id',$productId)->get();

        foreach ($allOtherSaleItems as $item){

            $totalQnt += $item->quantity;
        }

        return $totalQnt;
    }

    public function show($id)
    {
        $datas = DB::table('sales')
            ->join('warehouses','sales.warehouse_id','=','warehouses.id')
            ->join('companies','sales.customer_id','=','companies.id')
            ->select('sales.*','warehouses.name as warehouse_name','companies.name as customer_name' )
            ->where('sales.id' , '=' , $id) -> get();
        if(count($datas)){
            $data = $datas[0];
            $details = DB::table('sale_details')
                -> join('products' , 'sale_details.product_id' , '=' , 'products.id')
                -> select('sale_details.*' , 'products.code' , 'products.name')
                ->where('sale_details.sale_id' , '=' , $id)-> get();
            $payments = Payment::with('user') -> where('sale_id',$id)
                ->where('sale_id','<>',null)->get();


            $vendor = Company::find($data->customer_id);
            $cashier = Cashier::get()->first();

            return view('sales.view',compact('data' , 'details','vendor','cashier' , 'payments' ))->render();
        }


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function storeReturn(StoreSalesRequest $request,$id)
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
        foreach ($request->product_id as $index=>$id1){
            $productDetails = $siteController->getProductById($id1);
            $product = [
                'sale_id' => 0,
                'product_code' => $productDetails->code,
                'product_id' => $id1,
                'quantity' => $request->qnt[$index] * -1,
                'price_without_tax' => $request->price_without_tax[$index] * -1,
                'price_with_tax' => $request->price_with_tax[$index] * -1,
                'warehouse_id' => $request->warehouse_id,
                'unit_id' => $productDetails->unit,
                'tax' => $request->tax[$index] * -1,
                'total' => $request->total[$index] * -1,
                'lista' => 0,
                'profit'=> (($request->price_without_tax[$index] - $productDetails->cost) * $request->qnt[$index]) * -1
            ];

            $item = new Product();
            $item -> product_id = $id1;
            $item -> quantity = $request->qnt[$index]  * -1;
            $item -> warehouse_id = $request->warehouse_id ;
            $qntProducts[] = $item ;

            $products[] = $product;
            $total +=$request->total[$index];
            $tax +=$request->tax[$index];
            $net +=$request->net[$index];
            $profit +=($request->price_without_tax[$index] - $productDetails->cost) * $request->qnt[$index];
        }

        $sale = Sales::create([
            'sale_id' => $id,
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
            'sale_status' => 'completed',
            'payment_status' => 'not_paid',
            'created_by' => Auth::id(),
            'pos' => 0,
            'lista' => $lista * -1,
            'profit'=> $profit * -1
        ]);

        foreach ($products as $product){
            $product['sale_id'] = $sale->id;
            SaleDetails::create($product);
        }

        $siteController->syncQnt($qntProducts,null);
        $clientController = new ClientMoneyController();
        $clientController->syncMoney($request->customer_id,0,$net);

        $vendorMovementController = new VendorMovementController();
        $vendorMovementController->addSaleMovement($sale->id);

        $siteController->saleJournals($sale->id);

        return redirect()->route('sales');
    }


    public function getNo($id){
        $warehouse = Warehouse::find($id);
        $bills = Sales::where('warehouse_id' , '=' , $id) -> orderBy('id', 'ASC')  ->get();
        if(count($bills) > 0){
            $id = $bills[count($bills) -1] -> id ;
        } else
            $id = 0 ;
        $settings = SystemSettings::all();
        $prefix = "";
        if(count($settings) > 0){
            if($settings[0] -> sales_prefix)
                $prefix =     $settings[0] -> sales_prefix ;
            else
                $prefix = "" ;
        } else {
            $prefix = "";
        }
        if($warehouse -> serial_prefix)
        $prefix = $prefix . '-'. $warehouse -> serial_prefix ;
        $no = json_encode($prefix . str_pad($id + 1, 6 , '0' , STR_PAD_LEFT)) ;
         echo $no ;
         exit;
    }

    public function getReturnNo(){
        $bills = Sales::orderBy('id', 'ASC')->get();
        if(count($bills) > 0){
            $id = $bills[count($bills) -1] -> id ;
        } else
            $id = 0 ;
        $settings = SystemSettings::all();
        $prefix = "";
        if(count($settings) > 0){
            if($settings[0] -> sales_return_prefix)
                $prefix =     $settings[0] -> sales_return_prefix ;
            else
                $prefix = "" ;
        } else {
            $prefix = "";
        }
        $no = json_encode($prefix . str_pad($id + 1, 6 , '0' , STR_PAD_LEFT)) ;
        echo $no ;
        exit;
    }

    public function pos(){
        $vendors = Company::where('group_id' , '=' , 3) -> get();
        $warehouses = Warehouse::all();
        $settings = SystemSettings::with('currency') -> get() -> first();
        return view('sales.pos' , compact('vendors' , 'warehouses' , 'settings'));
    }
    public function getLastSalesBill(){
        $bills = Sales::orderBy('id', 'desc')->get();
        if(count($bills) > 0)
            echo json_encode ($bills ->first());
        else
            json_encode (null);
        exit;
    }
    public function print_last_pos(){
        $bills = Sales::orderBy('id', 'desc') -> where('pos' , '<>' , 0)->get();
       if(count($bills) > 0){
           $bill = $bills -> first();
          return $this -> show($bill -> id);

       }
    }
}

