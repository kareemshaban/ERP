<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAuthUser/{id}', [App\Http\Controllers\Api\AuthController::class, 'getAuthUser'])->name('getAuthUser');
Route::post('/LoginUser', [App\Http\Controllers\Api\AuthController::class, 'LoginUser'])->name('LoginUser');
Route::get('/client_balance_report/{id}',[\App\Http\Controllers\Api\ClientController::class,'client_balance_report'])->name('client_balance_report');
Route::get('/createVisit', [App\Http\Controllers\Api\VisitController::class, 'createVisit'])->name('createVisit');




