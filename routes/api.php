<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\AnalysisParameterController;
use App\Http\Controllers\AnalysisTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConditionController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PendingOrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseRetailOrderController;
use App\Http\Controllers\PurchaseWholesaleOrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Http\Controllers\TypeSaleController;
use App\Http\Controllers\UnitController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::resource('/services', ServiceController::class);
Route::resource('/genders', GenderController::class);
Route::resource('/categories', CategoryController::class);
Route::resource('/analyses', AnalysisController::class);
Route::resource('/analysis-types', AnalysisTypeController::class);
Route::resource('/analysis-parameters', AnalysisParameterController::class);
Route::resource('/conditions', ConditionController::class);
Route::resource('/units', UnitController::class);
Route::resource('/pending-orders',  PendingOrderController::class);
Route::apiResource('/posts', PostController::class);
Route::get('/products/filter/', [ProductController::class, 'filter'])->name('products.filter');
Route::apiResource('/products', ProductController::class);
Route::apiResource('/purchase-orders', PurchaseOrderController::class);
Route::apiResource('/purchase-retail-orders', PurchaseRetailOrderController::class);
Route::apiResource('/purchase-wholesale-orders', PurchaseWholesaleOrderController::class);
Route::apiResource('/payment-methods', PaymentMethodController::class);
Route::apiResource('type-sales', TypeSaleController::class);
Route::apiResource('service-types', ServiceTypeController::class);
Route::get('/services/types/{service_type}', [ServiceTypeController::class, 'showTypes']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
