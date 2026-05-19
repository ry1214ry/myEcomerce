<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminBrandController;
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminBannerController;
use App\Http\Controllers\Admin\AdminAuthController;



Route::get('/media/{path}', [MediaController::class, 'show'])
    ->where('path', '.*')
    ->name('media.show');

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLogin'])
        ->name('login')
        ->middleware('guest');


    Route::post('/login', [AdminAuthController::class, 'login'])
        ->name('login.post');

    Route::post('/logout', [AdminAuthController::class, 'logout'])
        ->name('logout')
        ->middleware('auth');

    Route::middleware(['auth', 'admin'])->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        // Products
        Route::resource('products', AdminProductController::class);

        // Categories
        Route::resource('categories', AdminCategoryController::class);

        // Brands
        Route::resource('brands', AdminBrandController::class);

        // Banners
        Route::resource('banners', AdminBannerController::class);

        // Orders
        Route::resource('orders', AdminOrderController::class)
            ->only(['index', 'show', 'update']);
        Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.status');

        // Users / Customers
        Route::resource('users', AdminUserController::class)
            ->only(['index', 'show', 'destroy']);
    });
});

Route::middleware(['customer'])->group(function () {

    // ── Public Pages ──────────────────────────────────────────────────────────
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

    // ── Shop ──────────────────────────────────────────────────────────────────
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::get('/shop/category/{slug}', [ShopController::class, 'byCategory'])
        ->name('shop.category');
    Route::get('/shop/brand/{slug}', [ShopController::class, 'byBrand'])
        ->name('shop.brand');

    // ── Products ──────────────────────────────────────────────────────────────
    Route::get('/product/{slug}', [ProductController::class, 'show'])
        ->name('product.show');

    // ── Cart (guests allowed) ─────────────────────────────────────────────────
    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])
        ->name('cart.add');
    Route::patch('/cart/update/{id}', [CartController::class, 'update'])
        ->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
        ->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])
        ->name('cart.clear');

    // ── Authenticated Customer Only ───────────────────────────────────────────
    Route::middleware(['auth'])->group(function () {

        // Profile
        Route::get('/profile', [ProfileController::class, 'show'])
            ->name('profile.show');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
        Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])
            ->name('profile.password');

        // Checkout
        Route::get('/checkout', [CheckoutController::class, 'index'])
            ->name('checkout.index');
        Route::post('/checkout', [CheckoutController::class, 'store'])
            ->name('checkout.store');
            // ── KHQR Payment ─────────────────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    Route::get('/payment/khqr/{order}',
        [\App\Http\Controllers\KhqrPaymentController::class, 'show'])
        ->name('payment.khqr');

    Route::post('/payment/verify',
        [\App\Http\Controllers\KhqrPaymentController::class, 'verify'])
        ->name('verify.transaction');

});

        // Orders
        Route::get('/orders', [OrderController::class, 'index'])
            ->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');
        Route::get('/order-success/{order}', [OrderController::class, 'success'])
            ->name('orders.success');

        // Wishlist
        Route::get('/wishlist', [WishlistController::class, 'index'])
            ->name('wishlist.index');
        Route::post('/wishlist/toggle/{product}', [WishlistController::class, 'toggle'])
            ->name('wishlist.toggle');

        // Reviews
        Route::post('/reviews/{product}', [ReviewController::class, 'store'])
            ->name('reviews.store');
    });
});

// =============================================================================
// BREEZE FRONTEND AUTH ROUTES — Customers Only
// =============================================================================

require __DIR__ . '/auth.php';
