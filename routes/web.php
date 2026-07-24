<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Front Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\AccountController;

/*
|--------------------------------------------------------------------------
| Admin Controllers
|--------------------------------------------------------------------------
*/

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;

/*
|--------------------------------------------------------------------------
| Front Routes
|--------------------------------------------------------------------------
*/

// صفحه اصلی
Route::get('/', [HomeController::class, 'index'])->name('home');

// فروشگاه
Route::get('/shop', [FrontProductController::class, 'index'])
    ->name('shop.index');
Route::get('/live-search', [\App\Http\Controllers\Front\ProductController::class, 'liveSearch']);
// صفحه محصول
Route::get('/product/{slug}', [FrontProductController::class, 'show'])
    ->name('product.show');

// سبد خرید
Route::get('/cart', [\App\Http\Controllers\Front\CartController::class, 'index'])->name('cart.index');

Route::get('/cart/add/{id}', [\App\Http\Controllers\Front\CartController::class, 'add'])->name('cart.add');

Route::put('/cart/update/{id}', [\App\Http\Controllers\Front\CartController::class, 'update'])->name('cart.update');

Route::delete('/cart/remove/{id}', [\App\Http\Controllers\Front\CartController::class, 'remove'])->name('cart.remove');

// تسویه حساب
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->middleware('auth')
    ->name('checkout.index');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');

// سفارش‌های من
Route::middleware('auth')->group(function () {
    Route::get('/my-orders', [AccountController::class, 'orders'])
        ->name('account.orders');
});
use App\Http\Controllers\Front\ReviewController;

Route::middleware('auth')->post(
    '/product/{product}/review',
    [ReviewController::class, 'store']
)->name('product.review');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard')->middleware('auth');
Route::middleware(['auth'])->prefix('admin')->group(function () {

    Route::get('/', function () {

        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        return view('admin.dashboard');

    })->name('admin.dashboard');

    Route::resource('categories', CategoryController::class)
        ->names('admin.categories');
        Route::resource('sliders', \App\Http\Controllers\Admin\SliderController::class)
    ->names('admin.sliders');

    Route::resource('brands', BrandController::class)
        ->names('admin.brands');

    Route::resource('products', ProductController::class)
        ->names('admin.products');

    Route::resource('orders', OrderController::class)
    ->only(['index', 'show', 'update', 'destroy'])
    ->names('admin.orders');
});


/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';