<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'login'])->name('login');

Auth::routes();

Route::group(['middleware' => ['auth','CheckCustomer']], function() {
    Route::resource('order', OrderController::class);
});

Route::group(['prefix' => 'delivery','middleware' => ['auth','CheckDeliverboy']], function() {
    Route::get('/order', [DeliveryController::class, 'index'])->name('delivery_home');
    Route::get('/my_order', [DeliveryController::class, 'my_order'])->name('delivery_my_order');
    Route::get('/order/{id}', [DeliveryController::class, 'show'])->name('delivery_show');
    Route::post('/accept_order', [DeliveryController::class, 'accept_order'])->name('delivery_accept_order');
    Route::post('/status_change', [DeliveryController::class, 'status_change'])->name('delivery_status_change');
});

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');




