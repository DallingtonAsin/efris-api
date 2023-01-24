<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StockController;
use App\Http\Controllers\Api\GoodsAndServiceController;
use App\Http\Controllers\Api\FinanceController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\CommodityCategoryController;

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


// Goods
Route::get('/goods', [GoodsAndServiceController::class, 'getRegistedProducts']);
Route::post('/register-good', [GoodsAndServiceController::class, 'registerProduct']);


// Products
Route::post('/add-stock', [StockController::class, 'addStock']);
Route::post('/increase-stock', [StockController::class, 'addStock']);
Route::post('/decrease-stock', [StockController::class, 'decreaseStock']);
Route::get('/stock-records', [StockController::class, 'getStockRecords']);


// Commodity Categories
Route::get('/commodity-categories', [CommodityCategoryController::class, 'index']);


// Notes
Route::post('/issue-credit-note', [FinanceController::class, 'issueCreditNote']);
Route::post('/issue-debt-note', [FinanceController::class, 'issueDebtNote']);


// Invoice
Route::post('/issue-invoice', [InvoiceController::class, 'issue']);

