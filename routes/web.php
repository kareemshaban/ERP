<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){


Route::get('/', function () {
    return view('welcome');
}) -> name('index');

Auth::routes();

    Route::group(['middleware' => 'auth'], function () {
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/brands', [App\Http\Controllers\BrandController::class, 'index'])->name('brands');
Route::post('storeBrand', [App\Http\Controllers\BrandController::class, 'store'])->name('storeBrand');
Route::get('/deleteBrand/{id}', [App\Http\Controllers\BrandController::class, 'destroy'])->name('deleteBrand');
Route::get('/getBrand/{id}', [App\Http\Controllers\BrandController::class, 'edit'])->name('getBrand');

Route::get('/units/{type}', [App\Http\Controllers\UnitController::class, 'index'])->name('units');
Route::post('storeUnit', [App\Http\Controllers\UnitController::class, 'store'])->name('storeUnit');
Route::get('/deleteUnit/{id}', [App\Http\Controllers\UnitController::class, 'destroy'])->name('deleteUnit');
Route::get('/getUnit/{id}', [App\Http\Controllers\UnitController::class, 'edit'])->name('getUnit');

Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
Route::post('storeCategory', [App\Http\Controllers\CategoryController::class, 'store'])->name('storeCategory');
Route::get('/deleteCategory/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('deleteCategory');
Route::get('/getCategory/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('getCategory');

Route::get('/currency', [App\Http\Controllers\CurrencyController::class, 'index'])->name('currency');
Route::post('storeCurrency', [App\Http\Controllers\CurrencyController::class, 'store'])->name('storeCurrency');
Route::get('/deleteCurrency/{id}', [App\Http\Controllers\CurrencyController::class, 'destroy'])->name('deleteCurrency');
Route::get('/getCurrency/{id}', [App\Http\Controllers\CurrencyController::class, 'edit'])->name('getCurrency');

Route::get('/expenses', [App\Http\Controllers\ExpensesCategoryController::class, 'index'])->name('expenses');
Route::post('storeExpense', [App\Http\Controllers\ExpensesCategoryController::class, 'store'])->name('storeExpense');
Route::get('/deleteExpense/{id}', [App\Http\Controllers\ExpensesCategoryController::class, 'destroy'])->name('deleteExpense');
Route::get('/getExpense/{id}', [App\Http\Controllers\ExpensesCategoryController::class, 'edit'])->name('getExpense');


Route::get('/warehouses', [App\Http\Controllers\WarehouseController::class, 'index'])->name('warehouses');
Route::post('storeWarehouse', [App\Http\Controllers\WarehouseController::class, 'store'])->name('storeWarehouse');
Route::get('/deleteWarehouse/{id}', [App\Http\Controllers\WarehouseController::class, 'destroy'])->name('deleteWarehouse');
Route::get('/getWarehouse/{id}', [App\Http\Controllers\WarehouseController::class, 'edit'])->name('getWarehouse');

Route::get('/taxRates', [App\Http\Controllers\TaxRatesController::class, 'index'])->name('taxRates');
Route::post('storeTaxRate', [App\Http\Controllers\TaxRatesController::class, 'store'])->name('storeTaxRate');
Route::get('/deleteTaxRate/{id}', [App\Http\Controllers\TaxRatesController::class, 'destroy'])->name('deleteTaxRate');
Route::get('/getTaxRate/{id}', [App\Http\Controllers\TaxRatesController::class, 'edit'])->name('getTaxRate');

Route::get('/clientGroups', [App\Http\Controllers\CustomerGroupController::class, 'index'])->name('clientGroups');
Route::post('storeClientGroup', [App\Http\Controllers\CustomerGroupController::class, 'store'])->name('storeClientGroup');
Route::get('/deleteClientGroup/{id}', [App\Http\Controllers\CustomerGroupController::class, 'destroy'])->name('deleteClientGroup');
Route::get('/getClientGroup/{id}', [App\Http\Controllers\CustomerGroupController::class, 'edit'])->name('getClientGroup');

Route::get('/clients/{type}', [App\Http\Controllers\CompanyController::class, 'index'])->name('clients');
Route::post('storeCompany', [App\Http\Controllers\CompanyController::class, 'store'])->name('storeCompany');
Route::get('/deleteCompany/{id}', [App\Http\Controllers\CompanyController::class, 'destroy'])->name('deleteCompany');
Route::get('/getCompany/{id}', [App\Http\Controllers\CompanyController::class, 'edit'])->name('getCompany');

Route::get('/system_settings', [App\Http\Controllers\SystemSettingsController::class, 'index'])->name('system_settings');
Route::post('storeSettings', [App\Http\Controllers\SystemSettingsController::class, 'store'])->name('storeSettings');
Route::post('updateSettings', [App\Http\Controllers\SystemSettingsController::class, 'update'])->name('updateSettings');

Route::get('/pos_settings', [App\Http\Controllers\PosSettingsController::class, 'index'])->name('pos_settings');
Route::post('storePosSettings', [App\Http\Controllers\PosSettingsController::class, 'store'])->name('storePosSettings');
Route::post('updatePosSettings', [App\Http\Controllers\PosSettingsController::class, 'update'])->name('updatePosSettings');


Route::get('/cashiers', [App\Http\Controllers\CashierController::class, 'index'])->name('cashiers');
Route::post('storeCashier', [App\Http\Controllers\CashierController::class, 'store'])->name('storeCashier');
Route::get('/deleteCashier/{id}', [App\Http\Controllers\CashierController::class, 'destroy'])->name('deleteCashier');
Route::get('/getCashier/{id}', [App\Http\Controllers\CashierController::class, 'edit'])->name('getCashier');

Route::get('/users', [App\Http\Controllers\UserController::class, 'index'])->name('users');
Route::post('storeUser', [App\Http\Controllers\UserController::class, 'store'])->name('storeUser');
Route::get('/deleteUser/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('deleteUser');
Route::get('/getUser/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('getUser');
Route::post('reset_password', [App\Http\Controllers\UserController::class, 'reset_password'])->name('reset_password');

Route::get('/user_groups', [App\Http\Controllers\UserGroupController::class, 'index'])->name('user_groups');
Route::post('storeUserGroup', [App\Http\Controllers\UserGroupController::class, 'store'])->name('storeUserGroup');
Route::get('/deleteUserGroup/{id}', [App\Http\Controllers\UserGroupController::class, 'destroy'])->name('deleteUserGroup');
Route::get('/getUserGroup/{id}', [App\Http\Controllers\UserGroupController::class, 'edit'])->name('getUserGroup');


    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->name('createProduct');
    Route::post('products/create', [App\Http\Controllers\ProductController::class, 'store'])->name('storeProduct');
    Route::get('/products/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editProduct');
    Route::post('/products/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateProduct');
    Route::get('/products/delete/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteProduct');
    Route::get('/getProduct/{code}', [App\Http\Controllers\ProductController::class, 'getProduct'])->name('getProduct');
    Route::get('/products/print_barcode', [App\Http\Controllers\ProductController::class, 'print_barcode'])->name('print_barcode');
    Route::post('/products/print_barcode', [App\Http\Controllers\ProductController::class, 'do_print_barcode'])->name('preview_barcode');
        Route::get('/products/print_qr', [App\Http\Controllers\ProductController::class, 'print_qr'])->name('print_qr');
        Route::post('/products/print_qr', [App\Http\Controllers\ProductController::class, 'do_print_qr'])->name('preview_qr');


Route::get('/update_qnt', [App\Http\Controllers\UpdateQuntityController::class, 'index'])->name('update_qnt');
Route::get('/add_update_qnt', [App\Http\Controllers\UpdateQuntityController::class, 'create'])->name('add_update_qnt');
Route::post('/store_update_qnt', [App\Http\Controllers\UpdateQuntityController::class, 'store'])->name('store_update_qnt');
Route::get('/deleteUpdate_qnt/{id}', [App\Http\Controllers\UpdateQuntityController::class, 'destroy'])->name('deleteUpdate_qnt');
Route::get('/edit_Update_qnt/{id}', [App\Http\Controllers\UpdateQuntityController::class, 'edit'])->name('edit_Update_qnt');
Route::post('/update_update_qnt/{id}', [App\Http\Controllers\UpdateQuntityController::class, 'update'])->name('update_update_qnt');
Route::get('/getUpdateQntBillNo', [App\Http\Controllers\UpdateQuntityController::class, 'getUpdateQntBillNo'])->name('getUpdateQntBillNo');


    Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])->name('sales');
    Route::get('/sales/add', [App\Http\Controllers\SalesController::class, 'create'])->name('add_sale');
    Route::post('/sales/add', [App\Http\Controllers\SalesController::class, 'store'])->name('store_sale');
    Route::get('/getLastSalesBill', [App\Http\Controllers\SalesController::class, 'getLastSalesBill'])->name('getLastSalesBill');



    Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases');
    Route::get('/add_purchase', [App\Http\Controllers\PurchaseController::class, 'create'])->name('add_purchase');
    Route::post('/add_purchase', [App\Http\Controllers\PurchaseController::class, 'store'])->name('store_purchase');
    Route::get('/get_purchase_number', [App\Http\Controllers\PurchaseController::class, 'getNo'])->name('get_purchase_number');
    Route::get('/preview_purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'show'])->name('preview_purchase');
    Route::get('/return_purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'edit'])->name('return_purchase');
    Route::get('/get_purchaseR_number', [App\Http\Controllers\PurchaseController::class, 'getNoR'])->name('get_purchaseR_number');
    Route::post('/return_purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'update'])->name('return_purchase_store');
    Route::get('/delete_purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'destroy'])->name('delete_purchase');
    Route::get('/purchases/payments/{id}',[\App\Http\Controllers\PaymentController::class,'getPurchasesPayments'])->name('purchases_payments');
    Route::get('/purchases/payments/add/{id}',[\App\Http\Controllers\PaymentController::class,'addPurchasesPayment'])->name('add_purchases_payments');
    Route::post('/purchases/payments/add/{id}',[\App\Http\Controllers\PaymentController::class,'storePurchasesPayment'])->name('store_purchases_payments');
    Route::get('/purchases/payments/delete/{id}',[\App\Http\Controllers\PaymentController::class,'deletePurchasesPayment'])->name('delete_purchases_payments');



    Route::get('/sales/return/{id}', [App\Http\Controllers\SalesController::class, 'returnSale'])->name('add_return');
    Route::post('/sales/return/{id}', [App\Http\Controllers\SalesController::class, 'storeReturn'])->name('store_return');
    Route::get('/get_sales_number', [App\Http\Controllers\SalesController::class, 'getNo'])->name('get_sale_no');
    Route::get('/get_sales_return_number', [App\Http\Controllers\SalesController::class, 'getReturnNo'])->name('get_sale_return_no');
    Route::get('/sales/payments/{id}',[\App\Http\Controllers\PaymentController::class,'getSalesPayments'])->name('sales_payments');
    Route::get('/sales/payments/add/{id}',[\App\Http\Controllers\PaymentController::class,'addSalePayment'])->name('add_sales_payments');
    Route::post('/sales/payments/add/{id}',[\App\Http\Controllers\PaymentController::class,'storeSalePayment'])->name('store_sales_payments');
    Route::get('/sales/payments/delete/{id}',[\App\Http\Controllers\PaymentController::class,'deleteSalePayment'])->name('delete_sales_payments');
    Route::get('/preview_sales/{id}', [App\Http\Controllers\SalesController::class, 'show'])->name('preview_sales');


    Route::get('/daily_sales_report', [App\Http\Controllers\ReportController::class, 'daily_sales_report'])->name('daily_sales_report');
    Route::get('/daily_sales_report_search/{date}/{warehouse}', [App\Http\Controllers\ReportController::class, 'daily_sales_report_search'])
        ->name('daily_sales_report_search');

    Route::get('/sales_item_report', [App\Http\Controllers\ReportController::class, 'sales_item_report'])->name('sales_item_report');
    Route::get('/sales_item_report_search/{fdate}/{tdate}/{warehouse}', [App\Http\Controllers\ReportController::class, 'sales_item_report_search'])
        ->name('sales_item_report_search');

    Route::get('/purchase_report', [App\Http\Controllers\ReportController::class, 'purchase_report'])->name('purchase_report');
    Route::get('/purchase_report_search/{fdate}/{tdate}/{warehouse}/{bill_no}/{vendor}', [App\Http\Controllers\ReportController::class, 'purchase_report_search'])
        ->name('purchase_report_search');

    Route::get('/purchases_return_report', [App\Http\Controllers\ReportController::class, 'purchases_return_report'])->name('purchases_return_report');
    Route::get('/purchases_return_report_search/{fdate}/{tdate}/{warehouse}/{bill_no}/{vendor}', [App\Http\Controllers\ReportController::class, 'purchases_return_report_search'])
        ->name('purchases_return_report_search');

    Route::get('/items_report', [App\Http\Controllers\ReportController::class, 'items_report'])->name('items_report');
    Route::get('/items_report_search/{category}/{brand}', [App\Http\Controllers\ReportController::class, 'items_report_search'])->name('items_report_search');

    Route::get('/items_limit_report', [App\Http\Controllers\ReportController::class, 'items_limit_report'])->name('items_limit_report');
    Route::get('/items_limit_report_search/{category}/{brand}', [App\Http\Controllers\ReportController::class, 'items_limit_report_search'])->name('items_limit_report_search');


    Route::get('/items_no_balance_report', [App\Http\Controllers\ReportController::class, 'items_no_balance_report'])->name('items_no_balance_report');
    Route::get('/items_no_balance_report_search/{category}/{brand}', [App\Http\Controllers\ReportController::class, 'items_no_balance_report_search'])
        ->name('items_no_balance_report_search');

    Route::get('/items_stock_report', [App\Http\Controllers\ReportController::class, 'items_stock_report'])->name('items_stock_report');
    Route::get('/items_stock_report_search/{fdate}/{tdate}/{warehouse}/{item}', [App\Http\Controllers\ReportController::class, 'items_stock_report_search'])
        ->name('items_stock_report_search');

    Route::get('/items_purchased_report', [App\Http\Controllers\ReportController::class, 'items_purchased_report'])->name('items_purchased_report');
    Route::get('/items_purchased_report_search/{fdate}/{tdate}/{warehouse}/{item}/{supplier}', [App\Http\Controllers\ReportController::class, 'items_purchased_report_search'])
        ->name('items_purchased_report_search');

    Route::get('/client_balance_report/{id}/{slag}',[\App\Http\Controllers\ReportController::class,'client_balance_report'])->name('client_balance_report');

        Route::get('/incoming_list',[\App\Http\Controllers\JournalController::class,'incoming_list'])->name('incoming_list');
        Route::get('/balance_sheet',[\App\Http\Controllers\JournalController::class,'balance_sheet'])->name('balance_sheet');



    Route::get('/accounts',[\App\Http\Controllers\AccountsTreeController::class,'index'])->name('accounts_list');
    Route::get('/accounts/create',[\App\Http\Controllers\AccountsTreeController::class,'create'])->name('create_account');
    Route::post('/accounts/create',[\App\Http\Controllers\AccountsTreeController::class,'store'])->name('store_account');
    Route::get('/accounts/get_level/{parent}',[\App\Http\Controllers\AccountsTreeController::class,'getLevel'])->name('get_account_level');
    Route::get('/accounts/edit/{id}',[\App\Http\Controllers\AccountsTreeController::class,'edit'])->name('edit_account');
    Route::post('/accounts/edit/{id}',[\App\Http\Controllers\AccountsTreeController::class,'update'])->name('update_account');
    Route::get('/accounts/delete/{id}',[\App\Http\Controllers\AccountsTreeController::class,'destroy'])->name('delete_account');

    Route::get('/account_settings',[\App\Http\Controllers\AccountSettingController::class,'index'])->name('account_settings_list');
    Route::get('/account_settings/create',[\App\Http\Controllers\AccountSettingController::class,'create'])->name('create_account_settings');
    Route::post('/account_settings/create',[\App\Http\Controllers\AccountSettingController::class,'store'])->name('store_account_settings');
    Route::get('/account_settings/edit/{id}',[\App\Http\Controllers\AccountSettingController::class,'edit'])->name('edit_account_settings');
    Route::post('/account_settings/edit/{id}',[\App\Http\Controllers\AccountSettingController::class,'update'])->name('update_account_settings');
    Route::get('/account_settings/delete/{id}',[\App\Http\Controllers\AccountSettingController::class,'destroy'])->name('delete_account_settings');
    Route::get('/accounts/journals',[\App\Http\Controllers\AccountsTreeController::class,'journals'])->name('journals');
    Route::get('/accounts/journals/preview/{id}',[\App\Http\Controllers\AccountsTreeController::class,'previewJournal'])->name('preview_journal');

    Route::get('/accounts/manual',[\App\Http\Controllers\JournalController::class,'create'])->name('manual_journal');
    Route::post('/accounts/manual',[\App\Http\Controllers\JournalController::class,'store'])->name('store_manual');
        Route::get('/getAccounts/{code}', [App\Http\Controllers\AccountsTreeController::class, 'getAccount'])->name('getProduct');
        Route::get('/journals/delete/{id}',[\App\Http\Controllers\JournalController::class,'delete'])->name('delete_journal');

    Route::get('/box_expenses_list', [App\Http\Controllers\ExpensesController::class, 'index'])->name('box_expenses_list');
    Route::get('/create_expenses', [App\Http\Controllers\ExpensesController::class, 'create'])->name('create_expenses');
    Route::post('/box_expenses_store', [App\Http\Controllers\ExpensesController::class, 'store'])->name('box_expenses_store');
    Route::get('/view_expenses/{id}', [App\Http\Controllers\ExpensesController::class, 'show'])->name('view_expenses');
    Route::get('/pos', [App\Http\Controllers\SalesController::class, 'pos'])->name('pos');


    Route::get('/init',[\App\Http\Controllers\InitializeController::class,'getIntialize'])->name('init');
    Route::get('/subscribe_data',[\App\Http\Controllers\InitializeController::class,'subscribeData'])->name('subscribe_data');
    Route::post('/init',[\App\Http\Controllers\InitializeController::class,'storeInitialize'])->name('store_init');



});

});
