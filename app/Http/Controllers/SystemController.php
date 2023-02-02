<?php

namespace App\Http\Controllers;

use App\Models\AccountSetting;
use App\Models\AccountsTree;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Company;
use App\Models\Currency;
use App\Models\CustomerGroup;
use App\Models\ExpensesCategory;
use App\Models\Journal;
use App\Models\JournalDetails;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Purchase;
use App\Models\Sales;
use App\Models\TaxRates;
use App\Models\Unit;
use App\Models\Warehouse;
use App\Models\WarehouseProducts;
use Database\Factories\JournalFactory;
use Illuminate\Support\Facades\DB;

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
        return Company::where('group_id',3)->get();
    }

    public function getClientById($id){
        return Company::find($id);
    }


    public function getAllVendors(){
        return Company::where('group_id',4)->get();
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

    public function getProductById($id){
        return Product::find($id);
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

                if($warehouseProduct){
                    $warehouseProduct->update([
                        'quantity' => $warehouseProduct->quantity + $item->quantity
                    ]);
                }


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


    //region Journals


    public function saleJournals($id){
        $saleInvoice = Sales::find($id);
        if($saleInvoice->net < 0){
            return $this->returnSaleJournal($id);
        }

        $settings = AccountSetting::query()->where('warehouse_id',$saleInvoice->warehouse_id)->get()->first();
        if(!$settings)
            return;

        $headerData = [
            'date' => $saleInvoice->date,
            'basedon_no' => $saleInvoice->invoice_no,
            'basedon_id' => $id,
            'baseon_text' => 'فاتورة مبيعات',
            'total_credit' => 0,
            'total_debit' => 0,
            'notes' => ''
        ];
        //journal details
        $detailsData = [];

        //credit for details
        //حساب الصندوق - الخصم
        if($saleInvoice->discount > 0){
            $detailsData[] = [
                'account_id' => $settings->sales_discount_account,
                'credit' =>$saleInvoice->discount,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->net > 0){

            $remain = $saleInvoice->net;

            if($remain > 0){
                $customerAccount = $this->getClientById($saleInvoice->customer_id)->account_id;
                $detailsData[] = [
                    'account_id' => $customerAccount,
                    'credit' =>$remain,
                    'debit' => 0,
                    'ledger_id' => $saleInvoice->customer_id,
                    'notes' => ''
                ];
            }
        }
        //debit for details
        //الضريبة - المبيعات
        if($saleInvoice->total > 0){
            $detailsData[] = [
                'account_id' => $settings->sales_account,
                'debit' => $saleInvoice->total,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->tax > 0){
            $detailsData[] = [
                'account_id' => $settings->sales_tax_account,
                'debit' => $saleInvoice->tax,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->total > 0 && $settings->profit_account > 0 && $settings->cost_account > 0){


            // هيدخل هنا في التكلفة وفي الارباح
            $detailsData[] = [
                'account_id' => $settings->profit_account,
                'credit' => $saleInvoice->profit,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];

            if($settings->reverse_profit_account > 0){
                $detailsData[] = [
                    'account_id' => $settings->reverse_profit_account,
                    'debit' =>$saleInvoice->profit,
                    'credit' => 0,
                    'ledger_id' => 0,
                    'notes' => ''
                ];
            }


            $detailsData[] = [
                'account_id' => $settings->cost_account,
                'credit' => $saleInvoice->total - $saleInvoice->profit,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];



            $detailsData[] = [
                'account_id' => $settings->stock_account,
                'debit' => $saleInvoice->total - $saleInvoice->profit,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];

        }


        $this->insertJournal($headerData,$detailsData);


    }

    private function returnSaleJournal($id){
        $saleInvoice = Sales::find($id);

        $settings = AccountSetting::query()->where('warehouse_id',$saleInvoice->warehouse_id)->get()->first();
        if(!$settings)
            return;
        //journal header
        $headerData = [
            'date' => $saleInvoice->date,
            'basedon_no' => $saleInvoice->invoice_no,
            'basedon_id' => $id,
            'baseon_text' => 'مرتجع مبيعات',
            'total_credit' => 0,
            'total_debit' => 0,
            'notes' => ''
        ];
        //journal details
        $detailsData = [];

        //credit for details
        //حساب الصندوق - الخصم
        if($saleInvoice->discount <> 0){
            $detailsData[] = [
                'account_id' => $settings->purchase_discount_account,
                'debit' => $saleInvoice->discount*-1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }
        if($saleInvoice->net <> 0){


            $customerAccount = $this->getClientById($saleInvoice->customer_id)->account_id;
            $detailsData[] = [
                'account_id' => $customerAccount,
                'debit' => $saleInvoice->net * -1,
                'credit' => 0,
                'ledger_id' => $saleInvoice->customer_id,
                'notes' => ''
            ];




        }
        //debit for details
        //الضريبة - المبيعات
        if($saleInvoice->total <>0){
            $detailsData[] = [
                'account_id' => $settings->return_sales_account,
                'credit' => $saleInvoice->total*-1,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->tax <>0){
            $detailsData[] = [
                'account_id' => $settings->sales_tax_account,
                'credit' => $saleInvoice->tax*-1,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }



        if($saleInvoice->total <> 0 && $settings->profit_account > 0 && $settings->cost_account > 0){

            // هيدخل هنا في التكلفة وفي الارباح
            $detailsData[] = [
                'account_id' => $settings->profit_account,
                'debit' => $saleInvoice->profit * -1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];

            if($settings->reverse_profit_account > 0){
                $detailsData[] = [
                    'account_id' => $settings->reverse_profit_account,
                    'credit' => $saleInvoice->profit * -1,
                    'debit' => 0,
                    'ledger_id' => 0,
                    'notes' => ''
                ];
            }

            $detailsData[] = [
                'account_id' => $settings->return_sales_account,
                'debit' => ($saleInvoice->total - $saleInvoice->profit)*-1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];



            $detailsData[] = [
                'account_id' => $settings->stock_account,
                'credit' => ($saleInvoice->total - $saleInvoice->profit) *-1,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];



        }

        $this->insertJournal($headerData,$detailsData);
    }


    public function purchaseJournals($id){


        $saleInvoice = Purchase::find($id);

        $settings = AccountSetting::query()->where('warehouse_id',$saleInvoice->warehouse_id)->get()->first();
        if(!$settings)
            return;

        $headerData = [
            'date' => $saleInvoice->date,
            'basedon_no' => $saleInvoice->invoice_no,
            'basedon_id' => $id,
            'baseon_text' => 'فاتورة مشتريات',
            'total_credit' => 0,
            'total_debit' => 0,
            'notes' => ''
        ];

        $detailsData = [];

        //credit for details
        //حساب الصندوق - الخصم
        if($saleInvoice->discount > 0){
            $detailsData[] = [
                'account_id' => $settings->sales_discount_account,
                'debit' => $saleInvoice->discount,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        ////log_message('error','F6 :'.$id);

        if($saleInvoice->net > 0){
            $customerAccount = $this->getClientById($saleInvoice->customer_id)->account_id;;
            $detailsData[] = [
                'account_id' => $customerAccount,
                'debit' => $saleInvoice->net,
                'credit' => 0,
                'ledger_id' => $saleInvoice->customer_id,
                'notes' => ''
            ];

        }

        ////log_message('error','F7 :'.$id);
        //debit for details
        //الضريبة - المبيعات
        if($saleInvoice->total > 0){
            $detailsData[] = [
                'account_id' => $settings->purchase_account,
                'credit' => $saleInvoice->total,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];


            $detailsData[] = [
                'account_id' => $settings->stock_account,
                'credit' => $saleInvoice->total,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];

            $detailsData[] = [
                'account_id' => $settings->purchase_account,
                'debit' => $saleInvoice->total,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->tax > 0){
            $detailsData[] = [
                'account_id' => $settings->purchase_tax_account,
                'credit' => $saleInvoice->tax,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        $this->insertJournal($headerData,$detailsData);
    }

    public function returnPurchaseJournals($id){

        $saleInvoice = Purchase::find($id);

        $settings = AccountSetting::query()->where('warehouse_id',$saleInvoice->warehouse_id)->get()->first();
        if(!$settings)
            return;

        //journal header
        $headerData = [
            'date' => $saleInvoice->date,
            'basedon_no' => $saleInvoice->invoice_no,
            'basedon_id' => $id,
            'baseon_text' => 'مرتجع مشتريات',
            'total_credit' => 0,
            'total_debit' => 0,
            'notes' => ''
        ];
        //journal details
        $detailsData = [];

        //credit for details
        //حساب الصندوق - الخصم
        if($saleInvoice->order_discount < 0){
            $detailsData[] = [
                'account_id' => $settings->purchase_discount_account,
                'debit' => $saleInvoice->order_discount*-1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->net < 0){

                $customerAccount = $this->getClientById($saleInvoice->customer_id)->account_id;;
                $detailsData[] = [
                    'account_id' => $customerAccount,
                    'credit' => $saleInvoice->net *-1,
                    'debit' => 0,
                    'ledger_id' => $saleInvoice->customer_id,
                    'notes' => ''
                ];

        }
        //debit for details
        //الضريبة - المبيعات
        if($saleInvoice->total < 0){
            $detailsData[] = [
                'account_id' => $settings->return_purchase_account,
                'debit' => $saleInvoice->total*-1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];

            $detailsData[] = [
                'account_id' => $settings->stock_account,
                'debit' => $saleInvoice->total*-1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];

            $detailsData[] = [
                'account_id' => $settings->return_purchase_account,
                'credit' => $saleInvoice->total*-1,
                'debit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        if($saleInvoice->tax < 0){
            $detailsData[] = [
                'account_id' => $settings->purchase_tax_account,
                'debit' => $saleInvoice->tax*-1,
                'credit' => 0,
                'ledger_id' => 0,
                'notes' => ''
            ];
        }

        $this->insertJournal($headerData,$detailsData);
    }




    public function getJournal($data){

        $data = Journal::query()
            ->where('basedon_no',$data['basedon_no'])
        ->where('basedon_id',$data['basedon_id'])
        ->where('baseon_text',$data['baseon_text'])->get()->first();

        if($data){
            return $data->id;
        }
        return 0;
    }

    private function getOldDetails($id){
        return JournalDetails::query()->where('journal_id',$id)->get();
    }
    public function insertJournal($header,$details,$manual = 0){

        if($id = $this->getJournal($header)){
            $journal = Journal::find($id);
            $journal->update($header);

            $oldDetails = $this->getOldDetails($id);
            ////log_message('error',$id);
            foreach($oldDetails as $oldDetail){
                $this->updateAccountBalance($oldDetail->account_id,-1*$oldDetail->credit,-1*$oldDetail->debit,$header['date'],$id);
            }

            DB::table('journal_details')
                ->where('journal_id' ,$id)
                ->delete();

            DB::table('account_movements')
                ->where('journal_id' ,$id)
                ->delete();


            foreach($details as $detail){
                $detail['journal_id'] = $id;

                DB::table('journal_details')
                    ->insert($detail);

                $this->updateAccountBalance($detail['account_id'],$detail['credit'],$detail['debit'],$header['date'],$id);
            }

            return true;
        }else{
            $journal_id = DB::table('journals')
                ->insertGetId($header);
            if ($journal_id) {

                foreach($details as $detail){
                    $detail['journal_id'] = $journal_id;

                    DB::table('journal_details')
                        ->insert($detail);


                    $this->updateAccountBalance($detail['account_id'],$detail['credit'],$detail['debit'],$header['date'],$journal_id);
                }

                if($manual  == 1){
                    $journal  = Journal::find($journal_id);

                    $journal->update(['baseon_text' => 'سند قيد يدوي رقم '.$journal_id]);
                }
            }
            return true;
        }

        return false;

    }


    private function updateAccountBalance($id,$credit,$debit,$date,$journalId){
        $account = $this->getAccountById($id);

        if(!$account){
            return;
        }





            if($credit <> 0 || $debit <> 0){
                $accountMData = [
                    'journal_id' => $journalId,
                    'account_id' => $id,
                    'credit'     => $credit,
                    'debit'      => $debit,
                    'date'       => $date
                ];

                DB::table('account_movements')->insert($accountMData);
            }



            if($account->parent_id > 0){
                $this->updateAccountBalance($account->parent_id,$credit,$debit,$date,$journalId);
            }

    }

    private function getAccountById($id){
        if(!$id){
            $id = 0;
        }
        return AccountsTree::find($id);

    }

    //endregion
}
