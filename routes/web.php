<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Middleware\AdminMiddleware;

Route::get('/', [ItemController::class, 'show_all'])->name('items.show')
    ->middleware('auth');

Route::get('/create', [ItemController::class, 'create'])->name('items.create')
    ->middleware('auth')
    ->middleware([AdminMiddleware::class]);

Route::post('/create', [ItemController::class, 'store'])->name('items.store')
    ->middleware('auth')
    ->middleware([AdminMiddleware::class]);

Route::get('/item/{item}', [ItemController::class, 'show'])->name('items.show_one')
    ->middleware('auth');

Route::get('/item/edit/{item}', [ItemController::class, 'edit'])
    ->middleware('auth')
    ->middleware([AdminMiddleware::class]);

Route::patch('/item/edit/{item}', [ItemController::class, 'update'])
    ->name('items.update')
    ->middleware('auth')
    ->middleware([AdminMiddleware::class]);

Route::get('/uploads', [ItemController::class, 'show_upload'])
    ->middleware('auth')
    ->middleware([AdminMiddleware::class]);

Route::post('/uploads', [ItemController::class, 'upload'])
    ->middleware('auth')
    ->middleware([AdminMiddleware::class])
    ->name('items.upload');

Route::get('/items/export/excel', [ItemController::class, 'exportExcel'])
    ->middleware('auth')
    ->middleware([AdminMiddleware::class])
    ->name('items.download_excel');

Route::get('/items/export/pdf', [ItemController::class, 'exportPdf'])
    ->middleware('auth')
    ->middleware([AdminMiddleware::class])
    ->name('items.download_pdf');;




///////////////////////CART////////////////////////////////



Route::get('/cart', [CartController::class, 'show'])
    ->name('cart.show')
    ->middleware('auth');

Route::post('/cart/add/{item}', [CartController::class, 'add'])
    ->name('cart.add')
    ->middleware('auth');

Route::delete('/cart/{cart}', [CartController::class, 'destroy'])
    ->name('cart.destroy')
    ->middleware('auth');

Route::post('/cart/{cart}/increment', [CartController::class, 'increment'])
    ->name('cart.increment')
    ->middleware('auth');

Route::post('/cart/{cart}/decrement', [CartController::class, 'decrement'])
    ->name('cart.decrement')
    ->middleware('auth');














//////////// CheckOut Functionalities //////////////////////
Route::get('/checkout', [CheckoutController::class, 'show'])
    ->middleware('auth')
    ->name('checkout.show');

Route::post('/checkout', [CheckoutController::class, 'store'])
    ->middleware('auth')
    ->name('checkout.store');

Route::get('/orders/{order}', [CheckoutController::class, 'success'])
    ->middleware('auth')
    ->name('checkout.success');




///////////////////Orders section ////////////////////////////////    

Route::get('/view_orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show')
    ->middleware('auth');

Route::get('/orders', [OrderController::class, 'index'])
    ->name('orders.index')
    ->middleware('auth');

Route::post('/returns', [OrderController::class, 'return'])
    ->name('returns.store')
    ->middleware('auth');



/////////////////////////////////Admin Section////////////////////////////////

Route::get('/admin', [AdminController::class, 'index']);

Route::get('/admin/reports', [AdminController::class, 'report'])
    ->name('admin.reports')
    ->middleware([AdminMiddleware::class])
    ->middleware('auth');

Route::get('/admin/stock', [AdminController::class, 'show'])
    ->name('admin.show_stock')
    ->middleware([AdminMiddleware::class])
    ->middleware('auth');

Route::post('/admin/stock/{item}', [AdminController::class, 'store'])
    ->name('admin.store')
    ->middleware([AdminMiddleware::class])
    ->middleware('auth');


Route::get('/admin/allusers', [AdminController::class, 'view_all'])
    ->name('admin.users_view')
    ->middleware([AdminMiddleware::class])
    ->middleware('auth');




//////////////////////////////User section//////////////////////////////////////
Route::get('/profile/{user}', [UserController::class, 'edit'])->name('users.edit');
Route::patch('/profile/{user}', [UserController::class, 'update']);












//User Registration and Login

Route::get('/register', [RegisterController::class, 'create']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/login', [SessionController::class, 'create'])->name('login');
Route::post('/login', [SessionController::class, 'store']);
Route::post('/logout', [SessionController::class, 'destroy']);
