<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\CustomerGroup;
use App\Models\ExpensesCategory;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\TaxRates;
use App\Models\Unit;
use App\Models\Warehouse;
use App\Models\WarehouseProducts;

class SystemController extends Controller
{
    public function getAllBrands(){
        return Brand::all();
    }

    public  function getBrandById($id){
        return Brand::find($id);
    }

    public function getAllMainCategories(){
        return Category::where('parent_id',0)->get();
    }

    public function getCategoryById($id){
        return Category::find(id);
    }

    public function getAllSubCategories($id){
        return Category::where('parent_id',$id)->get();
    }

    public function getAllClients(){
        return Company::where('group_id',2)->get();
    }

    public function getClientById($id){
        return Company::find($id);
    }


    public function getAllVendors(){
        return Company::where('group_id',3)->get();
    }

    public function getVendorById($id){
        return Company::find($id);
    }


    public function getAllCurrencies(){
        return Currency::all();
    }

    public function getCurrencyById($id){
        return Currency::find($id);
    }

    public function getAllCustomerGroups(){
        return CustomerGroup::all();
    }

    public function getCustomerGroupById($id){
        return CustomerGroup::find($id);
    }

    public function getAllExpensesCategories(){
        return ExpensesCategory::all();
    }

    public function getExpensesCategoryById($id){
        return ExpensesCategory::find($id);
    }

    public function getAllTaxRates(){
        return TaxRates::all();
    }

    public function getTaxRateById($id){
        return TaxRates::find($id);
    }

    public function getAllTaxTypes(){
        return [
            [
                'id' => '1',
                'name' => 'Included'
            ],[
                'id'=> '2',
                'name' =>'Excluded'
            ]
        ];
    }

    public function getTaxTypeById($id){
        if($id==1){
            return "Included";
        }else{
            return "Excluded";
        }
    }

    public function getAllUnits(){
        return Unit::all();
    }

    public function getUnitById($id){
        return Unit::find($id);
    }

    public function getAllWarehouses(){
        return Warehouse::all();
    }

    public function getWarehouseById($id){
        return Warehouse::find($id);
    }


    public function syncQnt($items=null,$oldItems=null,$isMinus = true){

        $multy = $isMinus ? -1:1;

        if($items){
            foreach ($items as $item){
                $item->quantity = $item->quantity * $multy;

                $productId = $item->product_id;
                $warehouseId = $item->warehouse_id;

                $product = Product::find($productId);
                $product->update([
                    'quantity' => $product->quantity + $item->quantity
                ]);

                $warehouseProduct = WarehouseProducts::query()
                    ->where('product_id',$productId)
                    ->where('warehouse_id',$warehouseId)
                    ->get()->first();


                $warehouseProduct->update([
                   'quantity' => $warehouseProduct->quantity + $item->quantity
                ]);

            }
        }

        if($oldItems){
            foreach ($oldItems as $item){
                $item->quantity = $item->quantity * $multy;

                $productId = $item->product_id;
                $warehouseId = $item->warehouse_id;

                $product = Product::find($productId);
                $product->update([
                    'quantity' => $product->quantity - $item->quantity
                ]);

                $warehouseProduct = WarehouseProducts::query()
                    ->where('product_id',$productId)
                    ->where('warehouse_id',$warehouseId)
                    ->get()->first();


                $warehouseProduct->update([
                    'quantity' => $warehouseProduct->quantity - $item->quantity
                ]);

            }
        }

    }

}
