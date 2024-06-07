<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\HttpError\BadRequestController;
use App\Http\Controllers\PendingOrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PrimaryClassController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\PurchaseWholesaleOrderController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceTypeController;
use App\Mail\TestMailable;
use App\Models\PurchaseOrder;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

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

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');

// Página de Acerca de nosotros
Route::get('/about-us', function () {
    return Inertia::render('AboutUs');
})->name('about-us');

// Página de Marcas
Route::get('/brands', function () {
    return Inertia::render('Product/Brand');
})->name('brands');

// Página de Productos por Parametros
Route::get('/products', [ProductController::class, 'showAllByParameters'])
    ->name('products.parameters');
//     return Inertia::render('Product/Brand');
// })->name('products');

// Brand detail
Route::get('/brands/{brand}', [BrandController::class, 'showDetail'])
    ->name('brands.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Primary class detail
Route::get('/primary-classes/{primary_class}', [PrimaryClassController::class, 'showDetail'])
    ->name('primary-classes.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Category detail
Route::get('/categories/{category}', [CategoryController::class, 'showDetail'])
    ->name('categories.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Gender detail
Route::get('/genders/{gender}', [GenderController::class, 'showDetail'])
    ->name('genders.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Product detail
Route::get('/products/detail/{product}', [ProductController::class, 'showDetail'])
    ->name('products.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Pending orders routes
Route::get('/pending-orders/create', [PendingOrderController::class, 'create'])->name('pending_orders.create');
Route::get('/pending-orders/{pending_order}', [PendingOrderController::class, 'showDetail'])
    ->name('pending_orders.detail');

// Purchase wholesale order routes
Route::get('purchase-wholesale-orders/create', [PurchaseWholesaleOrderController::class, 'create'])->name('purchase_wholesale_orders.create');
Route::get(
    '/purchase-wholesale-orders/{purchase_wholesale_order}',
    [PurchaseWholesaleOrderController::class, 'showDetail']
)->name('purchase_wholesale_orders.detail');

// Página de Publicaciones
Route::get('/posts', [PostController::class, 'showAll'])->name('posts.index');
Route::get('/posts/{post}', [PostController::class, 'showDetail'])
    ->name('posts.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Página de Servicios
// Route::get('/services', function () {
//     return Inertia::render('Service/Index');
//     return Inertia::render('Service/Type');
// })->name('services');
Route::get('/services', [ServiceTypeController::class, 'showServiceTypes'])
    ->name('services');
Route::get('services/types/{service_type}', [ServiceTypeController::class, 'showServices'])
    ->name('serviceType');

// service detail
Route::get('/services/{service}', [ServiceController::class, 'showDetail'])
    ->name('services.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Purchase order detail
Route::get(
    '/purchase-orders/detail/{purchase_order}',
    [PurchaseOrderController::class, 'showDetail']
)->name('purchaseOrders.detail')
    ->missing(fn (): Response => BadRequestController::show());

// Página de Contacto
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

// Página del Carrito de compras
Route::get('/shopping-cart', function () {
    return Inertia::render('ShoppingCart');
})->name('shopping-cart');

Route::get('/mail', function () {
    $purchaseOrder = PurchaseOrder::query()->find(11);
    Mail::to('rojonatanael99@gmail.com')->send(new TestMailable($purchaseOrder));
});

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::fallback(function (): Response {
    return Inertia::render('Error/404Error');
});

/*
Route::get('/test', function () {
    return Inertia::render('Test');
});
*/

require __DIR__ . '/auth.php';
