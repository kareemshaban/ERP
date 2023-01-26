<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Product;
use App\Models\UpdateQuntity;
use App\Models\Warehouse;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function daily_sales_report(){
        $warehouses = Warehouse::all();
        return view('Report.daily_sales_report' , compact('warehouses'));
    }
    public function daily_sales_report_search($date , $warehouse){
        $data = DB::table('sales')
            ->join('warehouses' , 'warehouses.id' , 'sales.warehouse_id')
            ->select('sales.*' , DB::raw("DATE_FORMAT(sales.date, '%d-%m-%Y') as bill_date")  , 'warehouses.name as warehouse_name')
            ->where('sales.sale_id' , '=' ,  0)
            -> get();

        $html = view('Report.daily_sales_modal',compact('data' , 'date' , 'warehouse'))->render();
        return $html ;

    }
    public function sales_item_report(){
        $warehouses = Warehouse::all();
        return view('Report.sales_item_report' , compact('warehouses'));
    }
    public function sales_item_report_search($fdate , $tdate , $warehouse){
        $data = DB::table('sale_details')
            -> join('sales' , 'sales.id' , 'sale_details.sale_id')
            ->join('products' , 'products.id' , 'sale_details.product_id')
            -> select('sale_details.*' , 'sales.date as bill_date' , 'sales.invoice_no as invoice_no' ,
            'products.code as product_code' , 'products.name as product_name')
            ->where('sales.sale_id' , '=' ,  0)
             -> get();
        $html = view('Report.item_sales_modal',compact('data' , 'fdate' , 'tdate' , 'warehouse'))->render();
        return $html ;
    }
    public function purchase_report(){
        $warehouses = Warehouse::all();
        $vendors = Company::where('group_id' , '=' , 4) -> get();
        return view('Report.purchase_report' , compact('warehouses' , 'vendors'));
    }
    public function purchase_report_search($fdate , $tdate , $warehouse ,$bill_no , $vendor){
        $data = DB::table('purchases')
            ->join('warehouses' , 'warehouses.id' , 'purchases.warehouse_id')
            ->join('companies' , 'companies.id' , 'purchases.customer_id')
            -> select('purchases.*' , 'warehouses.name as warehouse_name' , 'companies.name as supplier_name')
            ->where('returned_bill_id' , '=' , 0)
            -> get();
        $html = view('Report.purchase_modal',compact('data' , 'fdate' , 'tdate', 'warehouse' ,'bill_no' , 'vendor' ))->render();
        return $html ;
    }

    public function purchases_return_report(){
        $warehouses = Warehouse::all();
        $vendors = Company::where('group_id' , '=' , 4) -> get();
        return view('Report.purchase_return_report' , compact('warehouses' , 'vendors'));
    }
    public function purchases_return_report_search($fdate , $tdate , $warehouse ,$bill_no , $vendor){
        $data = DB::table('purchases')
            ->join('warehouses' , 'warehouses.id' , 'purchases.warehouse_id')
            ->join('companies' , 'companies.id' , 'purchases.customer_id')
            -> select('purchases.*' , 'warehouses.name as warehouse_name' , 'companies.name as supplier_name')
            ->where('returned_bill_id' , '<>' , 0)
            -> get();
        $html = view('Report.purchase_return_modal',compact('data' , 'fdate' , 'tdate', 'warehouse' ,'bill_no' , 'vendor' ))->render();
        return $html ;
    }
    public function items_report(){
        $warehouses = Warehouse::all();
        $brands = Brand::all();
        $categories = Category::all();
        $type = 0 ;
        return view('Report.items_report' , compact('warehouses' , 'brands' , 'categories' , 'type'));
    }
    public function items_report_search( $category , $brand){
       $data = DB::table('products')
           -> join('units' , 'products.unit' , '=' , 'units.id')
           -> select('products.*' , 'units.name as unit_name')
           -> get();
        $type = 0 ;
        $html = view('Report.items_modal',compact('data' ,'category' , 'brand' , 'type'))->render();
        return $html ;
    }
    public function items_limit_report(){
        $warehouses = Warehouse::all();
        $brands = Brand::all();
        $categories = Category::all();
        $type = 1 ;
        return view('Report.items_report' , compact('warehouses' , 'brands' , 'categories' , 'type'));
    }
    public function items_limit_report_search( $category , $brand){
        $data = DB::table('products')
            -> join('units' , 'products.unit' , '=' , 'units.id')
            -> select('products.*' , 'units.name as unit_name')
            ->whereRaw('products.alert_quantity > products.quantity')
            -> get();
        $type = 1 ;
        $html = view('Report.items_modal',compact('data' ,'category' , 'brand' , 'type'))->render();
        return $html ;
    }
    public function items_no_balance_report(){
        $warehouses = Warehouse::all();
        $brands = Brand::all();
        $categories = Category::all();
        $type = 2 ;
        return view('Report.items_report' , compact('warehouses' , 'brands' , 'categories' , 'type'));
    }
    public function items_no_balance_report_search( $category , $brand){
        $data = DB::table('products')
            -> join('units' , 'products.unit' , '=' , 'units.id')
            -> select('products.*' , 'units.name as unit_name')
            ->where('products.quantity', '<=' , 0)
            -> get();
        $type = 2 ;
        $html = view('Report.items_modal',compact('data' ,'category' , 'brand' , 'type'))->render();
        return $html ;
    }
    public function items_stock_report(){
        $warehouses = Warehouse::all();
        return view('Report.items_stock_report' , compact('warehouses'));
    }
    public function items_stock_report_search($fdate , $tdate , $warehouse ,$item_id ){
        $data = array();


        $updateQnt = DB::table('update_quntities')
          -> join('update_quntity_details' , 'update_quntities.id' , '=' ,'update_quntity_details.update_qnt_id')
          -> join('products' , 'update_quntity_details.item_id' , '=', 'products.id')
          -> select('update_quntities.warehouse_id as warehouse' ,'update_quntities.bill_date as date' , 'update_quntity_details.item_id as item_id' , 'update_quntity_details.qnt as qnt' ,
         'products.code as product_code' , 'products.name as product_name' )
          -> get();

      foreach ($updateQnt as $item){
          $obj = [
              'date' => $item -> date,
              'item_id' => $item -> item_id,
              'product_code' => $item -> product_code,
              'product_name' => $item -> product_name,
              'qnt' => $item -> qnt,
              'warehouse' => $item -> warehouse,
              'type' => 0
          ] ;
          array_push($data , $obj) ;
      }


      $purchase = DB::table('purchases')
          -> join('purchase_details' , 'purchases.id' , '=' , 'purchase_details.purchase_id')
          -> join('products' , 'purchase_details.product_id' , '=', 'products.id')
          -> select('purchases.warehouse_id as warehouse' , 'purchases.date as date' , 'purchase_details.product_id as item_id' , 'purchase_details.quantity as qnt' ,
              'products.code as product_code' , 'products.name as product_name'  )
          -> where('purchases.returned_bill_id' , '=' , 0)
      ->get();

        foreach ($purchase as $item){
            $obj = [
                'date' => $item -> date,
                'item_id' => $item -> item_id,
                'product_code' => $item -> product_code,
                'product_name' => $item -> product_name,
                'qnt' => $item -> qnt,
                'warehouse' => $item -> warehouse,
                'type' => 1
            ] ;
            array_push($data , $obj) ;
        }


      $returnPurchase = DB::table('purchases')
          -> join('purchase_details' , 'purchases.id' , '=' , 'purchase_details.purchase_id')
          -> join('products' , 'purchase_details.product_id' , '=', 'products.id')
          -> select('purchases.warehouse_id as warehouse' , 'purchases.date as date'  , 'purchase_details.product_id as item_id' , 'purchase_details.quantity as qnt' ,
              'products.code as product_code' , 'products.name as product_name'  )
          -> where('purchases.returned_bill_id' , '<>' , 0)
          ->get();

        foreach ($returnPurchase as $item){
            $obj = [
                'date' => $item -> date,
                'item_id' => $item -> item_id,
                'product_code' => $item -> product_code,
                'product_name' => $item -> product_name,
                'qnt' => $item -> qnt,
                'warehouse' => $item -> warehouse,
                'type' => 2
            ] ;
            array_push($data , $obj) ;
        }


      $sales = DB::table('sales')
          ->join('sale_details' , 'sales.id' , '=' , 'sale_details.sale_id')
          -> join('products' , 'sale_details.product_id' , '=', 'products.id')
          -> select('sales.warehouse_id as warehouse' , 'sales.date as date', 'sale_details.product_id as item_id' , 'sale_details.quantity as qnt' ,
              'products.code as product_code' , 'products.name as product_name')
          -> where('sales.sale_id' , '=' , 0)
          ->get();

        foreach ($sales as $item){
            $obj = [
                'date' => $item -> date,
                'item_id' => $item -> item_id,
                'product_code' => $item -> product_code,
                'product_name' => $item -> product_name,
                'qnt' => $item -> qnt,
                'warehouse' => $item -> warehouse,
                'type' => 3
            ] ;
            array_push($data , $obj) ;
        }



        $salesReturn = DB::table('sales')
            ->join('sale_details' , 'sales.id' , '=' , 'sale_details.sale_id')
            -> join('products' , 'sale_details.product_id' , '=', 'products.id')
            -> select('sales.warehouse_id as warehouse' , 'sales.date as date', 'sale_details.product_id as item_id' , 'sale_details.quantity as qnt' ,
                'products.code as product_code' , 'products.name as product_name')
            -> where('sales.sale_id' , '<>' , 0)
            ->get();

        foreach ($salesReturn as $item){
            $obj = [
                'date' => $item -> date,
                'item_id' => $item -> item_id,
                'product_code' => $item -> product_code,
                'product_name' => $item -> product_name,
                'qnt' => $item -> qnt,
                'warehouse' => $item -> warehouse,
                'type' => 4
            ] ;
            array_push($data , $obj) ;
        }
        $result = [] ;

        $group = [];
        foreach ($data as $element) {
            $group[$element['item_id']][] = $element;
        }
        foreach ($group as $element) {
               $qnt_update = 0 ;
               $qnt_purchase = 0 ;
               $qnt_purchase_return = 0;
               $qnt_sales = 0 ;
               $qnt_sales_return = 0 ;
               foreach ($element as $subElement){
                   if($subElement['type'] == 0){
                       $qnt_update += $subElement['qnt'] ;
                   } else if($subElement['type'] == 1){
                       $qnt_purchase += $subElement['qnt'] ;
                   }
                   else if($subElement['type'] == 2){
                       $qnt_purchase_return += $subElement['qnt'] ;
                   } else if($subElement['type'] == 3){
                       $qnt_sales += $subElement['qnt'] ;
                   }  else if($subElement['type'] == 4){
                       $qnt_sales_return += $subElement['qnt'] ;
                   }

               }
               $obj = [
                   'date' => $subElement['date'],
                   'item_id' => $subElement['item_id'],
                   'product_code' => $subElement['product_code'],
                   'product_name' => $subElement ['product_name'],
                   'qnt_update' => $qnt_update,
                   'qnt_purchase' => $qnt_purchase ,
                   'qnt_purchase_return' => $qnt_purchase_return ,
                   'qnt_sales' => $qnt_sales ,
                   'qnt_sales_return' => $qnt_sales_return ,
                   'warehouse' => $subElement['warehouse'],
               ] ;
               array_push($result , $obj) ;
        }




         $html = view('Report.items_stock_modal',compact('result' ,'fdate' , 'tdate' , 'warehouse' , 'item_id'))->render();
        return $html ;

    }
    public function items_purchased_report(){
        $warehouses = Warehouse::all();
        $vendors = Company::where('group_id' , '=' , 4) -> get();
        return view('Report.items_purchased_report' , compact('warehouses' , 'vendors'));
    }
    public function items_purchased_report_search($fdate , $tdate , $warehouse ,$item_id , $supplier ){
        $data = DB::table('purchase_details')
            ->join('purchases' , 'purchase_details.purchase_id' , '=' , 'purchases.id')
            ->join('products' , 'purchase_details.product_id' , '=' , 'products.id')
            ->join('companies' , 'purchases.customer_id' , '=' , 'companies.id')
            ->select('purchases.*' , 'products.code as product_code' , 'products.name as product_name' ,
            'purchase_details.quantity' , 'purchase_details.cost_with_tax' , 'purchase_details.product_id' , 'companies.name as supplier_name')
            ->get();
        $html = view('Report.items_purchased_modal',compact('data' ,'fdate' , 'tdate' , 'warehouse' ,'item_id' , 'supplier'))->render();
        return $html ;
    }
}
