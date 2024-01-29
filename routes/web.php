<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Página de Productos
Route::get('/products', function () {
    return Inertia::render('Products');
})->name('products');
Route::get('/products/{product}', [ProductController::class, 'showDetail'])->name('products.showDetail');

// Página de Servicios
Route::get('/services', function () {
    return Inertia::render('Services');
})->name('services');

// Página de Blog
Route::get('/blog', function () {
    return Inertia::render('Blog');
})->name('blog');

// Página de Contacto
Route::get('/contact', function () {
    return Inertia::render('Contact');
})->name('contact');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
Route::get('/test', function () {
    return Inertia::render('Test');
});
*/

require __DIR__ . '/auth.php';
