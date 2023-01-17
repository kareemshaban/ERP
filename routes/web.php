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


Route::get('/update_qnt', [App\Http\Controllers\UpdateQuntityController::class, 'index'])->name('update_qnt');
Route::get('/add_update_qnt', [App\Http\Controllers\UpdateQuntityController::class, 'create'])->name('add_update_qnt');
Route::post('/store_update_qnt', [App\Http\Controllers\UpdateQuntityController::class, 'store'])->name('store_update_qnt');
Route::get('/deleteUpdate_qnt/{id}', [App\Http\Controllers\UpdateQuntityController::class, 'destroy'])->name('deleteUpdate_qnt');
Route::get('/edit_Update_qnt/{id}', [App\Http\Controllers\UpdateQuntityController::class, 'edit'])->name('edit_Update_qnt');
Route::post('/update_update_qnt/{id}', [App\Http\Controllers\UpdateQuntityController::class, 'update'])->name('update_update_qnt');
Route::get('/getUpdateQntBillNo', [App\Http\Controllers\UpdateQuntityController::class, 'getUpdateQntBillNo'])->name('getUpdateQntBillNo');


    Route::get('/sales', [App\Http\Controllers\SalesController::class, 'index'])->name('sales');
    Route::get('/add_sale', [App\Http\Controllers\SalesController::class, 'create'])->name('add_sale');
    Route::post('/add_sale', [App\Http\Controllers\SalesController::class, 'store'])->name('store_sale');
    Route::get('/get_sales_number', [App\Http\Controllers\SalesController::class, 'getNo'])->name('get_sale_no');

    Route::get('/purchases', [App\Http\Controllers\PurchaseController::class, 'index'])->name('purchases');
    Route::get('/add_purchase', [App\Http\Controllers\PurchaseController::class, 'create'])->name('add_purchase');
    Route::post('/add_purchase', [App\Http\Controllers\PurchaseController::class, 'store'])->name('store_purchase');
    Route::get('/get_purchase_number', [App\Http\Controllers\PurchaseController::class, 'getNo'])->name('get_purchase_number');
    Route::get('/preview_purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'show'])->name('preview_purchase');
    Route::get('/return_purchase/{id}', [App\Http\Controllers\PurchaseController::class, 'edit'])->name('return_purchase');
    Route::get('/get_purchaseR_number', [App\Http\Controllers\PurchaseController::class, 'getNoR'])->name('get_purchaseR_number');
    Route::post('/return_purchase', [App\Http\Controllers\PurchaseController::class, 'update'])->name('return_purchase_store');

});

