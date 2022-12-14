<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/units', [App\Http\Controllers\UnitController::class, 'index'])->name('units');
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



});

