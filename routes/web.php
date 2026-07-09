<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductPublicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EsewaController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/product', [ProductPublicController::class, 'products']);

// Route::get('/register', function () {
//     return view('register');
// });


Route::get('/register', [RegisterController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])
     ->name('dashboard')
     ->middleware('auth');

     Route::get('/profile', [ProfileController::class, 'index'])
    ->name('profile')
    ->middleware('auth');

    Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/payments', [PaymentController::class, 'show'])->name('payments');
    });
    
    // to show products on the home page
    Route::get('/index', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [ProductPublicController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('productShow');


Route::prefix('admin')->group(function(){
  
    // Route::get('/table',function(){
    //     return view('admin.tables');
    // });
    
    // Route::get('/user', [RegisterController::class, 'index'])->name('users.index');
    // Route::resource('user', RegisterController::class)->except(['store', 'create']); // Exclude registration routes if handled elsewhere
});



// Admin routes that require login
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin') // Admin guard
    ->group(function () {
        // Admin dashboard
        Route::get('index', [AdminDashboardController::class, 'index'])->name('index');

        // Logout
        Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

        // Orders (blade view route)
        Route::get('/order', function () {
            return view('admin.orders');
        });

        // Product management
        Route::resource('products', ProductController::class);

        // Orders CRUD
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');

        // User management
        Route::get('/user', [RegisterController::class, 'index'])->name('users.index');
        Route::get('/user/create', [RegisterController::class, 'create'])->name('users.create');
        Route::post('/user', [RegisterController::class, 'store'])->name('users.store');
        Route::get('/user/{user}/edit', [RegisterController::class, 'edit'])->name('users.edit');
        Route::put('/user/{user}', [RegisterController::class, 'update'])->name('users.update');
        Route::delete('/user/{user}', [RegisterController::class, 'destroy'])->name('users.destroy');
    });

// Public routes for admin login
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Admin login form
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');

        // Admin login submission
        Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    });



Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    // Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout');
    Route::post('/esewa', [EsewaController::class, 'initiate'])->name('esewa2');
    Route::get('/payment/success', [EsewaController::class, 'verification'])->name('payment.success');
    Route::get('/paymentfail', [EsewaController::class, 'esewaFail'])->name('payment.failed');
});
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');


Route::get('/checkout', [PaymentController::class, 'checkout'])->name('checkout')->middleware('auth');
