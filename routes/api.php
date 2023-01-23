<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\GoodsAndServiceController;
use App\Http\Controllers\Api\FinanceController;
use App\Http\Controllers\Api\InvoiceController;

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

// Goods and Services
Route::get('/goods-and-services', [GoodsAndServiceController::class, 'get']);

// Products
Route::post('/register-product', [ProductController::class, 'create']);
Route::post('/increase-stock', [ProductController::class, 'increaseStock']);
Route::post('/decrease-stock', [ProductController::class, 'decreaseStock']);

// Notes
Route::post('/issue-credit-note', [FinanceController::class, 'issueCreditNote']);
Route::post('/issue-debt-note', [FinanceController::class, 'issueDebtNote']);

// Invoice
Route::post('/issue-invoice', [InvoiceController::class, 'issue']);

Route::post('/register-good', [GoodsAndServiceController::class, 'registerProduct']);
